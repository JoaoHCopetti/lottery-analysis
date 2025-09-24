import { LotteryHeatmapNumber } from '@/pages/main/main-page-props'
import { useLotteryStore } from '@/stores/lottery-store'
import { computed } from 'vue'

const LIGHTNESS_THRESHOLD = 55

export function useHeatmapNumber(heatmapNumber: LotteryHeatmapNumber) {
  const heatColor = computed(() => `hsl(3, 70%, ${heatmapNumber.lightness}%)`)
  const isDark = computed(() => heatmapNumber.lightness < LIGHTNESS_THRESHOLD)
  const lotteryStore = useLotteryStore()

  const handleMouseOver = {
    onMouseover() {
      lotteryStore.highlightedNumber = heatmapNumber.number
    },
    onMouseleave: () => {
      lotteryStore.highlightedNumber = ''
    },
  }

  return { heatColor, isDark, handleMouseOver }
}
