import Foundation

struct FIFOQueue<Element>: Queue {
    fileprivate var left: [Element] = []
    fileprivate var right: [Element] = []
    
    mutating func enqueue(_ newElement: Element) {
        right.append(newElement)
    }
    
    mutating func dequeue() -> Element? {
        if left.isEmpty {
            left = right.reversed()
            right.removeAll()
        }
        
        return left.first
    }
}
