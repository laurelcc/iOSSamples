//
//  CustomePresentationController.swift
//  CustomTransitionsSwift
//
//  Created by htx on 2017/4/24.
//  Copyright © 2017年 soong. All rights reserved.
//

import UIKit

class CustomPresentationController: UIPresentationController, UIViewControllerTransitioningDelegate, UIViewControllerAnimatedTransitioning {
    
    var presentationWrappingView:UIView!
    var dimmingView:UIView!
    
    var count:Int = 0
    
    override var presentedView: UIView?{
        return self.presentationWrappingView
    }
    
    fileprivate func logCount(log: String){
        print("The count is: \(count), Log: \(log)")
        count = count + 1
    }
    
    // MARK: -  PresentationController Funcs
    
    override func presentationTransitionWillBegin() {
        logCount(log: "Presentation Transition Will Begin")
        let presentedViewControllerView = super.presentedView
        
        let presentationWrapperView: UIView = UIView(frame: frameOfPresentedViewInContainerView)
        presentationWrapperView.layer.shadowOpacity = 0.44
        presentationWrapperView.layer.shadowRadius = 13
        presentationWrapperView.layer.shadowOffset = CGSize(width: 0, height: -1)
        
        self.presentationWrappingView = presentationWrapperView
        
        //当父容器的边界变动之后，自动调整宽度和高度
        let widthHeightAutoresizing = UIViewAutoresizing(rawValue: UIViewAutoresizing.flexibleWidth.rawValue | UIViewAutoresizing.flexibleHeight.rawValue)
        
        //圆角
        let roundedCornerView = UIView(frame: UIEdgeInsetsInsetRect(presentationWrappingView.bounds, UIEdgeInsets(top: 0, left: 10, bottom: 20, right: 10)))
        roundedCornerView.autoresizingMask = widthHeightAutoresizing
        roundedCornerView.layer.cornerRadius = 20
        roundedCornerView.layer.masksToBounds = true
        
        //presented view's wrapper
//        let presentedViewControllerWrapperView = UIView(frame: UIEdgeInsetsInsetRect(roundedCornerView.bounds, UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0)))
//        presentedViewControllerWrapperView.autoresizingMask = widthHeightAutoresizing
        
        //重新设定presented view controller的view大小
        presentedViewControllerView!.autoresizingMask = widthHeightAutoresizing
        presentedViewControllerView?.frame = roundedCornerView.bounds
        
        //将变更了bounds边界的presented view controller的view加入到wrapper中
//        presentedViewControllerWrapperView.addSubview(presentedViewControllerView!)
        
        //wrapper twice
        roundedCornerView.addSubview(presentedViewControllerView!)

        //wrapper third
        presentationWrapperView.addSubview(roundedCornerView)
        
        let dimmingView = UIView(frame: self.containerView!.bounds)
        dimmingView.backgroundColor = UIColor.black
        dimmingView.isOpaque = false
        dimmingView.autoresizingMask = widthHeightAutoresizing
        dimmingView.addGestureRecognizer(UITapGestureRecognizer(target: self, action: #selector(CustomPresentationController.dimmingViewTapped)))
        self.dimmingView = dimmingView
        
        //该container view来自于presentation controller
        self.containerView?.addSubview(dimmingView)
        
        let coordinator = self.presentedViewController.transitionCoordinator
        self.dimmingView!.alpha = 0
        coordinator?.animate(alongsideTransition: { (context) in
            self.dimmingView!.alpha = 0.5
        }, completion: nil)
    }
    
    func dimmingViewTapped() -> Void {
        self.presentingViewController.dismiss(animated: true, completion: nil)
    }
    
    override func dismissalTransitionWillBegin() {
        
        logCount(log: "Dimissal Transition Will Begin")
        
        let coordinator = self.presentedViewController.transitionCoordinator
        coordinator?.animate(alongsideTransition: { (context) in
            self.dimmingView.alpha = 0
        }, completion: nil)
    }
    
    override func preferredContentSizeDidChange(forChildContentContainer container: UIContentContainer) {
        super.preferredContentSizeDidChange(forChildContentContainer: container)
        
        logCount(log: "Preferred Content Size Did Change")
        
        let vc = container as! UIViewController
        if vc == self.presentedViewController{
            self.containerView?.setNeedsLayout()
        }
    }
    
    override func viewWillTransition(to size: CGSize, with coordinator: UIViewControllerTransitionCoordinator) {
        super.viewWillTransition(to: size, with: coordinator)
        
        logCount(log: "View Will Transition")
        
        self.presentationWrappingView?.clipsToBounds = true
        self.presentationWrappingView?.layer.shadowOpacity = 0
        self.presentationWrappingView?.layer.shadowRadius = 0
        
        coordinator.animate(alongsideTransition: { (context) in
        }) { (context) in
            self.presentationWrappingView?.clipsToBounds = true
            self.presentationWrappingView?.layer.shadowOpacity = 0.63
            self.presentationWrappingView?.layer.shadowRadius = 17
        }
    }
    
    override func size(forChildContentContainer container: UIContentContainer, withParentContainerSize parentSize: CGSize) -> CGSize {
        logCount(log: "Size")
        
        let vc = container as! UIViewController
        if vc == self.presentedViewController{
            return vc.preferredContentSize
        }else{
            return super.size(forChildContentContainer: container, withParentContainerSize: parentSize)
        }
    }
    
    override var frameOfPresentedViewInContainerView: CGRect{
        logCount(log: "Frame Of Presented View In Container View")
        
        let containerViewBounds = self.containerView!.bounds

        let presentedViewContentSize = self.size(forChildContentContainer: self.presentedViewController, withParentContainerSize: containerViewBounds.size)
        
        var presentedviewControllerFrame = containerViewBounds
        presentedviewControllerFrame.size.height = presentedViewContentSize.height
        presentedviewControllerFrame.origin.y = containerViewBounds.maxY - presentedViewContentSize.height
        
        return presentedviewControllerFrame
    }
    
    override func containerViewWillLayoutSubviews() {
        super.containerViewWillLayoutSubviews()
        
        logCount(log: "Container View Will Layout Subviews")
        
        self.presentationWrappingView.frame = self.frameOfPresentedViewInContainerView
    }
    

    // MARK: - UIViewControllerTransitionDelegate
    
    func animationController(forDismissed dismissed: UIViewController) -> UIViewControllerAnimatedTransitioning? {
        logCount(log: "Animation Controller For Dimiss")
        
        return self
    }
    
    func animationController(forPresented presented: UIViewController, presenting: UIViewController, source: UIViewController) -> UIViewControllerAnimatedTransitioning? {
        logCount(log: "Animation Controller For Presented")
        
        return self
    }
    
    func presentationController(forPresented presented: UIViewController, presenting: UIViewController?, source: UIViewController) -> UIPresentationController? {
        
        guard self.presentedViewController == presented else {
            print("展示控制器未定义，将采用系统默认")
            
            return nil
        }
        
        return self
    }
    
    // MARK: - UIViewControllerAnimatedTransitioning
    
    func transitionDuration(using transitionContext: UIViewControllerContextTransitioning?) -> TimeInterval {
        let animated = transitionContext?.isAnimated ?? false;
        
        return animated ? 0.75 : 0
    }
    
    func animateTransition(using transitionContext: UIViewControllerContextTransitioning) {
        let fromViewController = transitionContext.viewController(forKey: UITransitionContextViewControllerKey.from)
        let toViewController = transitionContext.viewController(forKey: UITransitionContextViewControllerKey.to)
        
        let containerView = transitionContext.containerView
        
        let toView = transitionContext.view(forKey: UITransitionContextViewKey.to)
        let fromView = transitionContext.view(forKey: UITransitionContextViewKey.from)
        
        let isPresenting = fromViewController == self.presentingViewController
        
        var fromViewFinalFrame = transitionContext.finalFrame(for: fromViewController!)
        var toViewInitialFrame = transitionContext.initialFrame(for: toViewController!)
        let toViewFinalFrame = transitionContext.finalFrame(for: toViewController!)
        
        if isPresenting {
            containerView.addSubview(toView!)
            
            toViewInitialFrame.origin = CGPoint(x: containerView.bounds.minX, y: containerView.bounds.maxY)
            toViewInitialFrame.size = toViewFinalFrame.size
            
            toView?.frame = toViewInitialFrame
        }else{
            fromViewFinalFrame = fromView!.frame.offsetBy(dx: 0, dy: fromView!.frame.height)
        }
        
        let transitionDuration = self.transitionDuration(using: transitionContext)
        
        UIView.animate(withDuration: transitionDuration, animations: { 
            if isPresenting{
                toView?.frame = toViewFinalFrame
            }else{
                fromView?.frame = fromViewFinalFrame
            }
        }) { (done) in
            let wasCancelled = transitionContext.transitionWasCancelled
            transitionContext.completeTransition(!wasCancelled)
        }

    }
    
    
    
    
    
    
}
