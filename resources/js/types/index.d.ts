export type LotteryResultModel = {
  id: string
  contest: string
  date: string
  numbers: string[]
  even_count: number
  odd_count: number
}

export type DetailedNumberData = {
  number: string
  occurrences: number
  weight: number
  lightness: number
  last_occurrence_in_contests: number | null
  is_even: boolean
}

export type NumberFrequencyData = {
  number: number
  interval: number
  date: string
}

export type CalendarDate = {
  day: number
  month: number
  year: number
}
