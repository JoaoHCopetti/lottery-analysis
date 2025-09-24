<script setup lang="ts">
import { useHeatmapNumber } from '@/composables/use-heatmap-number'
import { LotteryHeatmapNumber } from '@/types'

const { heatmapNumber } = defineProps<{
  heatmapNumber: LotteryHeatmapNumber
}>()

const {
  heatColor,
  isDark,
  handleMouseOver,
  handleClick,
  isNumberHighlighted,
  isNumberSelected,
  classes,
} = useHeatmapNumber(heatmapNumber)
</script>

<template>
  <div
    class="flex h-full w-full flex-col items-center justify-center rounded"
    :class="{
      'text-gray-200': isDark,
      'text-gray-800': !isDark,
      [classes.defaultHeatmapClass]: true,
      [classes.highlightedClass]: isNumberHighlighted,
      [classes.selectedClass]: isNumberSelected,
    }"
    :style="{ backgroundColor: heatColor }"
    v-bind="{ ...handleMouseOver, ...handleClick }"
  >
    <div class="text-xl font-bold">{{ heatmapNumber.number }}</div>

    <div class="text-sm font-bold">{{ heatmapNumber.occurrences }}</div>
  </div>
</template>
