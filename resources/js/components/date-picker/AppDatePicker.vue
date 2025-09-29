<script setup lang="ts">
import { CalendarDate } from '@/types'
import { clone } from 'lodash-es'
import { computed, provide, ref } from 'vue'
import CalendarTable from './CalendarTable.vue'
import DatePickerHeader from './DatePickerHeader.vue'
import { calendarDateKey, selectedDateKey } from './date-picker-injection-keys'

const date = new Date()
const selectedDate = ref<Date>()

const calendarDate = ref<CalendarDate>({
  day: 1,
  month: date.getMonth(),
  year: date.getFullYear(),
})

const firstDate = computed(() => {
  const { day, month, year } = calendarDate.value
  const date = new Date(year, month, day)

  date.setDate(1)
  date.setDate(date.getDate() - date.getDay())

  return date
})

const lastDate = computed(() => {
  const { day, month, year } = calendarDate.value
  const date = new Date(year, month, day)

  date.setDate(0)
  date.setMonth(date.getMonth() + 1)
  date.setDate(date.getDate() + (6 - date.getDay()))

  return date
})

const dates = computed(() => {
  const _dates = []
  const date = firstDate.value

  date.setHours(0)
  date.setMinutes(0)
  date.setSeconds(0)
  date.setMilliseconds(0)

  while (firstDate.value <= lastDate.value) {
    _dates.push(clone(date))
    date.setDate(date.getDate() + 1)
  }

  return _dates
})

provide(calendarDateKey, calendarDate)
provide(selectedDateKey, selectedDate)
</script>

<template>
  <div class="w-fit">
    <DatePickerHeader />

    <hr class="my-3 border-gray-200" />

    <CalendarTable :dates="dates" />
  </div>
</template>
