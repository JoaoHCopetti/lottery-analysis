import { LotteryNumber } from '@/types'
import { ComputedRef, InjectionKey } from 'vue'

export const lotteryNumbersKey = Symbol() as InjectionKey<ComputedRef<LotteryNumber[]>>
