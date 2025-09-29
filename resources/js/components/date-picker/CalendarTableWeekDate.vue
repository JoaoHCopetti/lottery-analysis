<script setup lang="ts">
import { CalendarDate } from '@/types'
import { computed, inject, Ref } from 'vue'
import { calendarDateKey, selectedDateKey } from './date-picker-injection-keys'

const props = defineProps<{
  date: Date
}>()

const calendarDate = inject(calendarDateKey) as Ref<CalendarDate>
const selectedDate = inject(selectedDateKey) as Ref<Date | undefined>

const isDateToday = computed(() => props.date.toDateString() === new Date().toDateString())
const isCalendarMonthDate = computed(() => props.date.getMonth() === calendarDate.value.month)
const isSelectedDate = computed(
  () => props.date.toDateString() === selectedDate.value?.toDateString(),
)

const selectDate = (date: Date) => {
  if (selectedDate.value?.toDateString() === props.date.toDateString()) {
    selectedDate.value = undefined
    return
  }

  selectedDate.value = date
}
</script>

<template>
  <td class="p-1 text-center">
    <span
      class="relative flex size-9 cursor-pointer items-center justify-center rounded-full text-sm transition-colors"
      :class="{
        'font-semibold': isDateToday,
        'pointer-events-none text-gray-400': !isCalendarMonthDate,
        'bg-blue-500 font-bold text-white hover:bg-blue-600': isSelectedDate,
        'hover:bg-gray-200 active:bg-gray-300': !isSelectedDate,
      }"
      @click="selectDate(date)"
    >
      <span
        v-if="isDateToday"
        class="absolute -top-1 text-green-500"
      >
        &bull;
      </span>
      {{ date.getDate() }}
    </span>
  </td>
</template>
