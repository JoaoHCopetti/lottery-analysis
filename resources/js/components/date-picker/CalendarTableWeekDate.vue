<script setup lang="ts">
import { inject, Ref } from 'vue'
import { selectedMonthKey } from './date-picker-injection-keys'

defineProps<{
  date: Date
}>()

const selectedMonth = inject(selectedMonthKey) as Ref<number>

const isDateToday = (date: Date) => date.toDateString() === new Date().toDateString()
const isDateSelectedMonth = (date: Date) => date.getMonth() === selectedMonth.value
</script>

<template>
  <td class="p-1 text-center">
    <span
      class="relative flex size-9 cursor-pointer items-center justify-center rounded-full text-sm transition-colors hover:bg-gray-200 active:bg-gray-300"
      :class="{
        'font-semibold': isDateToday(date),
        'pointer-events-none text-gray-400': !isDateSelectedMonth(date),
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
