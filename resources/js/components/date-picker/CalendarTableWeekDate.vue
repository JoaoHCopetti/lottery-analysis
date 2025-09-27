<script setup lang="ts">
import { inject, Ref } from 'vue'
import { currentMonthKey } from './date-picker-injection-keys'

defineProps<{
  date: Date
}>()

const currentMonth = inject(currentMonthKey) as Ref<number>

const isDateToday = (date: Date) => date.toDateString() === new Date().toDateString()
const isDateCurrentMonth = (date: Date) => date.getMonth() === currentMonth.value
</script>

<template>
  <td class="p-1 text-center">
    <span
      class="relative flex size-9 cursor-pointer items-center justify-center rounded-full text-sm transition-colors hover:bg-gray-200 active:bg-gray-300"
      :class="{
        'font-semibold': isDateToday(date),
        'pointer-events-none text-gray-400': !isDateCurrentMonth(date),
      }"
    >
      <span
        v-if="isDateToday(date)"
        class="absolute -top-1 text-green-500"
      >
        &bull;
      </span>
      {{ date.getDate() }}
    </span>
  </td>
</template>
