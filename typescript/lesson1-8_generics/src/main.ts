const stringEcho = (arg: string): string => arg
const echo = <T>(arg: T): T => arg

const isObj = <T>(arg: T): boolean => {
  return (typeof arg === 'object' && !Array.isArray(arg) && arg !== null)
}
console.log(isObj(true))
console.log(isObj('string'))
console.log(isObj([1,2,3]))
console.log(isObj({}))
console.log(isObj(null))

const isTrue = <T>(arg: T): { arg: T, is: boolean} => {
  if (Array.isArray(arg) && !arg.length) {
    return {arg, is: false}
  }
  if (isObj(arg) && !Object.keys(arg as keyof T).length) {
    return {arg, is: false}
  }
  // double bang for bool
  return {arg, is: !!arg}
}

interface BoolCheck<T> {
  value: T,
  is: boolean,
}

const checkBoolValue = <T>(arg: T): BoolCheck<T> => {
  if (Array.isArray(arg) && !arg.length) {
    return {value: arg, is: false}
  }
  if (isObj(arg) && !Object.keys(arg as keyof T).length) {
    return {value: arg, is: false}
  }
  // double bang for bool
  return {value: arg, is: !!arg}
}

interface HasId {
  id: number
}

const processUser = <T extends HasId>(user: T): T => {
  // process the user with logic here
  return user
}
console.log(processUser({id: 1, name: 'test'}))
// console.log(processUser({name: 'test2'})) // not possible id required

const getUsersProperty = <T extends HasId, K extends keyof T>(users: T[], key: K): T[K][] => {
  return users.map(user => user[key])
}
const usersArray = [
  {id: 1, name: 'test', age: 12},
  {id: 2, name: 'test2', age: 13},
  {id: 3, name: 'test3', age: 14}
]
// this return an array of 3 names
console.log(getUsersProperty(usersArray, "name"))
console.log(getUsersProperty(usersArray, "name"))

class StateObject<T> {
  private data: T

  constructor(value: T) {
    this.data = value
  }

  get state(): T {
    return this.data
  }

  set state(value: T) {
    this.data = value
  }
}

const store = new StateObject("John")
console.log(store.state)
store.state = "Dave"
// store.state = 12 // after we've assigned a string, it infer it will be of type string

const myState = new StateObject<(string|number|boolean)[]>([15])
myState.state = (['Dave', 42, true])
console.log(myState.state)
