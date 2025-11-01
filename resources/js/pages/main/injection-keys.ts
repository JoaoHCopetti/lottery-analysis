import { DetailedNumberData } from '@/types'
import { ComputedRef, InjectionKey } from 'vue'

export const lotteryNumbersKey = Symbol() as InjectionKey<ComputedRef<DetailedNumberData[]>>
