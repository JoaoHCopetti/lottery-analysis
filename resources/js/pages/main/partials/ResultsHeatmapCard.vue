<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import AppToggle from '@/components/toggle/AppToggle.vue'
import { computed } from 'vue'
import IPhChartScatterBold from '~icons/ph/chart-scatter-bold'
import { LotteryHeatmapNumber } from '../main-page-props'
import ResultsHeatmapCardNumber from './ResultsHeatmapCardNumber.vue'

const props = defineProps<{
  heatmapNumbers: LotteryHeatmapNumber[]
}>()

const sortByOccurrences = defineModel<boolean>('sort-by-occurrences')

const computedHeatmapNumbers = computed(() => {
  if (sortByOccurrences.value) {
    return [...props.heatmapNumbers].sort(
      (numberA, numberB) => numberB.occurrences - numberA.occurrences,
    )
  }

  return props.heatmapNumbers
})
</script>

<template>
  <AppCard
    :header-icon="IPhChartScatterBold"
    color="danger"
    body-class="h-[calc(100vh-80px)]"
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
          v-for="heatmapNumber in computedHeatmapNumbers"
          :key="`heatmap-number-${heatmapNumber.number}`"
          :heatmap-number="heatmapNumber"
        />
      </div>
    </template>
  </AppCard>
</template>
