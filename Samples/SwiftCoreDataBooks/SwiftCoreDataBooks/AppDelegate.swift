//
//  AppDelegate.swift
//  SwiftCoreDataBooks
//
//  Created by htx on 2017/4/6.
//  Copyright © 2017年 soong. All rights reserved.
//

import UIKit
import CoreData

@UIApplicationMain
class AppDelegate: UIResponder, UIApplicationDelegate, NSFetchedResultsControllerDelegate {

    var window: UIWindow?

    // MARK: - 模型-上下文-存储协调
    lazy var managedObjectModel: NSManagedObjectModel? = {
        if let modelUrl = Bundle.main.url(forResource: "CoreDataBooks", withExtension: "momd"){
            
            let objectModel = NSManagedObjectModel(contentsOf: modelUrl)
            return objectModel
        }
        
        return nil
    }()
    
    lazy var managedObjectContext: NSManagedObjectContext? = {
        if let coordinator = self.persistentStoreCoordinator{
            
            let context = NSManagedObjectContext(concurrencyType: NSManagedObjectContextConcurrencyType.mainQueueConcurrencyType)
            context.persistentStoreCoordinator = coordinator
            
            return context
        }
        
        return nil
    }()

    lazy var persistentStoreCoordinator: NSPersistentStoreCoordinator? = {
        
        let storeURL:URL = self.applicationDocumentDirectory()!.appendingPathComponent("CoreDataBooks.CDBStore")
        
        let manager:FileManager = FileManager.default
        
        if !manager.fileExists(atPath: storeURL.absoluteString){
            if let defaultStoreURL = Bundle.main.url(forResource: "CoreDataBooks", withExtension: "CDBStore"){
                try? manager.copyItem(atPath: defaultStoreURL.absoluteString, toPath: storeURL.absoluteString)
            }
        }
        
        let options:[String: Any] = [NSMigratePersistentStoresAutomaticallyOption: true,
                                     NSInferMappingModelAutomaticallyOption: true]
        let coordinator:NSPersistentStoreCoordinator = NSPersistentStoreCoordinator(managedObjectModel: self.managedObjectModel!)
        if let error = try? coordinator.addPersistentStore(ofType: NSSQLiteStoreType, configurationName: nil, at: storeURL, options: options){
            //错误处理
            
            return nil
        }
        
        return coordinator
    }()

    func application(_ application: UIApplication, didFinishLaunchingWithOptions launchOptions: [UIApplicationLaunchOptionsKey: Any]?) -> Bool {
        // Override point for customization after application launch.
        return true
    }

    func applicationWillResignActive(_ application: UIApplication) {
        // Sent when the application is about to move from active to inactive state. This can occur for certain types of temporary interruptions (such as an incoming phone call or SMS message) or when the user quits the application and it begins the transition to the background state.
        // Use this method to pause ongoing tasks, disable timers, and invalidate graphics rendering callbacks. Games should use this method to pause the game.
        
        self.saveContext()
    }

    func applicationDidEnterBackground(_ application: UIApplication) {
        // Use this method to release shared resources, save user data, invalidate timers, and store enough application state information to restore your application to its current state in case it is terminated later.
        // If your application supports background execution, this method is called instead of applicationWillTerminate: when the user quits.
        
        self.saveContext()
    }

    func applicationWillEnterForeground(_ application: UIApplication) {
        // Called as part of the transition from the background to the active state; here you can undo many of the changes made on entering the background.
    }

    func applicationDidBecomeActive(_ application: UIApplication) {
        // Restart any tasks that were paused (or not yet started) while the application was inactive. If the application was previously in the background, optionally refresh the user interface.
    }

    func applicationWillTerminate(_ application: UIApplication) {
        // Called when the application is about to terminate. Save data if appropriate. See also applicationDidEnterBackground:.
        
        self.saveContext()
    }

    // MARK: - 保存上下文
    func saveContext() -> Void {
        if let context = managedObjectContext {
            if context.hasChanges {
                if let error = try? context.save(){
                    //存在错误
                    print(error)
                    
                    abort()
                }

            }
        }
    }
    
    
    // MARK: - 获取应用程序的主主文件目录路径
    func applicationDocumentDirectory() -> URL? {
        return FileManager.default.urls(for: FileManager.SearchPathDirectory.documentDirectory, in: FileManager.SearchPathDomainMask.userDomainMask).last
    }

}

