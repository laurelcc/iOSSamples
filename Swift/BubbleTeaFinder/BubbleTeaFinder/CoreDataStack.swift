//
//  CoreDataStack.swift
//  BubbleTeaFinder
//
//  Created by HSoong on 2018/10/7.
//  Copyright © 2018 HSoong. All rights reserved.
//

import CoreData

class CoreDataStack {
    private let modelName: String
    
    init(modelName: String) {
        self.modelName = modelName
    }
    
    private lazy var storeContainer: NSPersistentContainer = {
        let container = NSPersistentContainer(name: self.modelName)
        container.loadPersistentStores(completionHandler: { (description, error) in
            if let error = error as NSError? {
                print("Unresolved error \(error), \(error.userInfo)")
            }
        })
        return container
    }()
    
    lazy var managedContext: NSManagedObjectContext = {
       return self.storeContainer.viewContext
    }()
    
    func saveContext() {
        guard managedContext.hasChanges else {
            return
        }
        
        do {
            try managedContext.save()
        }
        catch let error as NSError {
            print("Unsolved error \(error), \(error.userInfo)")
        }
    }
}
