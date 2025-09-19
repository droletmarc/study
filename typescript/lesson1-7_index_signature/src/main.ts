// Index Signatures
// interface TransactionObj {
//   Pizza: number,
//   Books: number,
//   Job: number
// }

// interface TransactionObj {
//   // readonly [index: string]: number // can not set any property
//   [index: string]: number // index signature to be able to use dynamic access
}

// 3 are required but we can add moire
interface TransactionObj {
  readonly [index: string]: number
  Pizza: number,
  Books: number,
  Job: number
}

const todaysTransactions: TransactionObj = {
  Pizza: -10,
  Books: -5,
  Job: 50
}
console.log(todaysTransactions.Pizza)
console.log(todaysTransactions['Pizza'])

// dynamic access
let prop: string = 'Pizza'
console.log(todaysTransactions[prop])

const todaysNet = (transactions: TransactionObj): number => {
  let total = 0
  for(const transaction in transactions) {
    total += transactions[transaction]
  }
  return total
}
console.log(todaysNet(todaysTransactions))

console.log(todaysTransactions['Dave']) // return undefined


interface Student {
  [key: string]: string | number | number[] | undefined
  name: string
  GPA: number
  classes?: number[]
}
const student: Student = {
  name: 'Doug',
  GPA: 3.5,
  classes: [100, 300]
}
console.log(student.test)

for (const key in student) {
  console.log(`${key}: ${student[key]}`)
}

for (const key in student) {
  // with keyof we do not need the index key signature in the interface
  console.log(`${key}: ${student[key as keyof Student]}`)
}

Object.keys(student).map(key => {
  console.log(student[key as keyof typeof student])
})

const logStudentKey = (sttudent: Student, key: keyof Student): void => {
  console.log(`Student ${key}: ${student[key]}`)
}
logStudentKey(student, 'name')

////////////////////////////////////
// interface Incomes {
//   [key: string]: number
// }

// this way we can add a utility type but it's not possible with the index signature [key: 'salary]: number
type Streams = 'salary' | 'bonus' | 'sidehustle'
type Incomes = Record<Streams, number>

const monthlyIncomes: Incomes = {
  salary: 500,
  bonus: 100,
  sidehustle: 250
}
for (const revenue in monthlyIncomes) {
  // keyof is required with the Record
  console.log(monthlyIncomes[revenue as keyof Incomes])
}
