import { LotteryHeatmapNumber } from '@/pages/main/main-page-props'
import { computed } from 'vue'

export function useHeatmapNumber(heatmapNumber: LotteryHeatmapNumber) {
  const backgroundColor = computed(() => `hsl(3, 70%, ${100 - heatmapNumber.lightness}%)`)
  const isDark = computed(() => 100 - heatmapNumber.lightness < 55)

  return { backgroundColor, isDark }
}
