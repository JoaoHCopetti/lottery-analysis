<script setup lang="ts">
import { computed } from 'vue'
import { LotteryHeatmapNumber } from '../MainPageProps'

const { heatmapNumber } = defineProps<{
  heatmapNumber: LotteryHeatmapNumber
}>()

const backgroundColor = computed(() => `hsl(3, 70%, ${100 - heatmapNumber.lightness}%)`)
const isDark = computed(() => 100 - heatmapNumber.lightness < 55)
</script>

<template>
  <div
    class="flex h-full w-full flex-col items-center justify-center rounded"
    :class="{ 'text-gray-200': isDark, 'text-gray-800': !isDark }"
    :style="{ backgroundColor: backgroundColor }"
  >
    <div class="text-xl font-bold">{{ heatmapNumber.number }}</div>

    <div class="text-sm font-bold">{{ heatmapNumber.occurrences }}</div>
  </div>
</template>
