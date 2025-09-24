<script setup lang="ts">
import { LotteryHeatmapNumber, LotteryResult } from '@/types'
import { provide } from 'vue'
import { heatmapNumbersKey } from './injection-keys'
import GeneralDataCard from './partials-general-data/GeneralDataCard.vue'
import ResultsHeatmapCard from './partials-results-heatmap/ResultsHeatmapCard.vue'
import ResultsListCard from './partials-results-list/ResultsListCard.vue'

const props = defineProps<{
  results: LotteryResult[]
  heatmapNumbers: LotteryHeatmapNumber[]
}>()

provide(heatmapNumbersKey, props.heatmapNumbers)
</script>

<template>
  <div class="grid grid-cols-[1.5fr_1.2fr_2fr] gap-3 px-10 py-2">
    <ResultsHeatmapCard :heatmap-numbers="heatmapNumbers" />

    <ResultsListCard :results="results" />

    <GeneralDataCard />
  </div>
</template>
