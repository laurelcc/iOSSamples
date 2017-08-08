
import Foundation

func sum(input: Int...) -> Int {
    return input.reduce(0, {(a, b) in
        return a + b})
}

print(sum(input: 1,2,3,4,5))
// 输出：15

func myFunc(numbers: Int..., string: String) {
    numbers.forEach {
        for i in 0..<$0 {
            print("\(i + 1): \(string)")
        }
    }
}

myFunc(numbers: 1, 2, 3, string: "hello")



let name = "Tom"
let date = NSDate()
let dateFormatter = DateFormatter()
dateFormatter.dateFormat = "Y-MM-dd"
dateFormatter.locale = Locale(identifier: "Asia")
let string = NSString(format: "Hello %@. Date: %@   f", name, dateFormatter.string(from: date as Date))
