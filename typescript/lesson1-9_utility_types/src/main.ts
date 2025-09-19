// Utility types
// Partial
interface Assignment {
  studentId: string,
  title: string,
  grade: number,
  verified?: boolean,
}

// partial properties of object Assignemnt can be passed
const updateAssignment = (
  assign: Assignment,
  propsToUpdate: Partial<Assignment>
): Assignment => {
  return { ...assign, ...propsToUpdate }
}

const assign1: Assignment = {
  studentId: 'comp',
  title: 'Final project',
  grade: 0
}

console.log(updateAssignment(assign1, { grade: 95 }))
const assignGraded: Assignment = updateAssignment(assign1, { grade: 95 })

// required and readonly
// all properties are quired
const recordAssignment = (assign: Required<Assignment>): Assignment => {
  // send to database, ....
  return assign
}

const assignVerified: Readonly<Assignment> = {...assignGraded, verified: true}
// assignVerified.grade = 88 // readonly we can't
//recordAssignment(assignGraded) // missing verified
recordAssignment({...assignGraded, verified: true})

// Record type
const hexColorMap: Record<string, string> = {
  red: "FF0000",
  green: "00FF00",
  blue: "0000FF",
}

type Students = "Sara" | "Kelly"
type LetterGrades = "A" | "B" | "C" | "D" | "U"
const finalGrades: Record<Students, LetterGrades> = {
  Sara: "B",
  Kelly: "U"
}

interface Grades {
  assign1: number,
  assign2: number
}

const gradeData: Record<Students, Grades> = {
  Sara: { assign1: 85, assign2: 93 },
  Kelly: { assign1: 76, assign2: 15 }
}

// Pick and Omit
// pick property from the object
type AssignResult = Pick<Assignment, "studentId" | "grade">
const score: AssignResult = {
  studentId: "k123",
  grade: 85
}

// omit the properties from the object but get all others
type AssignPreview = Omit<Assignment, "grade" | "verified">
const preview: AssignPreview = {
  studentId: 'k123',
  title: "test"
}

// Exclude and Extract
type adjustedGraDE = Exclude<LetterGrades, "u">
type highGrades = Extract<LetterGrades, "a" | "b">

// NonNullable
type AllPossibleNames = 'Dave' | 'John' | null | undefined
type NamesOnly = NonNullable<AllPossibleNames> // will only set Dave and John

// ReturnType
type newAssign = {title: string, points: number}
const createNewAssign = (title: string, points: number): newAssign => {
  return { title, points }
}

const createNewAssign2 = (title: string, points: number) => {
  return { title, points }
}
type newAssign2 = ReturnType<typeof createNewAssign2>

const tsAssign: newAssign2 = createNewAssign("Utility Types", 100)
console.log(tsAssign)

// Parameters
type AssignParams = Parameters<typeof createNewAssign2>
const assignArgs: AssignParams = ["Generics", 100]
const tsAssign2: newAssign = createNewAssign(...assignArgs)
console.log(tsAssign2)

// Awaited - helps us with the ReturnType of a promise
interface User {
  id: number,
  name: string,
  username: string,
  email: string,
}

const fetchUsers = async (): Promise<User[]> => {
  const data = await fetch(
    'https://jsonplaceholder.typicode.com/users'
  ).then(res => {
    return res.json()
  }).catch(err => {
    if (err instanceof Error) console.log(err.message)
  })
  return data
}

// this return the Promise and we want the ReturnType
// type FetchUsersReturnType = ReturnType<typeof fetchUsers>
type FetchUsersReturnType = Awaited<ReturnType<typeof fetchUsers>>
fetchUsers().then(users => console.log(users))
