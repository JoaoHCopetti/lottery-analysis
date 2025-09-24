import { LotteryHeatmapNumber } from '@/types'
import { InjectionKey } from 'vue'

export const heatmapNumbersKey = Symbol() as InjectionKey<LotteryHeatmapNumber[]>
