<script setup lang="ts">
import { dateToLocaleString } from '@/lib/utils'
import { NumberFrequencyData } from '@/types'
import { computed } from 'vue'
import ResultsListCardItemNumber from '../../results-list/ResultsListCardItemNumber.vue'

const props = defineProps<{
  intervals: NumberFrequencyData[]
  number: number | string
}>()

const reversedIntervals = computed(() => [...props.intervals].reverse())
const countTwiceInARow = computed(
  () => props.intervals.filter((number) => number.interval === 0).length,
)
</script>

<template>
  <li class="mb-2">
    <div class="mb-1 flex items-center gap-3">
      <div class="w-10">
        <ResultsListCardItemNumber :number="number" />
      </div>

      <div>&bull;</div>

      <div class="flex gap-4 text-center">
        <div
          v-for="interval in reversedIntervals"
          :key="`frequency_item_${number}_interval_${interval.interval}`"
          class="size-10 rounded-full bg-blue-100"
          :class="{
            'outline-2 outline-amber-500': interval.interval === 0,
          }"
        >
          <div class="text-sm font-bold">
            {{ interval.interval }}
          </div>

          <div class="text-[.65rem] text-gray-500">
            {{ dateToLocaleString(interval.date, { day: '2-digit', month: '2-digit' }) }}
          </div>
        </div>
      </div>
    </div>

    <div class="text-xs text-gray-600">Duas em seguida: {{ countTwiceInARow }}x</div>
  </li>
</template>
