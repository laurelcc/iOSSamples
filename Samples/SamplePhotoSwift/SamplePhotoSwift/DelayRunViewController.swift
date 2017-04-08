//
//  DelayRunViewController.swift
//  SamplePhotoSwift
//
//  Created by MacSong on 16/4/7.
//  Copyright © 2016年 huanfeng001. All rights reserved.
//

import UIKit

class DelayRunViewController: UIViewController {

    override func viewDidLoad() {
        super.viewDidLoad()

        // Do any additional setup after loading the view.
    }
    
    deinit {
        print("DelayRun Controller has been destroyed.", NSDate())
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    @IBAction func delayRunButton(sender: UIButton) {

        self.navigationController?.popViewControllerAnimated(true)
 
        dispatch_after(dispatch_time(DISPATCH_TIME_NOW, 3 * Int64(NSEC_PER_SEC)), dispatch_get_main_queue()) {
            [weak self]() -> Void
            in
            if let _ = self{
                print("当self已经还在生存期的时候，执行")
            }else{
                print("当self已被gac收回时，执行")
            }
            
        }
        
        
    }

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepareForSegue(segue: UIStoryboardSegue, sender: AnyObject?) {
        // Get the new view controller using segue.destinationViewController.
        // Pass the selected object to the new view controller.
    }
    */

}
