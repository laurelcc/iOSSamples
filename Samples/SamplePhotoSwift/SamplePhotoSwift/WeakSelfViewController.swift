//
//  WeakSelfViewController.swift
//  SamplePhotoSwift
//
//  Created by MacSong on 16/4/7.
//  Copyright © 2016年 huanfeng001. All rights reserved.
//

import UIKit

class WeakSelfViewController: UIViewController {

    deinit {
        print("WeakSelf Controller has been destroyed.", NSDate())
    }
    
    override func viewDidLoad() {
        super.viewDidLoad()

        // Do any additional setup after loading the view.
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
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
