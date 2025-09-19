class Coder {
  name: string
  music: string
  age: number
  lang: string

  constructor(name: string, music: string, age: number, lang: string) {
    this.name = name
    this.music = music
    this.age = age
    this.lang = lang
  }
}

// DRY solution (visibility modifier)
class Coder2 {
  constructor(
    public readonly name: string,
    public music: string,
    private age: number,
    protected lang: string = 'Typescript' // with default
  ) {
    this.name = name
    this.music = music
    this.age = age
    this.lang = lang
  }

  public getAge() {
    return `Hello I', ${this.age}`
  }
}

// create a property not assigned yet
class Coder3 {
  secondLang!: string

  constructor(
    public readonly name: string // once assigned can not be changed
  ) {
    this.name = name
  }
}

const Marc = new Coder2('Marc', 'Rock', 42)
console.log(Marc.getAge())
// console.log(Marc.age) // once coompile it works in JS file
// console.log(Marc.lang) // once coompile it works in JS file

class WebDev extends Coder2 {
  constructor(
    public computer: string,
    name: string,
    music: string,
    age: number,
  ) {
    super(name, music, age)
    this.computer = computer
  }

  public getLang() {
    return `I write ${this.lang}`
  }
}

const Sara = new WebDev('Mac', 'Sara', 'Rock', 25)
console.log(Sara.getLang())
// console.log(Sara.age) // once coompile it works in JS file
// console.log(Sara.lang) // once coompile it works in JS file
////////////////////////////////////////////////////////////////

// interface to a class
interface Musicien {
  name: string,
  instrument: string,
  play(action: string): string
}

class Guitarist implements Musicien {
  name: string
  instrument: string

  constructor(
    name: string,
    instrument: string
  ) {
    this.name = name
    this.instrument = instrument
  }

  play(action: string) {
    return `${this.name} ${action} the ${this.instrument}`
  }
}
const Guit = new Guitarist('Test', 'guitare')
console.log(Guit.play('strum'))

// Static
class Peeps {
  static count: number = 0

  static getCount(): number {
    return Peeps.count
  }

  public id: number

  constructor(
    public name: string
  ) {
    this.name = name
    this.id = ++Peeps.count
  }
}
const John = new Peeps('John')
const Steeve = new Peeps('Steeve')
console.log(Peeps.count)
console.log(Steeve.id)

// Getter/Setter
class Bands {
  private dataState: string[]

  constructor() {
    this.dataState = []
  }

  // get special keyword
  public get data(): string[] {
    return this.dataState
  }

  // set special keyword
  public set data(value: string[]) {
    if (Array.isArray(value) && value.every(el => typeof el === 'string')) {
      this.dataState = value
      return
    } else throw new Error('Param is not an array of strings')
  }
}
const myBands = new Bands()
myBands.data = ['Neil', 'Led Zep']
console.log(myBands.data)
myBands.data = [...myBands.data, 'ZZ Top']
console.log(myBands.data)
//MyBands.data = 'Van' // throw error
//myBands.data = ['Van', 21] // throw error
