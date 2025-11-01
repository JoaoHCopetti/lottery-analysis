<script setup lang="ts">
import { DetailedNumberData, LotteryResultModel } from '@/types'
import { computed, provide } from 'vue'
import GeneralDataCard from './general-data/GeneralDataCard.vue'
import { lotteryNumbersKey } from './injection-keys'
import ResultsHeatmapCard from './results-heatmap/ResultsHeatmapCard.vue'
import ResultsListCard from './results-list/ResultsListCard.vue'

const props = defineProps<{
  results: LotteryResultModel[]
  numbers: DetailedNumberData[]
  unluckyNumbers: DetailedNumberData[]
  metadata: {
    minDate?: string
  }
}>()

const numbers = computed(() => props.numbers)

provide(lotteryNumbersKey, numbers)
</script>

<template>
  <div class="grid grid-cols-[1.5fr_1.2fr_2fr] gap-3 px-10 py-2">
    <ResultsHeatmapCard :numbers="numbers" />

    <ResultsListCard :results="results" />

    <GeneralDataCard
      :unlucky-numbers="unluckyNumbers"
      :min-date="metadata.minDate"
    />
  </div>
</template>
