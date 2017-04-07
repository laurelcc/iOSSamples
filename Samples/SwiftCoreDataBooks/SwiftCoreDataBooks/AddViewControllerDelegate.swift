//
//  AddViewControllerDelegate.swift
//  SwiftCoreDataBooks
//
//  Created by htx on 2017/4/7.
//  Copyright © 2017年 soong. All rights reserved.
//

import UIKit

protocol AddViewControllerDelegate: class {
    func addViewController(controller: AddViewController, didFinishWithSave save:Bool) -> Void
}
