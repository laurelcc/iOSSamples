//
//  AuthorsViewController.swift
//  SwiftCoreDataBooks
//
//  Created by htx on 2017/4/6.
//  Copyright © 2017年 soong. All rights reserved.
//

import UIKit
import CoreData

class AuthorsViewController: UITableViewController, NSFetchedResultsControllerDelegate {

    @IBOutlet weak var rightBarButtonItem: UIBarButtonItem!
    
    weak var managedObjectContext: NSManagedObjectContext!
    
    lazy var fetchedResultsController:NSFetchedResultsController<NSFetchRequestResult> = {
        
        let fetchRequest = NSFetchRequest<NSFetchRequestResult>()
        let entity:NSEntityDescription = NSEntityDescription()
        entity.managedObjectClassName = "Book"
        fetchRequest.entity = entity
        
        //create sort descriptors
        let authorDescriptor:NSSortDescriptor = NSSortDescriptor(key: "author", ascending: true)
        let titleDescriptor:NSSortDescriptor = NSSortDescriptor(key: "title", ascending: true)
        
        let sortDescriptors = [authorDescriptor, titleDescriptor]
        
        let controller = NSFetchedResultsController<NSFetchRequestResult>(fetchRequest: fetchRequest, managedObjectContext: self.managedObjectContext, sectionNameKeyPath: "author", cacheName: "Root")
        
        controller.delegate = self
        
        return controller
    }()
    
    override func viewDidLoad() {
        super.viewDidLoad()

        self.navigationItem.leftBarButtonItem = self.editButtonItem
        if let error = try? self.fetchedResultsController.performFetch(){
            print(error)
        }

    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }

    // MARK: - Table view data source

    override func numberOfSections(in tableView: UITableView) -> Int {
        // #warning Incomplete implementation, return the number of sections
        if let sections = fetchedResultsController.sections{
            return sections.count
        }
        
        return 0
    }

    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        // #warning Incomplete implementation, return the number of rows
        if let sections = self.fetchedResultsController.sections{
            let section = sections[section]
            
            return section.numberOfObjects
        }
        
        return 0
    }
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        return self.fetchedResultsController.sections?[section].name
    }
    
    override func tableView(_ tableView: UITableView, commit editingStyle: UITableViewCellEditingStyle, forRowAt indexPath: IndexPath) {
        
        if editingStyle == UITableViewCellEditingStyle.delete{
            let context = self.fetchedResultsController.managedObjectContext
            context.delete(self.fetchedResultsController.object(at: indexPath) as! NSManagedObject)
            
            if let error = try? context.save() {
                print(error)
            }
            
        }
        
    }
    
    override func setEditing(_ editing: Bool, animated: Bool) {
        super.setEditing(editing, animated: animated)
        
        if editing {
            self.rightBarButtonItem = self.navigationItem.rightBarButtonItem
        }
    }

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        // Get the new view controller using segue.destinationViewController.
        // Pass the selected object to the new view controller.
    }
    */

}
