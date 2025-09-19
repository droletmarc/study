let myName: string = 'Test'
let meaningOfLife: number
let isLoading: boolean
let album: any
let album2: string | number // union type
let stringArr = ['one', 'hey', 'test']
let guitars = ['strat', 'les Paul', 5150]
let mixedData = ['EVH', 1984, true]
let testArr = []
let bands: string[] = []
let myTuple: [string, number, boolean] = ['Test', 42, true]
let mixed = ['Test', 1, false]
// mixed can not be assigned to myTuple because it could have less element.

let myObj: object
myObj = []
myObj = {}
const exObj = {
  prop1: 'Test',
  prop2: true
}

exObj.prop2 = false

// Type Aliases
type stringOrNumber = string | number
type stringOrNumberArray = (string | number)[]

type Guitarist = {
  name?: string,
  active: boolean,
  albums: (string | number)[]
}
interface Guitarist2 {
  name: string,
  active: boolean,
  albums: (string | number)[]
}
let evh: Guitarist = {
  name: 'Eddie',
  active: true,
  albums: [1234, 'Test']
}

type Player = {
  name: string,
  active?: boolean // optional
  team: (string | number)[]
}

const greetGuitarist = (guitarist: Guitarist) => {
  // if (guitarist.name) {
  //   return `Hello ${guitarist.name.toUpperCase()}`
  // }

  // return 'Hello'

  // or use optional
  return `Hello ${guitarist.name?.toUpperCase()}`
}
console.log(greetGuitarist(evh))

// Literal types
let myName2: 'Test'
// myName = 'John'

// can be good to use for statuses for example where only those values can be assigned
let username: 'Dave' | 'John' | 'Amy'
username = 'Amy'


// Enum
enum Grade {
  U,
  D,
  C,
  B,
  A,
}
console.log(Grade.U) // return 0 the position of the Grade U

enum Grade2 {
  U = 1, // this will adapt and other will be +1
  D,
  C,
  B,
  A,
}

myName = '42'
meaningOfLife = 42
isLoading = true
album = true

const sum = (a: number, b: string) => {
  return a + b
}

let postId: string | number
let isActive: number | boolean | string
let re: RegExp = /\w+/g


stringArr[0] = 'Test2'
stringArr.push('42')

guitars[0] = 1234
guitars.unshift('Jim')

// functions
// explicit return type
const add = (a: number, b: number): number => {
  return a + b
}

let subtract = function (c: number, d: number): number {
  return c - d
}

// void return
const logMsg = (message: any): void => {
  console.log(message)
}
logMsg('Hello')

// type function receive 2 number and return a number
type mathFunction = (a: number, b: number) => number

let multiple: mathFunction = function(c, d) {
  return c * d
}

interface mathFunction2 {
  (a: number, b: number): number
}

// optional parameters
const addAll = (a: number, b: number, c?: number): number => {
  if (typeof c !== 'undefined') {
    return a + b + c
  }
  return a + b
}

// default parameter values
const sumAll = (a: number, b: number, c: number = 2): number => {
  return a + b + c
}

const sumAll2 = (a: number = 2, b: number, c: number = 2): number => {
  return a + b + c
}
// undefined is required because the first param have a default
console.log(sumAll2(undefined, 2))

// Rest parameters
const total = (...nums: number[]): number => {
  return nums.reduce((prev, curr) => prev + curr)
}
console.log(total(1,2,3,4))

// the type never (throw or infinite loop)
const createError = (errMsg: string):never => {
  throw new Error(errMsg)
}

const numberOrString = (value: number | string): string => {
  if (typeof value === 'string') return 'string'
  if (isNumber(value)) return 'number'

  // function should return a string but without explicit error we need a never type returned
  return createError('This should never happen')
}

const isNumber = (value: any): boolean => {
  return typeof value === 'number' ? true : false
}


console.log('Type Assertion/Casting')
// Type assertion/Casting
type One = string
type Two = string | number
type Three = 'hello'

// convert to more or less specific
let a: One = 'hello'
let b = a as Two // to a less specific type
let c = a as Three // more specific (can becose a is hello')
let d = <One>'world'
let e = <string | number>'world' // can not be used in tsx file (react) so not use often

const addOrConcat = (a: number, b: number, c: 'add' | 'concat'): number | string => {
  if (c === 'add') return a + b
  return '' + a + b
}
// we tell typescript we know it will return a string in that case
let myVal: string = addOrConcat(2, 2, 'concat') as string // told this will return a string we know it
// Be carefull typescriot sees no problem but a string is returned
let nextVal: number = addOrConcat(2,2,'concat') as number
//10 as string it check be can not do it all the time like the nextVal
// double casting or force asserting
(10 as unknown) as string // not recommended

// The DOM
// ! at the end tell it's a non null assigment
const img = document.querySelector('img')! // HTMLImageElement | null
const img2 = document.querySelector('#img') // element
const img3 = document.getElementById('#img') as HTMLImageElement // HTMLElement | null

img.src // can not be possible if it wasn't cast to HTMLImageELement but we use the not null !
img3.src // can not be possible if it wasn't cast to HTMLImageELement



