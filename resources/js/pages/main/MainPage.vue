<script setup lang="ts">
import { LotteryHeatmapNumber, LotteryResult } from '@/types'
import { provide } from 'vue'
import { heatmapNumbersKey } from './injection-keys'
import ResultsHeatmapCard from './partials/ResultsHeatmapCard.vue'
import ResultsListCard from './partials/ResultsListCard.vue'

const props = defineProps<{
  results: LotteryResult[]
  heatmapNumbers: LotteryHeatmapNumber[]
}>()

provide(heatmapNumbersKey, props.heatmapNumbers)
</script>

<template>
  <div class="flex gap-3 px-10 py-2">
    <div class="w-2/6">
      <ResultsHeatmapCard :heatmap-numbers="heatmapNumbers" />
    </div>

    <div class="w-1/4">
      <ResultsListCard
        :results="results"
        :heatmap-numbers="heatmapNumbers"
      />
    </div>
  </div>
</template>
