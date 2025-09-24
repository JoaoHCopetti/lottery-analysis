import { useLotteryStore } from '@/stores/lottery-store'
import { LotteryHeatmapNumber } from '@/types'
import { computed } from 'vue'

const LIGHTNESS_THRESHOLD = 55

export function useHeatmapNumber(heatmapNumber: LotteryHeatmapNumber) {
  const highlightedClass =
    'scale-110 outline-3 shadow-2xl outline-blue-500 transition-all duration-100 cursor-default'
  const lotteryStore = useLotteryStore()

  const heatColor = computed(() => `hsl(3, 70%, ${heatmapNumber.lightness}%)`)
  const isDark = computed(() => heatmapNumber.lightness < LIGHTNESS_THRESHOLD)
  const isNumberHighlighted = computed(
    () => heatmapNumber.number === lotteryStore.highlightedNumber,
  )

  const handleMouseOver = {
    onMouseover() {
      lotteryStore.highlightedNumber = heatmapNumber.number
    },
    onMouseleave: () => {
      lotteryStore.highlightedNumber = ''
    },
  }

  return { heatColor, isDark, handleMouseOver, isNumberHighlighted, highlightedClass }
}
