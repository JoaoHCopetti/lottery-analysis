import { useLotteryStore } from '@/stores/lottery-store'
import { LotteryHeatmapNumber } from '@/types'
import { computed } from 'vue'

const LIGHTNESS_THRESHOLD = 55

export function useHeatmapNumber(heatmapNumber: LotteryHeatmapNumber) {
  const defaultHeatmapClass = 'transition-all duration-200'
  const sharedClass = 'outline-3 cursor-pointer'
  const highlightedClass = sharedClass + ' scale-110 outline-green-500 z-[150]'
  const selectedClass =
    sharedClass + ' outline-green-500 shadow-[0_0px_5px_5px] shadow-green-400 z-[100]'

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
      if (lotteryStore.isSelected(heatmapNumber.number)) {
        lotteryStore.deselectNumber(heatmapNumber.number)
        return
      }

      lotteryStore.selectNumber(heatmapNumber.number)
    },
  }

  return {
    heatColor,
    isDark,
    handleMouseOver,
    isNumberHighlighted,
    isNumberSelected,
    classes: {
      highlightedClass,
      selectedClass,
      defaultHeatmapClass,
    },
    handleClick,
  }
}
