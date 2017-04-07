//
//  AuthorsViewController.swift
//  SwiftCoreDataBooks
//
//  Created by htx on 2017/4/6.
//  Copyright © 2017年 soong. All rights reserved.
//

import UIKit
import CoreData

class AuthorsViewController: UITableViewController, NSFetchedResultsControllerDelegate, AddViewControllerDelegate {

    var rightBarButtonItem:UIBarButtonItem?
    var managedObjectContext: NSManagedObjectContext!
    
    struct AuthorViewControllerCellIdentifier {
        static let cellIdentifier = "Cell"
        
    }
    
    lazy var fetchedResultsController:NSFetchedResultsController<NSFetchRequestResult> = {
        
        let fetchRequest = NSFetchRequest<NSFetchRequestResult>(entityName: "Book")
        
        //create sort descriptors
        let authorDescriptor:NSSortDescriptor = NSSortDescriptor(key: "author", ascending: true)
        let titleDescriptor:NSSortDescriptor = NSSortDescriptor(key: "title", ascending: true)
        
        let sortDescriptors = [authorDescriptor, titleDescriptor]
        fetchRequest.sortDescriptors = sortDescriptors
        
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
        
        let t = UIView()
        t.frame = CGRect(x: 100, y: 100, width: 200, height: 200)
        t.backgroundColor = UIColor.red
        
        self.tableView.backgroundView = UIView()
        self.tableView.backgroundView?.backgroundColor = UIColor.yellow
        
        self.tableView.backgroundView?.addSubview(t)
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
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: AuthorViewControllerCellIdentifier.cellIdentifier)
        
        self.configureCell(cell: cell!, indexPath: indexPath)
        
        return cell!
    }
    
    // MARK: - Table view editing
    
    override func tableView(_ tableView: UITableView, canMoveRowAt indexPath: IndexPath) -> Bool {
        return false
    }
    
    override func setEditing(_ editing: Bool, animated: Bool) {
        super.setEditing(editing, animated: animated)
        
        if editing {
            self.rightBarButtonItem = self.navigationItem.rightBarButtonItem
            self.navigationItem.rightBarButtonItem = nil
        }else{
            self.navigationItem.rightBarButtonItem = self.rightBarButtonItem
            self.rightBarButtonItem = nil
        }
    }
    
    // MARK: - Fetched results controller
    
    func controllerWillChangeContent(_ controller: NSFetchedResultsController<NSFetchRequestResult>) {
        self.tableView.beginUpdates()
    }
    
    func controller(_ controller: NSFetchedResultsController<NSFetchRequestResult>, didChange anObject: Any, at indexPath: IndexPath?, for type: NSFetchedResultsChangeType, newIndexPath: IndexPath?) {
        guard let table = self.tableView, let path = indexPath else {
            return
        }
        
        switch type {
        case .insert:
            table.insertRows(at: [path], with: UITableViewRowAnimation.automatic)
        case .delete:
            table.deleteRows(at: [path], with: UITableViewRowAnimation.automatic)
        case .update:
            // Configure the cell to show the book's title
            self.configureCell(cell: table.cellForRow(at: path)!, indexPath: path)
        case .move:
            table.deleteRows(at: [path], with: UITableViewRowAnimation.automatic)
            table.insertRows(at: [newIndexPath!], with: UITableViewRowAnimation.automatic)
        }
        
    }
    
    func configureCell(cell: UITableViewCell, indexPath: IndexPath) -> Void {
        let book:Book = self.fetchedResultsController.object(at: indexPath) as! Book
        cell.textLabel?.text = book.title
    }
    
    func controllerDidChangeContent(_ controller: NSFetchedResultsController<NSFetchRequestResult>) {
        self.tableView.endUpdates()
    }
    
    /*
     Add View Controller 委托方法
     */
    func addViewController(controller: AddViewController, didFinishWithSave save: Bool) {
        if save {
            let addingContext = controller.managedContext
            if let error = try? addingContext?.save(){
                print(error)
            }
            
            if let error = try? fetchedResultsController.managedObjectContext.save(){
                print(error)
            }
        }
        
        self.dismiss(animated: true, completion: nil)
    }

     // MARK: - Navigation

     //In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        if segue.identifier == "AddBook" {
            let navigation = segue.destination as! UINavigationController
            
            let addViewController = navigation.topViewController as! AddViewController
            addViewController.delegate = self
            
            let addingContext = NSManagedObjectContext(concurrencyType: NSManagedObjectContextConcurrencyType.mainQueueConcurrencyType)
            addingContext.parent = self.fetchedResultsController.managedObjectContext
            
            let newBook:Book = NSEntityDescription.insertNewObject(forEntityName: "Book", into: addingContext) as! Book
            
            addViewController.book = newBook
            addViewController.managedContext = addingContext
        }
    }

}
