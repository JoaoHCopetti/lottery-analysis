export type LotteryResult = {
  id: string
  date: string
  numbers: string[]
}

export type LotteryHeatmapNumber = {
  number: string
  occurrences: number
  weight: number
  lightness: number
}
