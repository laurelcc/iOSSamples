//
//  Book.swift
//  SwiftCoreDataBooks
//
//  Created by htx on 2017/4/6.
//  Copyright © 2017年 soong. All rights reserved.
//

import CoreData

class Book: NSManagedObject {
    dynamic var title:String = ""
    dynamic var author:String = ""
    dynamic var copyright:Date? = Date()
    
}
