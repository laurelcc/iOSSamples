//
//  CustomPresentationFirstViewController.swift
//  CustomTransitionsSwift
//
//  Created by htx on 2017/4/24.
//  Copyright © 2017年 soong. All rights reserved.
//

import UIKit

class CustomPresentationFirstViewController: UIViewController {
    
    override func viewDidLoad() {
        super.viewDidLoad()

        // Do any additional setup after loading the view.
    }
    
    

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }

    @IBAction func buttonAction(_ sender: UIButton) {
        let secondController = storyboard?.instantiateViewController(withIdentifier: "storyCustomPresentationSecondController")
        
        let cpc = CustomPresentationController(presentedViewController: secondController!, presenting: self)
        
        withExtendedLifetime(cpc) { () -> Void in
            secondController?.transitioningDelegate = cpc
        }
        
        secondController?.modalPresentationStyle = .custom
        
        present(secondController!, animated: true, completion: nil)
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
