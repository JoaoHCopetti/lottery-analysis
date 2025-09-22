<script setup lang="ts">
import { LotteryHeatmapNumber, LotteryResult } from './MainPageProps'
import ResultsHeatmap from './partials/ResultsHeatmap.vue'
defineProps<{
  results: LotteryResult[]
  heatmapNumbers: LotteryHeatmapNumber[]
}>()
</script>

<template>
  <div class="flex gap-3 px-10 py-2">
    <div class="w-2/5">
      <ResultsHeatmap :heatmap-numbers="heatmapNumbers" />
    </div>

    <!-- <div class="w-1/3">List</div> -->
  </div>
</template>
