<script setup lang="ts">
import { CalendarDate } from '@/types'
import { upperFirst } from 'lodash-es'
import IPhArrowLeftBold from 'virtual:icons/ph/arrow-left-bold'
import IPhArrowRightBold from 'virtual:icons/ph/arrow-right-bold'
import { computed, inject, Ref } from 'vue'
import AppButton from '../button/AppButton.vue'
import { calendarDateKey } from './date-picker-injection-keys'

const selectedDate = inject(calendarDateKey) as Ref<CalendarDate>

const monthLabel = computed(() => {
  const date = new Date(selectedDate.value.year, selectedDate.value.month, selectedDate.value.day)

  return upperFirst(
    date.toLocaleDateString(navigator.language, {
      month: 'long',
    }),
  )
})

const nextMonth = () => {
  if (selectedDate.value.month === 11) {
    selectedDate.value.month = 0
    selectedDate.value.year++
    return
  }

  selectedDate.value.month++
}

const previousMonth = () => {
  if (selectedDate.value.month === 0) {
    selectedDate.value.month = 11
    selectedDate.value.year--
    return
  }

  selectedDate.value.month--
}
</script>

<template>
  <div class="flex items-center justify-between gap-2">
    <AppButton
      :icon="IPhArrowLeftBold"
      color="light"
      @click="previousMonth"
    />

    <div class="w-full font-bold">
      <AppButton
        class="w-1/2"
        color="light"
        :label="monthLabel"
      />

      <AppButton
        class="w-1/2"
        color="light"
        :label="`${selectedDate.year}`"
      />
    </div>

    <AppButton
      :icon="IPhArrowRightBold"
      color="light"
      @click="nextMonth"
    />
  </div>
</template>
