<script setup lang="ts">
import { clone } from 'lodash-es'
import { computed, provide, ref } from 'vue'
import CalendarTable from './CalendarTable.vue'
import { selectedMonthKey } from './date-picker-injection-keys'
import DatePickerHeader from './DatePickerHeader.vue'

const selectedMonth = ref(new Date().getMonth())

const firstDate = computed(() => {
  const date = new Date()

  date.setDate(1)
  date.setMonth(selectedMonth.value)
  date.setDate(date.getDate() - date.getDay())

  return date
})

const lastDate = computed(() => {
  const date = new Date()

  date.setMonth(selectedMonth.value)
  date.setMonth(date.getMonth() + 1)
  date.setDate(0)
  date.setDate(date.getDate() + (6 - date.getDay()))

  return date
})

const monthDays = computed(() => {
  const days = []
  const date = firstDate.value

  date.setHours(0)
  date.setMinutes(0)
  date.setSeconds(0)
  date.setMilliseconds(0)

  while (firstDate.value <= lastDate.value) {
    days.push(clone(date))
    date.setDate(date.getDate() + 1)
  }

  return days
})

provide(selectedMonthKey, selectedMonth)
</script>

<template>
  <div class="w-fit">
    <DatePickerHeader />

    <hr class="my-3 border-gray-200" />

    <CalendarTable :dates="monthDays" />
  </div>
</template>
