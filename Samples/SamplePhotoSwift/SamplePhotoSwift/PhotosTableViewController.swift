//
//  PhotosTableViewController.swift
//  SamplePhotoSwift
//
//  Created by huanfeng001 on 16/4/6.
//  Copyright © 2016年 huanfeng001. All rights reserved.
//

import UIKit
import Photos

class PhotosTableViewController: UITableViewController, PHPhotoLibraryChangeObserver {

    let allPhotosCellIdentifier = "allPhotosCell"
    let collectionCellIdentifier = "collectionCell"
    
    var sectionFetchResults:NSArray = []
    var sectionLocalizedTitles:NSArray = []
    
    override func viewDidLoad() {
        super.viewDidLoad()

        // Uncomment the following line to preserve selection between presentations
        // self.clearsSelectionOnViewWillAppear = false

        // Uncomment the following line to display an Edit button in the navigation bar for this view controller.
        // self.navigationItem.rightBarButtonItem = self.editButtonItem()
        
        let fetchOptions:PHFetchOptions = PHFetchOptions()
        fetchOptions.sortDescriptors = [NSSortDescriptor(key:"creationDate", ascending: true)]
        
        let allPhotos = PHAsset.fetchAssetsWithOptions(fetchOptions)
        let smartAlbums = PHAssetCollection.fetchAssetCollectionsWithType(PHAssetCollectionType.SmartAlbum, subtype: PHAssetCollectionSubtype.AlbumRegular, options: nil)
        let topLevelUserCollections:PHFetchResult = PHCollection.fetchTopLevelUserCollectionsWithOptions(nil)
        
        self.sectionFetchResults = [allPhotos, smartAlbums, topLevelUserCollections]
        self.sectionLocalizedTitles = ["", NSLocalizedString("智能相册", comment: ""), NSLocalizedString("相册", comment: "")]
    }
    
    override func viewWillAppear(animated: Bool) {
        super.viewWillAppear(animated)
        
        PHPhotoLibrary.sharedPhotoLibrary().registerChangeObserver(self)
    }
    
    override func viewWillDisappear(animated: Bool) {
        super.viewWillDisappear(animated)
        
        PHPhotoLibrary.sharedPhotoLibrary().unregisterChangeObserver(self)
    }
    
    func photoLibraryDidChange(changeInstance: PHChange) {
        
        dispatch_async(dispatch_get_main_queue()) {
            let updatedSectionFetchResults = self.sectionFetchResults.mutableCopy()
            var reloadRequired:Bool = false
            
            self.sectionFetchResults.enumerateObjectsUsingBlock { (collectionsFetchResult, index, stop) in
                let changeDetails = changeInstance.changeDetailsForFetchResult(collectionsFetchResult as! PHFetchResult)
                
                if changeDetails != nil{
                    updatedSectionFetchResults.replaceObjectAtIndex(index, withObject: changeDetails!.fetchResultAfterChanges)
                    
                    reloadRequired = true
                }
            }
            
            if reloadRequired{
                self.sectionFetchResults = updatedSectionFetchResults as! NSArray
                
                self.tableView.reloadData()
            }
        }

    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }

    // MARK: - Table view data source

    override func numberOfSectionsInTableView(tableView: UITableView) -> Int {
        // #warning Incomplete implementation, return the number of sections
        return self.sectionFetchResults.count
    }

    override func tableView(tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        // #warning Incomplete implementation, return the number of rows
        var numberOfRows = 0
        
        if section == 0{
            numberOfRows = 1
        }else{
            let fetchResult = self.sectionFetchResults[section]
            numberOfRows = fetchResult.count
        }
        
        return numberOfRows
    }

    override func tableView(tableView: UITableView, cellForRowAtIndexPath indexPath: NSIndexPath) -> UITableViewCell {
        var cell:UITableViewCell?
        
        if indexPath.section == 0{
            cell = tableView.dequeueReusableCellWithIdentifier(self.allPhotosCellIdentifier, forIndexPath: indexPath)
            cell?.textLabel?.text = NSLocalizedString("所有相片", comment: "")
        }else{
            let fetchResult:PHFetchResult = self.sectionFetchResults[indexPath.section] as! PHFetchResult
            let collection:PHCollection = fetchResult[indexPath.row] as! PHCollection
            
            cell = tableView.dequeueReusableCellWithIdentifier(self.collectionCellIdentifier, forIndexPath: indexPath)
            cell?.textLabel?.text = collection.localizedTitle
        }
        
        return cell!
    }
    
    override func tableView(tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        return self.sectionLocalizedTitles[section] as? String
    }

    /*
    // Override to support conditional editing of the table view.
    override func tableView(tableView: UITableView, canEditRowAtIndexPath indexPath: NSIndexPath) -> Bool {
        // Return false if you do not want the specified item to be editable.
        return true
    }
    */

    /*
    // Override to support editing the table view.
    override func tableView(tableView: UITableView, commitEditingStyle editingStyle: UITableViewCellEditingStyle, forRowAtIndexPath indexPath: NSIndexPath) {
        if editingStyle == .Delete {
            // Delete the row from the data source
            tableView.deleteRowsAtIndexPaths([indexPath], withRowAnimation: .Fade)
        } else if editingStyle == .Insert {
            // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view
        }    
    }
    */

    /*
    // Override to support rearranging the table view.
    override func tableView(tableView: UITableView, moveRowAtIndexPath fromIndexPath: NSIndexPath, toIndexPath: NSIndexPath) {

    }
    */

    /*
    // Override to support conditional rearranging of the table view.
    override func tableView(tableView: UITableView, canMoveRowAtIndexPath indexPath: NSIndexPath) -> Bool {
        // Return false if you do not want the item to be re-orderable.
        return true
    }
    */

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepareForSegue(segue: UIStoryboardSegue, sender: AnyObject?) {
        // Get the new view controller using segue.destinationViewController.
        // Pass the selected object to the new view controller.
    }
    */

}
