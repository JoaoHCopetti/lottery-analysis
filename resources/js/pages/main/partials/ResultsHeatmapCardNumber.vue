<script setup lang="ts">
import { useHeatmapNumber } from '@/composables/use-heatmap-number'
import { LotteryHeatmapNumber } from '@/types'

const { heatmapNumber } = defineProps<{
  heatmapNumber: LotteryHeatmapNumber
}>()

const { heatmapElAttrs } = useHeatmapNumber(heatmapNumber)
</script>

<template>
  <div
    class="flex h-full w-full flex-col items-center justify-center rounded"
    v-bind="heatmapElAttrs"
  >
    <div class="text-xl font-bold">{{ heatmapNumber.number }}</div>

    <div class="text-sm font-bold">{{ heatmapNumber.occurrences }}</div>
  </div>
</template>
