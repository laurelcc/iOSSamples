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
    
    override var presentedView: UIView?{
        return self.presentationWrappingView
    }
    
    // MARK: -  PresentationController Funcs
    
    override func presentationTransitionWillBegin() {
        let presentedViewControllerView = super.presentedView
        
        let presentationWrapperView: UIView = UIView(frame: frameOfPresentedViewInContainerView)
        presentationWrapperView.layer.shadowOpacity = 0.44
        presentationWrapperView.layer.shadowRadius = 13
        presentationWrapperView.layer.shadowOffset = CGSize(width: 0, height: -0.6)
        
        self.presentationWrappingView = presentationWrapperView
        
        //圆角
        let roundedCornerView = UIView(frame: UIEdgeInsetsInsetRect(presentationWrappingView.bounds, UIEdgeInsets(top: 0, left: 10, bottom: 20, right: 10)))
        
        roundedCornerView.autoresizingMask = UIViewAutoresizing(rawValue: UIViewAutoresizing.flexibleWidth.rawValue | UIViewAutoresizing.flexibleHeight.rawValue)
        roundedCornerView.layer.cornerRadius = 20
        roundedCornerView.layer.masksToBounds = true
        
        //presented view's wrapper
        let presentedViewControllerWrapperView = UIView(frame: UIEdgeInsetsInsetRect(roundedCornerView.bounds, UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0)))
        presentedViewControllerWrapperView.autoresizingMask = UIViewAutoresizing(rawValue: UIViewAutoresizing.flexibleWidth.rawValue | UIViewAutoresizing.flexibleHeight.rawValue)
        
        presentedViewControllerView!.autoresizingMask = UIViewAutoresizing(rawValue: UIViewAutoresizing.flexibleWidth.rawValue | UIViewAutoresizing.flexibleHeight.rawValue)
        presentedViewControllerView?.frame = presentedViewControllerWrapperView.bounds
        //wrapper once
        presentedViewControllerWrapperView.addSubview(presentedViewControllerView!)
        
        //wrapper twice
        roundedCornerView.addSubview(presentedViewControllerWrapperView)

        //wrapper third
        presentationWrapperView.addSubview(roundedCornerView)
        
        let dimmingView = UIView(frame: self.containerView!.bounds)
        dimmingView.backgroundColor = UIColor.black
        dimmingView.isOpaque = false
        dimmingView.autoresizingMask = UIViewAutoresizing(rawValue: UIViewAutoresizing.flexibleHeight.rawValue | UIViewAutoresizing.flexibleWidth.rawValue)
        dimmingView.addGestureRecognizer(UITapGestureRecognizer(target: self, action: #selector(CustomPresentationController.dimmingViewTapped)))
        self.dimmingView = dimmingView
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
        let coordinator = self.presentedViewController.transitionCoordinator
        coordinator?.animate(alongsideTransition: { (context) in
            self.dimmingView.alpha = 0
        }, completion: nil)
    }
    
    override func preferredContentSizeDidChange(forChildContentContainer container: UIContentContainer) {
        super.preferredContentSizeDidChange(forChildContentContainer: container)
        
        let vc = container as! UIViewController
        
        if vc == self.presentedViewController{
            self.containerView?.setNeedsLayout()
        }
    }
    
    override func viewWillTransition(to size: CGSize, with coordinator: UIViewControllerTransitionCoordinator) {
        super.viewWillTransition(to: size, with: coordinator)
        
        self.presentationWrappingView?.clipsToBounds = true
        self.presentationWrappingView?.layer.shadowOpacity = 0
        self.presentationWrappingView?.layer.shadowRadius = 0
        
        coordinator.animate(alongsideTransition: { (context) in
        }) { (context) in
            self.presentationWrappingView?.clipsToBounds = true
            self.presentationWrappingView?.layer.shadowRadius = 0.63
            self.presentationWrappingView?.layer.shadowRadius = 17
        }
    }
    
    override func size(forChildContentContainer container: UIContentContainer, withParentContainerSize parentSize: CGSize) -> CGSize {
        
        let vc = container as! UIViewController
        
        if vc == self.presentedViewController{
            return vc.preferredContentSize
        }else{
            return super.size(forChildContentContainer: container, withParentContainerSize: parentSize)
        }
    }
    
    override var frameOfPresentedViewInContainerView: CGRect{
        let containerViewBounds = self.containerView!.bounds

        let presentedViewContentSize = self.size(forChildContentContainer: self.presentedViewController, withParentContainerSize: containerViewBounds.size)
        
        var presentedviewControllerFrame = containerViewBounds
        presentedviewControllerFrame.size.height = presentedViewContentSize.height
        presentedviewControllerFrame.origin.y = containerViewBounds.maxY - presentedViewContentSize.height
        
        return presentedviewControllerFrame
    }
    
    override func containerViewWillLayoutSubviews() {
        super.containerViewWillLayoutSubviews()
        
        self.presentationWrappingView.frame = self.frameOfPresentedViewInContainerView
    }
    

    // MARK: - UIViewControllerTransitionDelegate
    
    func animationController(forDismissed dismissed: UIViewController) -> UIViewControllerAnimatedTransitioning? {
        return self
    }
    
    func animationController(forPresented presented: UIViewController, presenting: UIViewController, source: UIViewController) -> UIViewControllerAnimatedTransitioning? {
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
