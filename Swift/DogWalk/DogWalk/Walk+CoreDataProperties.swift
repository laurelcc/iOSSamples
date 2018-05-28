//
//  Walk+CoreDataProperties.swift
//  DogWalk
//
//  Created by Soong on 2018/5/28.
//  Copyright © 2018年 Soong. All rights reserved.
//
//

import Foundation
import CoreData


extension Walk {

    @nonobjc public class func fetchRequest() -> NSFetchRequest<Walk> {
        return NSFetchRequest<Walk>(entityName: "Walk")
    }

    @NSManaged public var date: NSDate?
    @NSManaged public var dog: Dog?

}
