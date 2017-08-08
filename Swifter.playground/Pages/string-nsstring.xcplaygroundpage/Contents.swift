
import Foundation

let levels = "ABCDE"
for i in levels.characters {
    print(i)
}

// 输出：
// ABCDE
if (levels as NSString).contains("BC") {
    print("包含字符串")
}

levels.contains("")


// 输出：
// 包含字符串


let nsRange = NSMakeRange(1, 4)
let nsrange = NSRange(location: 1, length: 4)

let k = Range(uncheckedBounds: (lower: 1, upper: 3))

// 编译错误
// Cannot convert value of type `NSRanve` to expected argument type 'Range<Index>'
//levels.replacingCharacters(in: nsRange, with: "AAAA")

let indexPositionOne = levels.characters.index(levels.startIndex, offsetBy: 1)
let swiftRange = indexPositionOne ..< levels.characters.index(levels.startIndex, offsetBy: 5)
levels.replacingCharacters(in: swiftRange, with: "AAAA")
// 输出：
// AAAAA

let m = (levels as NSString).replacingCharacters(in: nsrange, with: "dew")

print(m)