<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import AppToggle from '@/components/toggle/AppToggle.vue'
import { LotteryNumber } from '@/types'
import { useUrlSearchParams } from '@vueuse/core'
import { computed, onBeforeMount, ref } from 'vue'
import IPhChartScatterBold from '~icons/ph/chart-scatter-bold'
import ResultsHeatmapCardNumber from './ResultsHeatmapCardNumber.vue'

type SortBy = 'occurrences' | 'days'

const props = defineProps<{
  numbers: LotteryNumber[]
}>()

const sortBy = ref<SortBy | undefined>()
const urlParams = useUrlSearchParams()

onBeforeMount(() => {
  if (urlParams.sort === 'occurrences' || urlParams.sort === 'days') {
    sortBy.value = urlParams.sort
  }
})

const computedNumbers = computed(() => {
  if (sortBy.value === 'occurrences') {
    return [...props.numbers].sort((numA, numB) => numB.occurrences - numA.occurrences)
  }

  if (sortBy.value === 'days') {
    return [...props.numbers].sort(
      (numA, numB) => numA.last_occurrence_in_days - numB.last_occurrence_in_days,
    )
  }

  return props.numbers
})

const onSortChange = (value: boolean, type: SortBy) => {
  sortBy.value = type

  if (value) {
    urlParams.sort = type
    return
  }

  sortBy.value = undefined
  delete urlParams.sort
}
</script>

<template>
  <AppCard
    :header-icon="IPhChartScatterBold"
    color="danger"
    :body-props="{
      class: 'h-[calc(100vh-80px)]',
    }"
  >
    <template #header> Mapa de calor </template>

    <template #body>
      <div class="mt-2 mb-4 flex gap-3">
        <AppToggle
          :model-value="sortBy === 'occurrences'"
          label="Ordenar por ocorrências"
          @update:model-value="onSortChange($event, 'occurrences')"
        />

        <AppToggle
          :model-value="sortBy === 'days'"
          label="Ordenar por dias"
          @update:model-value="onSortChange($event, 'days')"
        />
      </div>

      <div
        v-auto-animate
        class="grid h-[calc(100vh-160px)] grid-cols-6 gap-1"
      >
        <ResultsHeatmapCardNumber
          v-for="number in computedNumbers"
          :key="`number-${number.number}`"
          :number="number"
        />
      </div>
    </template>
  </AppCard>
</template>
