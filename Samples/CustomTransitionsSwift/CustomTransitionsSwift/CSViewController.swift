//
//  CSViewController.swift
//  CustomTransitionsSwift
//
//  Created by htx on 2017/4/24.
//  Copyright © 2017年 soong. All rights reserved.
//

import UIKit
import UserNotifications

class CSViewController: UIViewController, UIViewControllerRestoration {
    
    @IBOutlet weak var slider: UISlider!

    static func viewController(withRestorationIdentifierPath identifierComponents: [Any], coder: NSCoder) -> UIViewController? {
        
        return nil
    }
    
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        
        
        // Do any additional setup after loading the view.
        updatePreferredContentSizeWithTraitCollection(trait: self.traitCollection)
    }
    
    func updatePreferredContentSizeWithTraitCollection(trait: UITraitCollection) -> Void {
        self.preferredContentSize = CGSize(width: self.view.bounds.size.width, height: trait.verticalSizeClass == UIUserInterfaceSizeClass.compact ? 300 : 450)
        
        slider.maximumValue = Float(self.preferredContentSize.height)
        slider.minimumValue = 200
        
        slider.value = self.slider.maximumValue
    }
    
    @IBAction func sliderAction(_ sender: UISlider) {
        self.preferredContentSize = CGSize(width: self.view.bounds.size.width, height: CGFloat(sender.value))
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
