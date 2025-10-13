<script setup lang="ts">
import { getMonthName } from '@/lib/utils'
import { CalendarDate } from '@/types'
import { kebabCase, upperFirst } from 'lodash-es'
import IPhArrowLeftBold from 'virtual:icons/ph/arrow-left-bold'
import IPhArrowRightBold from 'virtual:icons/ph/arrow-right-bold'
import { computed, inject, type Ref } from 'vue'
import AppButton from '../button/AppButton.vue'
import AppDropdown from '../dropdown/AppDropdown.vue'
import { calendarDateKey } from './date-picker-injection-keys'

const selectedDate = inject(calendarDateKey) as Ref<CalendarDate>

const monthsOptions = computed(() =>
  Array.from({ length: 12 }).map((_, index) => {
    const monthName = getMonthName(index)

    return {
      key: kebabCase(monthName),
      label: upperFirst(monthName),
      value: index,
    }
  }),
)

const yearsOptions = computed(() =>
  Array.from({ length: 100 }).map((_, index) => {
    const date = new Date()

    const year = date.getFullYear() - index
    return {
      key: `${year}`,
      label: `${year}`,
      value: year,
    }
  }),
)

const incrementMonth = () => {
  if (selectedDate.value.month === 11) {
    selectedDate.value.month = 0
    selectedDate.value.year++
    return
  }

  selectedDate.value.month++
}

const decrementMonth = () => {
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
      @click="decrementMonth"
    />

    <div class="w-full font-bold">
      <AppDropdown
        class="inline-block w-1/2"
        :items="monthsOptions"
        :button-props="{ color: 'light', label: upperFirst(getMonthName(selectedDate.month)) }"
        :menu-props="{ class: 'w-40 max-h-52' }"
        @item-click="selectedDate.month = $event.value"
      />

      <AppDropdown
        class="inline-block w-1/2"
        :items="yearsOptions"
        :button-props="{ color: 'light', label: `${selectedDate.year}` }"
        :menu-props="{ class: 'w-30 max-h-52' }"
        @item-click="selectedDate.year = $event.value"
      />
    </div>

    <AppButton
      :icon="IPhArrowRightBold"
      color="light"
      @click="incrementMonth"
    />
  </div>
</template>
