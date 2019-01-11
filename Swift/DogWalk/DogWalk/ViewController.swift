//
//  ViewController.swift
//  DogWalk
//
//  Created by Soong on 2018/5/28.
//  Copyright © 2018年 Soong. All rights reserved.
//

import UIKit
import CoreData

class ViewController: UIViewController {
    
    @IBOutlet var topView: UIImageView!
    @IBOutlet weak var tableView: UITableView!
    
    var currentDog: Dog?
    
    var managedContext: NSManagedObjectContext!
    
    lazy var dateFormatter: DateFormatter = {
        let df = DateFormatter()
        df.dateStyle = DateFormatter.Style.medium
        df.timeStyle = DateFormatter.Style.long
        return df
    }()
    
    override func viewWillAppear(_ animated: Bool) {
        super.viewWillAppear(animated)
        
        if let constraints = tableView.tableHeaderView?.constraints {
            for cs in constraints {
                print("constraint \(cs.constant)")
            }
        }
    }
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
        let headerImageView = UIImageView(image: UIImage(named: "bing"))
        headerImageView.contentMode = .scaleAspectFill
        headerImageView.frame.size.height = 300
        headerImageView.clipsToBounds = true
        tableView.tableHeaderView = headerImageView
        
        let dogName = "Fido"
        let dogFetch:NSFetchRequest<Dog> = Dog.fetchRequest()
        dogFetch.predicate = NSPredicate(format: "%K == %@", #keyPath(Dog.name), dogName)
        
        do {
            let results = try managedContext.fetch(dogFetch)
            if results.count > 0 {
                currentDog = results.first
            } else {
                currentDog = Dog(context: managedContext)
                currentDog?.name = dogName
                try managedContext.save()
            }
        } catch let error as NSError {
            print("Fetch error: \(error) description: \(error.userInfo)")
        }
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    @IBAction func add(_ sender: UIBarButtonItem) {
        let walk: Walk = Walk(context: managedContext)
        walk.date = NSDate()
        
//        if let dog = currentDog, let walks = dog.walks?.mutableCopy() as? NSMutableOrderedSet {
//            walks.add(walk)
//            dog.walks = walks
//        }

        if let dog = currentDog {
            dog.addToWalks(walk)
        }
        
        do {
            try managedContext.save()
        } catch let error as NSError {
            print("Save error \(error), description: \(error.userInfo)")
        }
        
        // Reload table view
        
        tableView.reloadData()
    }

}

extension ViewController: UITableViewDataSource, UITableViewDelegate {
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        guard let walks = currentDog?.walks else { return 1 }
        return walks.count
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        guard let walk = currentDog?.walks?.firstObject as? Walk,
            let walkDate = walk.date as Date? else { return cell }
        
        cell.textLabel?.text = dateFormatter.string(from: walkDate)
        return cell
    }
    
    func tableView(_ tableView: UITableView, canEditRowAt indexPath: IndexPath) -> Bool {
        return true
    }
    
    func tableView(_ tableView: UITableView, editingStyleForRowAt indexPath: IndexPath) -> UITableViewCell.EditingStyle {
        let style = UITableViewCell.EditingStyle(rawValue: UITableViewCell.EditingStyle.delete.rawValue & UITableViewCell.EditingStyle.insert.rawValue)
        return style!
    }
    
    func tableView(_ tableView: UITableView, commit editingStyle: UITableViewCell.EditingStyle, forRowAt indexPath: IndexPath) {
        guard let walkToRemove = currentDog?.walks?[indexPath.row] as? Walk, editingStyle == .delete else {
            return
        }
        
        managedContext.delete(walkToRemove)
        
        do {
           try managedContext.save()
            tableView.deleteRows(at: [indexPath], with: UITableView.RowAnimation.automatic)
        } catch let error as NSError {
            print("Saving error: \(error), description: \(error.userInfo)")
        }
    }
    
    
    
}

