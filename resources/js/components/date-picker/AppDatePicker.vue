<script setup lang="ts">
import { clone } from 'lodash-es'
import IPhArrowLeftBold from 'virtual:icons/ph/arrow-left-bold'
import IPhArrowRightBold from 'virtual:icons/ph/arrow-right-bold'
import { computed, provide, ref } from 'vue'
import AppButton from '../button/AppButton.vue'
import CalendarTable from './CalendarTable.vue'
import { currentMonthKey } from './date-picker-injection-keys'

const currentMonth = ref(new Date().getMonth())

const firstDate = computed(() => {
  const date = new Date()

  date.setDate(1)
  date.setMonth(currentMonth.value)
  date.setDate(date.getDate() - date.getDay())

  return date
})

const lastDate = computed(() => {
  const date = new Date()

  date.setMonth(currentMonth.value)
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

provide(currentMonthKey, currentMonth)
</script>

<template>
  <div class="w-fit">
    <div class="flex justify-between">
      <AppButton
        :icon="IPhArrowLeftBold"
        color="light"
        @click="currentMonth--"
      />

      <div class="font-bold">
        <AppButton
          color="light"
          class="mr-3"
          label="Fevereiro"
        />

        <AppButton
          color="light"
          label="2025"
        />
      </div>

      <AppButton
        :icon="IPhArrowRightBold"
        color="light"
        @click="currentMonth++"
      />
    </div>

    <hr class="my-3 border-gray-200" />

    <CalendarTable :dates="monthDays" />
  </div>
</template>
