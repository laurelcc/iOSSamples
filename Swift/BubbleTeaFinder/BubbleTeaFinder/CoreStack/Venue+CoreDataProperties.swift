//
//  Venue+CoreDataProperties.swift
//  BubbleTeaFinder
//
//  Created by HSoong on 2018/10/7.
//  Copyright © 2018 HSoong. All rights reserved.
//
//

import Foundation
import CoreData


extension Venue {

    @nonobjc public class func fetchRequest() -> NSFetchRequest<Venue> {
        return NSFetchRequest<Venue>(entityName: "Venue")
    }

    @NSManaged public var name: String?
    @NSManaged public var price: Double

}
