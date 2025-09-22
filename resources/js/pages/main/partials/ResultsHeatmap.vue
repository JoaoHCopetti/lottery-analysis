<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import AppToggle from '@/components/toggle/AppToggle.vue'
import { computed } from 'vue'
import { LotteryHeatmapNumber } from '../MainPageProps'
import ResultsHeatmapNumber from './ResultsHeatmapNumber.vue'

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
  <AppCard>
    <template #header>
      <div class="flex items-center gap-2">
        <IPhChartScatterBold />
        Mapa de calor
      </div>
    </template>

    <template #body>
      <div class="mt-2 mb-4">
        <AppToggle
          v-model="sortByOccurrences"
          label="Ordenar por ocorrências"
        />
      </div>

      <div
        v-auto-animate
        class="grid grid-cols-6 gap-1"
      >
        <ResultsHeatmapNumber
          v-for="heatmapNumber in computedHeatmapNumbers"
          :key="`heatmap-number-${heatmapNumber.number}`"
          :heatmap-number="heatmapNumber"
        />
      </div>
    </template>
  </AppCard>
</template>
