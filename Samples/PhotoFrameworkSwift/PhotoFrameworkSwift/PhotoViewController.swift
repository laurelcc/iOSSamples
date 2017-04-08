//
//  ViewController.swift
//  PhotoFrameworkSwift
//
//  Created by MacSong on 16/4/17.
//  Copyright © 2016年 MacSong. All rights reserved.
//

import UIKit

class PhotoViewController: UIViewController, UINavigationControllerDelegate, UIImagePickerControllerDelegate {

    @IBOutlet weak var photoImageView: UIImageView!
    @IBOutlet weak var bottomToolbar: UIToolbar!
    
    
    @IBOutlet weak var showImagesItemButton: UIBarButtonItem!
    @IBOutlet weak var cameraItemButton: UIBarButtonItem!

    @IBOutlet weak var cameraDoneItemButton: UIBarButtonItem!
    @IBOutlet weak var cameraSanpItemButton: UIBarButtonItem!
    @IBOutlet weak var cameraDelayItemButton: UIBarButtonItem!
    @IBOutlet weak var cameraStartItemButton: UIBarButtonItem!
    
    
    @IBOutlet var overlayView: UIView!
    var capturedImages:[UIImage] = []
    
    var cameraTimer:NSTimer? = nil
    
    var imagePickerController:UIImagePickerController? = nil

    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
        
        if !UIImagePickerController.isSourceTypeAvailable(UIImagePickerControllerSourceType.Camera){
            bottomToolbar.items?[2].enabled = false
        }

        showImagesItemButton.target = self
        showImagesItemButton.action = Selector("showImagePickerForPhotoPicker")
        
        cameraItemButton.target = self
        cameraItemButton.action = #selector(self.showImagePickerForCamera)
        
        self.imagePickerController = UIImagePickerController()
        self.imagePickerController?.delegate = self
        
        cameraDoneItemButton.target = self
        cameraDoneItemButton.action = Selector("cameraDoneClick")
        
        cameraSanpItemButton.target = self
        cameraSanpItemButton.action = #selector(self.cameraSnapButtonClick)
        
        cameraDelayItemButton.target = self
        cameraDelayItemButton.action = #selector(self.cameraDelayButtonClick)
        
        cameraStartItemButton.target = self
        cameraStartItemButton.action = Selector("cameraStartTakePictureAtInterval")
        
//        self.definesPresentationContext = false
    }
    
    func cameraDoneClick(){
        self.dismissViewControllerAnimated(true, completion: nil)
    }
    
    func cameraSnapButtonClick(){
        self.imagePickerController?.takePicture()
    }
    
    func cameraDelayButtonClick(){
        self.cameraDoneItemButton.enabled = false
        cameraDelayItemButton.enabled = false
        cameraSanpItemButton.enabled = false
        cameraStartItemButton.enabled = false
        
        let fireDate = NSDate(timeIntervalSinceNow: 3)
        self.cameraTimer = NSTimer(fireDate: fireDate, interval: 1, target: self, selector: #selector(self.timedPhotoFire(_:)), userInfo: nil, repeats: false)
        
        self.cameraTimer?.fire()
    }
    
    func cameraStartTakePictureAtInterval(){
        self.cameraStartItemButton.action = "stopTakingPicturesAtIntervals"
        self.cameraStartItemButton.title = "Stop"
        
        self.cameraDoneItemButton.enabled = false
        cameraSanpItemButton.enabled = false
        cameraDelayItemButton.enabled = false
        
        self.cameraTimer = NSTimer(timeInterval: 1.5, target: self, selector: "timedPhotoFire:", userInfo: nil, repeats: true)
        
        self.cameraTimer?.fire()
    }
    
    func stopTakingPicturesAtIntervals(){
        self.cameraTimer?.invalidate()
//        self.cameraTimer = nil
        
        self.finishAndUpdate()
    }
    
    func timedPhotoFire(timer:NSTimer){
        self.imagePickerController?.takePicture()
    }
    
    
    
    func showImagePickerForPhotoPicker(){
        showImagePickerForSourceType(.PhotoLibrary)
    }
    
    func showImagePickerForCamera(){
        showImagePickerForSourceType(.Camera)
    }
    
    
    
    func showImagePickerForSourceType(sourceType: UIImagePickerControllerSourceType){
        
        if self.photoImageView.isAnimating(){
            self.photoImageView.stopAnimating()
        }
        
        self.imagePickerController?.modalPresentationStyle = UIModalPresentationStyle.CurrentContext
        self.imagePickerController?.sourceType = sourceType
        
        if sourceType == UIImagePickerControllerSourceType.Camera{
            imagePickerController?.showsCameraControls = false
            
            print(UIImagePickerController.availableMediaTypesForSourceType(.Camera))
//            print(UIImagePickerController.availableMediaTypesForSourceType(.PhotoLibrary))
//            print(UIImagePickerController.availableMediaTypesForSourceType(.SavedPhotosAlbum))

//            imagePickerController?.mediaTypes = ["public.image"]
            
            imagePickerController?.cameraCaptureMode = .Photo
            self.overlayView.frame = self.view.frame
            
            imagePickerController?.cameraOverlayView = self.overlayView
        }
        
        self.presentViewController(self.imagePickerController!, animated: true, completion: nil)
    }
    
    func imagePickerController(picker: UIImagePickerController, didFinishPickingMediaWithInfo info: [String : AnyObject]) {
        let image = info["UIImagePickerControllerOriginalImage"] as! UIImage
        
        self.capturedImages.append(image)
        
        if self.cameraTimer != nil{
            return
        }
        
        /*
         ▿ 3 elements
         ▿ [0] : 2 elements
         - .0 : "UIImagePickerControllerMediaType"
         - .1 : public.image
         ▿ [1] : 2 elements
         - .0 : "UIImagePickerControllerOriginalImage"
         ▿ [2] : 2 elements
         - .0 : "UIImagePickerControllerReferenceURL"
         - .1 : assets-library://asset/asset.JPG?id=D137F09D-9D44-49AE-9B71-FA925C73C8B0&ext=JPG
         */
        self.finishAndUpdate()
    }
    
    func finishAndUpdate(){
        
        self.dismissViewControllerAnimated(true, completion: nil)
        
        if self.capturedImages.count>0{
            if self.capturedImages.count == 1{
                self.photoImageView.image = self.capturedImages[0]
            }else{
                self.photoImageView.animationImages = self.capturedImages
                self.photoImageView.animationDuration = 1
                self.photoImageView.animationRepeatCount = 0
                
                self.photoImageView.startAnimating()
                
            }
            self.capturedImages.removeAll()
        }
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }


}

