<script setup lang="ts">
import { useHeatmapNumber } from '@/composables/use-heatmap-number'
import { LotteryHeatmapNumber } from '@/types'

const { heatmapNumber } = defineProps<{
  heatmapNumber: LotteryHeatmapNumber
}>()

const { heatmapElAttrs } = useHeatmapNumber(heatmapNumber)
</script>

<template>
  <button
    class="flex h-full w-full flex-col items-center justify-center rounded"
    v-bind="heatmapElAttrs"
    tabindex="0"
    type="button"
  >
    <div class="text-xl font-bold">{{ heatmapNumber.number }}</div>

    <div class="text-sm font-bold">{{ heatmapNumber.occurrences }}</div>
  </button>
</template>
