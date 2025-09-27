<script setup lang="ts">
import { upperFirst } from 'lodash-es'
import IPhArrowLeftBold from 'virtual:icons/ph/arrow-left-bold'
import IPhArrowRightBold from 'virtual:icons/ph/arrow-right-bold'
import { computed, inject, Ref } from 'vue'
import AppButton from '../button/AppButton.vue'
import { selectedMonthKey } from './date-picker-injection-keys'

const selectedMonth = inject(selectedMonthKey) as Ref<number>

const monthLabel = computed(() => {
  const date = new Date(1, selectedMonth.value, 0)

  return upperFirst(
    date.toLocaleDateString(navigator.language, {
      month: 'long',
    }),
  )
})

const nextMonth = () => {
  if (selectedMonth.value === 11) {
    selectedMonth.value = 0
    return
  }

  selectedMonth.value++
}

const previousMonth = () => {
  if (selectedMonth.value === 0) {
    selectedMonth.value = 11
    return
  }
  selectedMonth.value--
}
</script>

<template>
  <div class="flex items-center justify-between">
    <AppButton
      :icon="IPhArrowLeftBold"
      color="light"
      @click="previousMonth"
    />

    <div class="font-bold">
      <AppButton
        color="light"
        class="mr-3"
        :label="monthLabel"
      />

      <AppButton
        color="light"
        label="2025"
      />
    </div>

    <AppButton
      :icon="IPhArrowRightBold"
      color="light"
      @click="nextMonth"
    />
  </div>
</template>
