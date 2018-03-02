//
//  ViewController.swift
//  CustomTransitionsSwift
//
//  Created by Soong on 2017/12/19.
//  Copyright © 2017年 soong. All rights reserved.
//

import UIKit

class ViewController: UIViewController {

    override func viewDidLoad() {
        super.viewDidLoad()

        // Do any additional setup after loading the view.
        
//        atomic_thread_fence(memory_order)
        
//        OSAtomicOr32(UInt32, UnsafeMutablePointer<UInt32>!)
        
//        atomic_fetch_add_explicit()
        
        
        let nslock = NSLock()
        nslock.lock()
        // to-do works
        nslock.unlock()
        
//        var k:Int32 = 0
//        OSAtomicTestAndSet(12, &k)

//        var mutexattr = pthread_mutexattr_t()
        var mutex = pthread_mutex_t()
        pthread_mutex_init(&mutex, nil)
        pthread_mutex_lock(&mutex)
        pthread_mutex_unlock(&mutex)
        
        let recursive = NSRecursiveLock()
        if recursive.try() {
            // to-do works
            recursive.unlock()
        }
        
        
        
        
        
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
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
