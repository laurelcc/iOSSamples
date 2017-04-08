//
//  AssetCollectionViewController.swift
//  SamplePhotoSwift
//
//  Created by huanfeng001 on 16/4/6.
//  Copyright © 2016年 huanfeng001. All rights reserved.
//

import UIKit
import PhotosUI

extension AssetCollectionViewController: PHPhotoLibraryChangeObserver{
    func photoLibraryDidChange(changeInstance: PHChange) {
        
    }
}

extension UICollectionView{
    func aapl_indexPathsForElementsInRect(rect:CGRect)->NSArray?{
        let allLayoutAttributes = self.collectionViewLayout.layoutAttributesForElementsInRect(rect)
        
        guard let attributes = allLayoutAttributes else {return nil}
        
        if attributes.count == 0{
            return nil
        }
        
        let indexPaths = NSMutableArray(capacity: attributes.count)
        
        for layoutAttributes in attributes{
            let indexPath = layoutAttributes.indexPath
            
            indexPaths.addObject(indexPath)
        }
        
        return indexPaths
    }
}

class AssetCollectionViewController: UICollectionViewController {

    private let reuseIdentifier = "Cell"
    
    @IBOutlet var addButton: UIBarButtonItem!
    
    var imageManager:PHCachingImageManager = PHCachingImageManager()
    var previousPreheatRect:CGRect = CGRect.zero
    var assetGridThumbnailSize = CGSize.zero
    
    var assetsFetchResults:PHFetchResult?
    var assetCollection:PHAssetCollection?
    
    override func viewDidLoad() {
        super.viewDidLoad()
        self.collectionView!.registerClass(UICollectionViewCell.self, forCellWithReuseIdentifier: reuseIdentifier)
        self.resetCachedAssets()
        PHPhotoLibrary.sharedPhotoLibrary().registerChangeObserver(self)
    }
    
    override func viewWillAppear(animated: Bool) {
        super.viewWillAppear(animated)
        
        let scale = UIScreen.mainScreen().scale
        let cellSize = (self.collectionViewLayout as! UICollectionViewFlowLayout).itemSize
        assetGridThumbnailSize = CGSizeMake(cellSize.width * scale, cellSize.height * scale)
        
        if let collection = self.assetCollection where collection.canPerformEditOperation(PHCollectionEditOperation.AddContent){
            self.navigationItem.rightBarButtonItem = self.addButton
        }else{
            self.navigationItem.rightBarButtonItem = nil
        }

    }
    
    override func viewDidAppear(animated: Bool) {
        super.viewDidAppear(animated)
        
        self.updateCachedAssets()
    }

    private func updateCachedAssets(){
        let isViewVisible = self.isViewLoaded()
        guard isViewVisible else{return}
     
        var preheatRect = self.collectionView?.bounds
        preheatRect = CGRectInset(preheatRect!, 0, -0.5 * CGRectGetHeight(preheatRect!))
        
        let delta = abs(CGRectGetMidY(preheatRect!) - CGRectGetMidY(self.previousPreheatRect))
        
        if delta > CGRectGetHeight(self.collectionView!.bounds)/3{
            
            //计算
            let addedIndexPaths = NSMutableArray()
            let removedIndexPaths = NSMutableArray()

            computeDifferenceBetweenRect(self.previousPreheatRect, andRect: preheatRect!, removedHandler: { (removedRect) -> Void in
                if let indexPaths = self.collectionView?.aapl_indexPathsForElementsInRect(removedRect){
                    removedIndexPaths.addObjectsFromArray(indexPaths as [AnyObject])
                }
                
                }, addedHandler: { (addedRect) -> Void in
                    if let indexPaths = self.collectionView?.aapl_indexPathsForElementsInRect(addedRect){
                        addedIndexPaths.addObjectsFromArray(indexPaths as [AnyObject])
                    }
            })
            
            let assetsToStartCaching = self.assetsAtIndexPaths(addedIndexPaths)
            let assetsToStopCaching = self.assetsAtIndexPaths(removedIndexPaths)
            
            self.imageManager.startCachingImagesForAssets(assetsToStartCaching! as! [PHAsset], targetSize: assetGridThumbnailSize, contentMode: PHImageContentMode.AspectFill, options: nil)
            self.imageManager.stopCachingImagesForAssets(assetsToStopCaching! as! [PHAsset], targetSize: assetGridThumbnailSize, contentMode: PHImageContentMode.AspectFill, options: nil)
            
            self.previousPreheatRect = preheatRect!
        }
    }
    
