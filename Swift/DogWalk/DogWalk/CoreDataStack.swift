//
//  CoreDataStack.swift
//  DogWalk
//
//  Created by Soong on 2018/5/28.
//  Copyright © 2018年 Soong. All rights reserved.
//

import Foundation
import CoreData

class CoreDataStack {
    private let modelName: String
    
    init(modelName: String) {
        self.modelName = modelName
    }
    
    private lazy var storeContainer: NSPersistentContainer = {
        let container = NSPersistentContainer(name: self.modelName)
        container.loadPersistentStores(completionHandler: { (store, error) in
            if let err = error as NSError? {
                print("Unresolved error \(err), \(err.userInfo)")
            }
        })
        
        return container
    }()
    
    lazy var managedContext: NSManagedObjectContext = {
        return self.storeContainer.viewContext
    }()
    
    func saveContext() -> Void {
        guard self.managedContext.hasChanges else { return }
        
        do {
            try self.managedContext.save()
        } catch let error as NSError {
            print("Unresolved error \(error), error info \(error.userInfo)")
        }
    }
    
}
