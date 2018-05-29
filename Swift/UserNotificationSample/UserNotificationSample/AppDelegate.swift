//
//  AppDelegate.swift
//  UserNotificationSample
//
//  Created by Soong on 2017/12/17.
//  Copyright © 2017年 Soong. All rights reserved.
//

import UIKit
import UserNotifications

@UIApplicationMain
class AppDelegate: UIResponder, UIApplicationDelegate, UNUserNotificationCenterDelegate {

    var window: UIWindow?


    func application(_ application: UIApplication, didFinishLaunchingWithOptions launchOptions: [UIApplicationLaunchOptionsKey: Any]?) -> Bool {
        // Override point for customization after application launch.
        
        if #available(iOS 10, *) {
            //Register the notification previledge
            let current = UNUserNotificationCenter.current();
            current.delegate = self
            
            current.requestAuthorization(options: [.alert, .sound]) { [weak self] (granted, error) in
                if(granted){
                    print("Bingo, You can do send notification.")
                    self?.registerCategoryNotification()
                }else{
                    print(error ?? "Error occurs.")
                }
            }
        }
        
        return true
    }
    
    // MARK: UNUserNotificationCenterDelegate
    
    func userNotificationCenter(_ center: UNUserNotificationCenter, willPresent notification: UNNotification, withCompletionHandler completionHandler: @escaping (UNNotificationPresentationOptions) -> Void) {
        print("UserNotification will present")
        
        completionHandler(UNNotificationPresentationOptions.sound)
    }
    
    func userNotificationCenter(_ center: UNUserNotificationCenter, didReceive response: UNNotificationResponse, withCompletionHandler completionHandler: @escaping () -> Void) {
        if response.notification.request.content.categoryIdentifier == "TIME_EXPIRED" {
            if response.actionIdentifier == "SNOOZE_ACTION" {
                print("SNOOZE ACTION")
            }
            
            print(response.actionIdentifier)
            
            completionHandler()
        }
    }
    
    func registerCategoryNotification() -> Void {
        
        //Step 1
        let snoozeAction = UNNotificationAction(identifier: "SNOOZE_ACTION", title: "Snooze", options: UNNotificationActionOptions(rawValue: 0))
        let stopAction = UNNotificationAction(identifier: "STOP_ACTION", title: "Stop", options: UNNotificationActionOptions.foreground)
        
        //Step 2
        let category = UNNotificationCategory(identifier: "TIME_EXPIRED", actions: [snoozeAction, stopAction], intentIdentifiers: [], options: UNNotificationCategoryOptions(rawValue: 0))
        
        //Step 3
        let center = UNUserNotificationCenter.current();
        center.setNotificationCategories([category])
    }
    
    func application(_ application: UIApplication, didRegisterForRemoteNotificationsWithDeviceToken deviceToken: Data) {
        
    }
    

    func applicationWillResignActive(_ application: UIApplication) {
        // Sent when the application is about to move from active to inactive state. This can occur for certain types of temporary interruptions (such as an incoming phone call or SMS message) or when the user quits the application and it begins the transition to the background state.
        // Use this method to pause ongoing tasks, disable timers, and invalidate graphics rendering callbacks. Games should use this method to pause the game.
    }

    func applicationDidEnterBackground(_ application: UIApplication) {
        // Use this method to release shared resources, save user data, invalidate timers, and store enough application state information to restore your application to its current state in case it is terminated later.
        // If your application supports background execution, this method is called instead of applicationWillTerminate: when the user quits.
    }

    func applicationWillEnterForeground(_ application: UIApplication) {
        // Called as part of the transition from the background to the active state; here you can undo many of the changes made on entering the background.
    }

    func applicationDidBecomeActive(_ application: UIApplication) {
        // Restart any tasks that were paused (or not yet started) while the application was inactive. If the application was previously in the background, optionally refresh the user interface.
    }

    func applicationWillTerminate(_ application: UIApplication) {
        // Called when the application is about to terminate. Save data if appropriate. See also applicationDidEnterBackground:.
    }


}

