//
//  ViewController.swift
//  UserNotificationSample
//
//  Created by Soong on 2017/12/17.
//  Copyright © 2017年 Soong. All rights reserved.
//

import UIKit
import UserNotifications

class ViewController: UIViewController {

    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
        
        
        
        
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }

    @IBAction func addLocalNotificationAction(_ sender: UIButton) {
        //Step 1
        let content = UNMutableNotificationContent()
        content.title = "Wake Up!"
        content.body = "It is morning time!"
        content.categoryIdentifier = "TIME_EXPIRED"
        
        //Step 2
        var minute = DateComponents();
        minute.second = 10
        let trigger = UNCalendarNotificationTrigger(dateMatching: minute, repeats: true)
        
        //Step 3
        let request = UNNotificationRequest(identifier: "MorningAlarm", content: content, trigger: trigger)
        let center = UNUserNotificationCenter.current()
        center.add(request) { (error) in
            if let err = error{
                print(err.localizedDescription)
            }
        }
    }
    
    @IBAction func removeNotification(_ sender: Any) {
        let current = UNUserNotificationCenter.current()
        current.removePendingNotificationRequests(withIdentifiers: ["MorningAlarm"])
        
    }
    

}

