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

const { heatmapElAttrs } = useHeatmapNumber(heatmapNumber.value!)
</script>

<template>
  <button
    class="flex size-10 items-center justify-center rounded-full text-lg font-bold"
    tabindex="1"
    type="button"
    v-bind="heatmapElAttrs"
  >
    {{ number }}
  </button>
</template>
