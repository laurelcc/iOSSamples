
import Foundation

let diceFaceCount: UInt32 = 6
let randomRoll = Int(arc4random_uniform(diceFaceCount)) + 1
print(randomRoll)

func random(in range: Range<Int>) -> Int {
    let count = UInt32(range.upperBound - range.lowerBound)
    return  Int(arc4random_uniform(count)) + range.lowerBound
}

for _ in 0...0 {
    let range = Range<Int>(1...6)
    
    print("Lower Bound", range.lowerBound)
    print("Upper Bound", range.upperBound)
    
    print(random(in: range))
}
