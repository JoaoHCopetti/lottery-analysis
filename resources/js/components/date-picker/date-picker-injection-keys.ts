import { InjectionKey, type Ref } from 'vue'

export const selectedMonthKey = Symbol() as InjectionKey<Ref<number>>
