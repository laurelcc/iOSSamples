import Foundation

protocol Queue{
    associatedtype Element
    
    mutating func enqueue(_ newElement: Element)
    
    mutating func dequeue() -> Element?
}
