import Foundation

class MyObject: NSObject {
    func callMe() {
        //...
    }
    
    func callMeWithParam(obj: AnyObject!) {
        //...
        
        print("callMeWithParam param:\(obj)")
    }
    
    func turn(by angle: Any, speed: Any) {
        //...
        
        print("angle:\(angle), speed:\(speed)")
    }
    
    func selectors() -> [Selector] {
        let someMethod = #selector(callMe)
        let anotherMethod = #selector(callMeWithParam(obj:))
        let method = #selector(turn(by:speed:))

        return [someMethod, anotherMethod, method]
    }
    
    func otherSelectors() -> [Selector] {
        let someMethod = #selector(callMe)
        let anotherMethod = #selector(callMeWithParam)
        let method = #selector(turn)
        
        return [someMethod, anotherMethod, method]
    }
    
    
    func commonFunc() {
        print("this is a commonFunc without params")
    }
    
    func commonFunc(input: Any) -> Any {
        print("the param input is:\(input)")
        return input
    }
    
    func sameNameSelectors() -> [Selector] {
        let method1 = #selector(commonFunc as ()->())
        let method2 = #selector(commonFunc as (Any)->Any)
        
        return [method1, method2]
    }
}

let selectors = MyObject().selectors()
print(selectors)

let otherSelectors = MyObject().otherSelectors()
print(otherSelectors)

let sameNameSelectors = MyObject().sameNameSelectors()
print(sameNameSelectors)


//自定义测试，只有参数为Any或AnyObject类型的才可以调用perform
let obj = MyObject()
let cf1 = sameNameSelectors[0]
let cf2 = selectors[1]
obj.perform(cf1)
obj.perform(cf2, with: 23)


let cf3 = sameNameSelectors[1]
let i = 32
obj.perform(cf3, with: i)

let cf4 = selectors[2]
obj.perform(cf4, with: 22, with: 42)







