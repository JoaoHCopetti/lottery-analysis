<script setup lang="ts">
import AppContainer from '@/components/container/AppContainer.vue'
import AppHint from '@/components/hint/AppHint.vue'
import { dateToLocaleString } from '@/lib/utils'
import { NumberFrequencyData } from '@/types'
import { groupBy } from 'lodash-es'
import IPhChartLineFill from 'virtual:icons/ph/chart-line-fill'
import { computed } from 'vue'
import ResultsListCardItemNumber from '../../results-list/ResultsListCardItemNumber.vue'

const props = defineProps<{
  recentIntervalFrequencies: NumberFrequencyData[]
}>()

const groupedIntervals = computed(() => groupBy(props.recentIntervalFrequencies, 'number'))
</script>

<template>
  <AppContainer
    class="mb-3"
    :body-props="{ class: 'max-h-[200px] overflow-auto' }"
  >
    <template #title> <IPhChartLineFill class="mr-1" /> Frequências dos intervalos </template>

    <template #body>
      <AppHint class="mb-3"> Intervalo em que um número ficou sem cair entre ocorrências </AppHint>

      <ul>
        <li
          v-for="(intervals, number) in groupedIntervals"
          :key="`frequency_item_${number}`"
          class="mb-2 flex items-center gap-3"
        >
          <div class="w-10">
            <ResultsListCardItemNumber :number="number" />
          </div>

          <div class="flex gap-4 text-center">
            <div
              v-for="interval in intervals.reverse()"
              :key="`frequency_item_${number}_interval_${interval.interval}`"
              class="size-10 rounded-full bg-blue-100"
            >
              <div class="text-sm font-bold">
                {{ interval.interval }}
              </div>

              <div class="text-[.65rem] text-gray-500">
                {{ dateToLocaleString(interval.date, { day: '2-digit', month: '2-digit' }) }}
              </div>
            </div>
          </div>
        </li>
      </ul>
    </template>
  </AppContainer>
</template>
