
import Foundation

class A {
    static func method() {
        print("class func Hello")
    }
    
    func method() -> Void {
        print("func method")
    }
}

let instanceMethod:(A)->()->() = A.method
instanceMethod(A())()

let typeA: A.Type = A.self
typeA.method()

// 或者
let anyClass: AnyClass = A.self
(anyClass as! A.Type).method()

import UIKit
class MusicViewController: UIViewController {
    
}

class AlbumViewController: UIViewController {
    
}

let usingVCTypes: [AnyClass] = [MusicViewController.self,
    AlbumViewController.self]

func setupViewControllers(_ vcTypes: [AnyClass]) {
    for vcType in vcTypes {
        if vcType is UIViewController.Type {
            let vc = (vcType as! UIViewController.Type).init()
            print(vc)
        }
        
    }
}

setupViewControllers(usingVCTypes)
