import { LotteryNumber } from '@/types'
import { InjectionKey } from 'vue'

export const lotteryNumbersKey = Symbol() as InjectionKey<LotteryNumber[]>
