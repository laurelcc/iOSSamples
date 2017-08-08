//: [Previous](@previous)

import Foundation

extension Dictionary{
    
    init<S:Sequence>(_ other: S) where S.Iterator.Element == (key:Key, value:Value){
        self = [:]
        self.merge(other)
    }
    
    mutating func merge<S>(_ other: S) -> Void where S:Sequence, S.Iterator.Element == (key:Key, value:Value) {
        for (k, v) in other {
            self[k] = v
        }
    }
    
}

var indices = IndexSet()
indices.insert(integersIn: 1..<10)
indices.insert(integersIn: 20..<27)

let evenIndices = indices.filter(){(k: Int)->Bool in k % 2 == 0}
print(evenIndices)


let unOrderedSet:Set = [432,1,2,3,42,12,34,4]

print(unOrderedSet)

