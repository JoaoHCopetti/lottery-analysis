<script setup lang="ts">
import { chunk, clone } from 'lodash-es'
import IPhArrowLeftBold from 'virtual:icons/ph/arrow-left-bold'
import IPhArrowRightBold from 'virtual:icons/ph/arrow-right-bold'
import { computed, ref } from 'vue'
import AppButton from '../button/AppButton.vue'

const todayDate = ref(new Date())
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

  while (firstDate.value <= lastDate.value) {
    days.push(clone(date))
    date.setDate(date.getDate() + 1)
  }

  return days
})

const tableWeeks = computed(() => chunk(monthDays.value, 7))
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

    <table>
      <thead>
        <tr class="*:p-1 *:font-semibold">
          <td>Dom</td>

          <td>Seg</td>

          <td>Ter</td>

          <td>Qua</td>

          <td>Qui</td>

          <td>Sex</td>

          <td>Sáb</td>
        </tr>
      </thead>

      <tbody>
        <tr
          v-for="(week, index) in tableWeeks"
          :key="`week_${index}`"
        >
          <td
            v-for="date in week"
            :key="date.toDateString()"
            class="p-1 text-center"
          >
            <span
              class="relative flex size-9 cursor-pointer items-center justify-center rounded-full text-sm transition-colors hover:bg-gray-200 active:bg-gray-300"
              :class="[
                date.getMonth() === currentMonth ? '' : 'pointer-events-none text-gray-400',
                {
                  'font-semibold': date.toDateString() === todayDate.toDateString(),
                },
              ]"
            >
              <span
                v-if="date.toDateString() === todayDate.toDateString()"
                class="absolute -top-1 text-green-500"
                >&bull;</span
              >
              {{ date.getDate() }}
            </span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
