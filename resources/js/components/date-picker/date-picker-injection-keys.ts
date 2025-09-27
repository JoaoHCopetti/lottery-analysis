import { InjectionKey, type Ref } from 'vue'

export const currentMonthKey = Symbol() as InjectionKey<Ref<number>>
