import { useLotteryStore } from '@/stores/lottery-store'
import { LotteryHeatmapNumber } from '@/types'
import { computed } from 'vue'

const LIGHTNESS_THRESHOLD = 55

export function useHeatmapNumber(heatmapNumber: LotteryHeatmapNumber) {
  const highlightedClass =
    'scale-110 outline-3 shadow-2xl outline-blue-500 transition-all duration-100 cursor-pointer'
  const lotteryStore = useLotteryStore()

  const heatColor = computed(() => `hsl(3, 70%, ${heatmapNumber.lightness}%)`)
  const isDark = computed(() => heatmapNumber.lightness < LIGHTNESS_THRESHOLD)
  const isNumberHighlighted = computed(() => lotteryStore.isHighlighted(heatmapNumber.number))
  const isNumberSelected = computed(() => lotteryStore.isSelected(heatmapNumber.number))

  const handleMouseOver = {
    onMouseover() {
      lotteryStore.highlightedNumber = heatmapNumber.number
    },
    onMouseleave: () => {
      lotteryStore.highlightedNumber = ''
    },
  }

  const handleClick = {
    onClick() {
      console.log('Hello, world!')
    },
  }

  return {
    heatColor,
    isDark,
    handleMouseOver,
    isNumberHighlighted,
    isNumberSelected,
    highlightedClass,
    handleClick,
  }
}
