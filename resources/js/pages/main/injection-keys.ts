import { InjectionKey } from 'vue'
import { LotteryHeatmapNumber } from './main-page-props'

export const heatmapNumbersKey = Symbol() as InjectionKey<LotteryHeatmapNumber[]>
