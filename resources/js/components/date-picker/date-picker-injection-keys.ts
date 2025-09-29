import { CalendarDate } from '@/types'
import { InjectionKey, type Ref } from 'vue'

export const calendarDateKey = Symbol() as InjectionKey<Ref<CalendarDate>>