    func assetsAtIndexPaths(indexPaths:NSArray)->NSArray?{
        guard indexPaths.count > 0 else{return nil}
        
        let assets = NSMutableArray(capacity: indexPaths.count)
        for indexPath in indexPaths{
            let asset:PHAsset = self.assetsFetchResults![indexPath.row] as! PHAsset
            
            assets.addObject(asset)
        }
        
        return assets
    }
    
    func computeDifferenceBetweenRect(oldRect:CGRect, andRect newRect:CGRect, removedHandler:((removedRect:CGRect)->Void), addedHandler:((addedRect:CGRect)->Void)){
        
        if CGRectIntersectsRect(newRect, oldRect){
            let oldMaxY = CGRectGetMaxY(oldRect)
            let oldMinY = CGRectGetMinY(oldRect)
            
            let newMaxY = CGRectGetMaxY(newRect)
            let newMinY = CGRectGetMinY(newRect)
            
            if newMaxY > oldMaxY{
                let rectToAdd = CGRectMake(newRect.origin.x, oldMaxY, newRect.size.width, (newMaxY - oldMaxY))
                addedHandler(addedRect: rectToAdd)
            }
            
            if newMaxY < oldMaxY{
                let rectToAdd = CGRectMake(newRect.origin.x, oldMinY, newRect.size.width, (oldMinY - newMinY))
                addedHandler(addedRect: rectToAdd)
            }
            
            if newMaxY < oldMaxY{
                let rectToRemove = CGRectMake(newRect.origin.x, newMaxY, newRect.size.width, (oldMaxY - newMaxY))
                removedHandler(removedRect: rectToRemove)
            }
            
            if oldMinY < newMinY{
                let rectToRemove = CGRectMake(newRect.origin.x, oldMinY, newRect.size.width, (newMinY - oldMinY))
                
                removedHandler(removedRect: rectToRemove)
            }
            
        }else{
            addedHandler(addedRect: newRect)
            removedHandler(removedRect: oldRect)
        }
        
        
    }
    
    private func resetCachedAssets(){
        self.imageManager.stopCachingImagesForAllAssets()
        self.previousPreheatRect = CGRect.zero
    }
    
    override func viewWillDisappear(animated: Bool) {
        super.viewWillDisappear(animated)
        
        PHPhotoLibrary.sharedPhotoLibrary().unregisterChangeObserver(self)
    }
    

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepareForSegue(segue: UIStoryboardSegue, sender: AnyObject?) {
        // Get the new view controller using [segue destinationViewController].
        // Pass the selected object to the new view controller.
    }
    */

    // MARK: UICollectionViewDataSource

    override func numberOfSectionsInCollectionView(collectionView: UICollectionView) -> Int {
        // #warning Incomplete implementation, return the number of sections
        return 0
    }


    override func collectionView(collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        // #warning Incomplete implementation, return the number of items
        return 0
    }

    override func collectionView(collectionView: UICollectionView, cellForItemAtIndexPath indexPath: NSIndexPath) -> UICollectionViewCell {
        let cell = collectionView.dequeueReusableCellWithReuseIdentifier(reuseIdentifier, forIndexPath: indexPath)
    
        // Configure the cell
    
        return cell
    }

    // MARK: UICollectionViewDelegate

    /*
    // Uncomment this method to specify if the specified item should be highlighted during tracking
    override func collectionView(collectionView: UICollectionView, shouldHighlightItemAtIndexPath indexPath: NSIndexPath) -> Bool {
        return true
    }
    */

    /*
    // Uncomment this method to specify if the specified item should be selected
    override func collectionView(collectionView: UICollectionView, shouldSelectItemAtIndexPath indexPath: NSIndexPath) -> Bool {
        return true
    }
    */

    /*
    // Uncomment these methods to specify if an action menu should be displayed for the specified item, and react to actions performed on the item
    override func collectionView(collectionView: UICollectionView, shouldShowMenuForItemAtIndexPath indexPath: NSIndexPath) -> Bool {
        return false
    }

    override func collectionView(collectionView: UICollectionView, canPerformAction action: Selector, forItemAtIndexPath indexPath: NSIndexPath, withSender sender: AnyObject?) -> Bool {
        return false
    }

    override func collectionView(collectionView: UICollectionView, performAction action: Selector, forItemAtIndexPath indexPath: NSIndexPath, withSender sender: AnyObject?) {
    
    }
    */

}
