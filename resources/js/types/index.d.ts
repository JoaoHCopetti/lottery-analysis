export type LotteryResult = {
  id: string
  contest: string
  date: string
  numbers: string[]
}

export type LotteryNumber = {
  number: string
  occurrences: number
  weight: number
  lightness: number
  last_occurrence: string
}

export type CalendarDate = {
  day: number
  month: number
  year: number
}
