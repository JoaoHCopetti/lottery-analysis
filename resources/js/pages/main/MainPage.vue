<script setup lang="ts">
import { LotteryHeatmapNumber, LotteryResult } from './MainPageProps'
import ResultsHeatmapCard from './partials/ResultsHeatmapCard.vue'
import ResultsListCard from './partials/ResultsListCard.vue'

defineProps<{
  results: LotteryResult[]
  heatmapNumbers: LotteryHeatmapNumber[]
}>()
</script>

<template>
  <div class="flex gap-3 px-10 py-2">
    <div class="w-2/6">
      <ResultsHeatmapCard :heatmap-numbers="heatmapNumbers" />
    </div>

    <div class="w-1/4">
      <ResultsListCard :results="results" />
    </div>
  </div>
</template>
