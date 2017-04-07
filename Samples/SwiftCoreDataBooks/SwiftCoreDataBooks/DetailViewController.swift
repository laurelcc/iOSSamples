//
//  DetailViewController.swift
//  SwiftCoreDataBooks
//
//  Created by htx on 2017/4/7.
//  Copyright © 2017年 soong. All rights reserved.
//

import UIKit

class DetailViewController: UITableViewController {

    var book:Book!
    @IBOutlet weak var titleLabel: UILabel!
    @IBOutlet weak var authorLabel: UILabel!
    @IBOutlet weak var copyrightLabel: UILabel!
    
    lazy var dateFmt:DateFormatter = {
        let fmt = DateFormatter()
        
        fmt.dateStyle = .medium
        fmt.timeStyle = .none
        
        return fmt
    }()
    
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        if self.isKind(of: DetailViewController.self) {
            self.navigationItem.rightBarButtonItem = self.editButtonItem
        }
        
        self.tableView.allowsSelectionDuringEditing = true
        
        NotificationCenter.default.addObserver(self, selector: #selector(DetailViewController.localeChanged), name: NSLocale.currentLocaleDidChangeNotification, object: nil)
    }
    
    // MARK: - 析构函数
    
    deinit {
        NotificationCenter.default.removeObserver(self, name: NSLocale.currentLocaleDidChangeNotification, object: nil)
    }
    
    //区域设置已变更
    func localeChanged() -> Void {
        self.updateInterface()
    }
    
    override func viewWillAppear(_ animated: Bool) {
        super.viewWillAppear(animated)
        
        self.updateInterface()
        
    }
    
    func updateRightBarButtonItemState() -> Void {
        if let _ = try? self.book.validateForUpdate(){
            self.navigationItem.rightBarButtonItem?.isEnabled = false
        }else{
            self.navigationItem.rightBarButtonItem?.isEnabled = true
        }
    }
    
    func updateInterface() -> Void {
        self.authorLabel.text = book.author
        self.titleLabel.text = book.title
        self.copyrightLabel.text = dateFmt.string(from: book.copyright!)
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }

    // MARK: - Table view data source
    
    override func tableView(_ tableView: UITableView, willSelectRowAt indexPath: IndexPath) -> IndexPath? {
        if self.isEditing {
            return indexPath
        }
        
        return nil
    }
    
    override func tableView(_ tableView: UITableView, editingStyleForRowAt indexPath: IndexPath) -> UITableViewCellEditingStyle {
        return UITableViewCellEditingStyle.none
    }
    
    override func tableView(_ tableView: UITableView, shouldIndentWhileEditingRowAt indexPath: IndexPath) -> Bool {
        return false
    }
    
    
    override func setEditing(_ editing: Bool, animated: Bool) {
        super.setEditing(editing, animated: animated)
        
        self.navigationItem.setHidesBackButton(editing, animated: animated)
        
        if editing {
            self.setUpUndoManager()
        }else{
            self.cleanUpUndoManager()
            
            //保存输入
            if let error = try? self.book.managedObjectContext?.save(){
                //打印错误
                print(error ?? "error nil")
            }
        }
    }
    
    
    
    // MARK: - Undo manager
    
    func setUpUndoManager() -> Void {
        if self.book.managedObjectContext?.undoManager == nil {
            let undo = UndoManager()
            undo.levelsOfUndo = 3
            
            self.book.managedObjectContext?.undoManager = undo
        }
        
        if let bookUndo = self.book.managedObjectContext?.undoManager{
            let dnc = NotificationCenter.default
            dnc.addObserver(self, selector: #selector(DetailViewController.undoManagerDidUndo), name: NSNotification.Name.NSUndoManagerDidUndoChange, object: bookUndo)
            dnc.addObserver(self, selector: #selector(DetailViewController.undoManagerDidRedo), name: NSNotification.Name.NSUndoManagerDidRedoChange, object: bookUndo)
        }
    }
    
    func cleanUpUndoManager() -> Void {
        if let bookUndo = self.book.managedObjectContext?.undoManager{
            NotificationCenter.default.removeObserver(self, name: NSNotification.Name.NSUndoManagerDidUndoChange, object: bookUndo)
            NotificationCenter.default.removeObserver(self, name: NSNotification.Name.NSUndoManagerDidRedoChange, object: bookUndo)
        }
        
        self.book.managedObjectContext?.undoManager = nil
    }
    
    func undoManagerDidUndo() -> Void {
        self.updateInterface()
        self.updateRightBarButtonItemState()
    }
    
    func undoManagerDidRedo() -> Void {
        self.updateInterface()
        self.updateRightBarButtonItemState()
    }
    
    /*
     The view controller must be first responder in order to be able to receive shake events for undo. It should resign first responder status when it disappears.
     */
    override var canBecomeFirstResponder: Bool{
        return true
    }
    
    override func viewDidAppear(_ animated: Bool) {
        super.viewDidAppear(animated)
        
        self.becomeFirstResponder()
    }
    
    override func viewWillDisappear(_ animated: Bool) {
        super.viewWillDisappear(animated)
        
        self.resignFirstResponder()
    }
    

}
