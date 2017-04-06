//
//  Book.swift
//  SwiftCoreDataBooks
//
//  Created by htx on 2017/4/6.
//  Copyright © 2017年 soong. All rights reserved.
//

import CoreData

class Book: NSManagedObject {
    var title:String = ""
    var author:String = ""
    var copyright:Date?
    
}
