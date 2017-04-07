//
//  AddViewController.swift
//  SwiftCoreDataBooks
//
//  Created by htx on 2017/4/7.
//  Copyright © 2017年 soong. All rights reserved.
//

import UIKit
import CoreData

class AddViewController: DetailViewController {

    weak var delegate: AddViewControllerDelegate?
    var managedContext:NSManagedObjectContext!
    
    override func viewDidLoad() {
        super.viewDidLoad()

        self.setUpUndoManager()
        
        self.isEditing = false
    }
    
    deinit {
        self.cleanUpUndoManager()
    }
    
    @IBAction func cancel(_ sender: Any) {
        self.delegate?.addViewController(controller: self, didFinishWithSave: false)
    }
    
    @IBAction func save(_ sender: Any) {
        self.delegate?.addViewController(controller: self, didFinishWithSave: false)
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
