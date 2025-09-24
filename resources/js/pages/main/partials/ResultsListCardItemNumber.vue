<script setup lang="ts">
import { useHeatmapNumber } from '@/composables/use-heatmap-number'
import { computed, inject } from 'vue'
import { heatmapNumbersKey } from '../injection-keys'

const props = defineProps<{
  number: string
}>()

const heatmapNumbers = inject(heatmapNumbersKey)

const heatmapNumber = computed(() =>
  heatmapNumbers?.find((heatmapNumber) => heatmapNumber.number === props.number),
)

const {
  heatColor,
  isDark,
  handleMouseOver,
  handleClick,
  isNumberHighlighted,
  isNumberSelected,
  classes,
} = useHeatmapNumber(heatmapNumber.value!)
</script>

<template>
  <span
    class="flex size-10 items-center justify-center rounded-full text-lg font-bold"
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
    {{ number }}
  </span>
</template>
