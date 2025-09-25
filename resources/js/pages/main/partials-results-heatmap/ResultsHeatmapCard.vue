<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import AppToggle from '@/components/toggle/AppToggle.vue'
import { LotteryNumber } from '@/types'
import { computed } from 'vue'
import IPhChartScatterBold from '~icons/ph/chart-scatter-bold'
import ResultsHeatmapCardNumber from './ResultsHeatmapCardNumber.vue'

const props = defineProps<{
  numbers: LotteryNumber[]
}>()

const sortByOccurrences = defineModel<boolean>('sort-by-occurrences')

const computedNumbers = computed(() => {
  if (sortByOccurrences.value) {
    return [...props.numbers].sort((numberA, numberB) => numberB.occurrences - numberA.occurrences)
  }

  return props.numbers
})
</script>

<template>
  <AppCard
    :header-icon="IPhChartScatterBold"
    color="danger"
    :body-props="{
      class: 'h-[calc(100vh-80px)]',
    }"
  >
    <template #header> Mapa de calor </template>

    <template #body>
      <div class="mt-2 mb-4">
        <AppToggle
          v-model="sortByOccurrences"
          label="Ordenar por ocorrências"
        />
      </div>

      <div
        v-auto-animate
        class="grid h-[calc(100vh-160px)] grid-cols-6 gap-1"
      >
        <ResultsHeatmapCardNumber
          v-for="number in computedNumbers"
          :key="`number-${number.number}`"
          :number="number"
        />
      </div>
    </template>
  </AppCard>
</template>
