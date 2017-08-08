
class Cat {
    var name: String
    init() {
        name = "cat"
    }
}

class Tiger: Cat {
    let power: Int
    init(k:Int) {
        power = 10
        super.init()
        name = "tiger"
    }
    
    override convenience init(){
        self.init(k: 2)
    }
}

class Cat1 {
    var name: String
    init() {
        name = "cat"
    }
}

class Tiger1: Cat1 {
    let power: Int
    override init() {
        power = 10
        // 如果我们不需要打改变 name 的话，
        // 虽然我们没有显式地对 super.init() 进行调用
        // 不过由于这是初始化的最后了，Swift 替我们自动完成了
    }
}

let cat = Cat1()

let tiger = Tiger1()

