import { useLotteryStore } from '@/stores/lottery-store'
import { LotteryHeatmapNumber } from '@/types'
import { computed, HTMLAttributes } from 'vue'

const LIGHTNESS_THRESHOLD = 55

const HEATMAP_CLASSES = {
  DEFAULT: 'transition-all',
  SHARED: 'outline-3 cursor-pointer',
  get HIGHLIGHTED() {
    return this.SHARED + ' scale-110 outline-green-500 z-[150]'
  },
  get SELECTED() {
    return this.SHARED + ' outline-green-500 shadow-[0_0px_5px_5px] shadow-green-400 z-[100]'
  },
}

export function useHeatmapNumber(heatmapNumber: LotteryHeatmapNumber) {
  const lotteryStore = useLotteryStore()

  const heatColor = computed(() => `hsl(3, 70%, ${heatmapNumber.lightness}%)`)
  const isDark = computed(() => heatmapNumber.lightness < LIGHTNESS_THRESHOLD)
  const isNumberHighlighted = computed(() => lotteryStore.isHighlighted(heatmapNumber.number))
  const isNumberSelected = computed(() => lotteryStore.isSelected(heatmapNumber.number))

  const highlightNumber = () => {
    lotteryStore.highlightedNumber = heatmapNumber.number
  }

  const unhighlightNumber = () => {
    lotteryStore.highlightedNumber = ''
  }

  const toggleNumberSelect = () => {
    if (lotteryStore.isSelected(heatmapNumber.number)) {
      lotteryStore.deselectNumber(heatmapNumber.number)
      return
    }

    lotteryStore.selectNumber(heatmapNumber.number)
  }

  const heatmapElAttrs = computed<HTMLAttributes>(() => ({
    class: [
      HEATMAP_CLASSES.DEFAULT,
      {
        'text-gray-200': isDark.value,
        'text-gray-800': !isDark.value,
        [HEATMAP_CLASSES.HIGHLIGHTED]: isNumberHighlighted.value,
        [HEATMAP_CLASSES.SELECTED]: isNumberSelected.value,
      },
    ],
    style: {
      backgroundColor: heatColor.value,
    },
    onFocusin: highlightNumber,
    onFocusout: unhighlightNumber,
    onMouseover: highlightNumber,
    onMouseleave: unhighlightNumber,
    onClick: toggleNumberSelect,
  }))

  return {
    heatColor,
    isDark,
    isNumberHighlighted,
    isNumberSelected,
    heatmapElAttrs,
  }
}
