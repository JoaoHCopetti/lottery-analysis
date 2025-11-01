<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import AppToggle from '@/components/toggle/AppToggle.vue'
import { DetailedNumberData } from '@/types'
import { useUrlSearchParams } from '@vueuse/core'
import { sortBy } from 'lodash-es'
import { computed, onBeforeMount, ref } from 'vue'
import IPhChartScatterBold from '~icons/ph/chart-scatter-bold'
import ResultsHeatmapCardNumber from './ResultsHeatmapCardNumber.vue'

type SortValue = 'occurrences' | 'days'

const props = defineProps<{
  numbers: DetailedNumberData[]
}>()

const sort = ref<SortValue | undefined>()
const urlParams = useUrlSearchParams()

onBeforeMount(() => {
  if (urlParams.sort === 'occurrences' || urlParams.sort === 'days') {
    sort.value = urlParams.sort
  }
})

const computedNumbers = computed(() => {
  if (sort.value === 'occurrences') {
    return sortBy(props.numbers, 'occurrences').reverse()
  }

  if (sort.value === 'days') {
    return sortBy(props.numbers, (number) => number.last_occurrence_in_contests || 0).reverse()
  }

  return props.numbers
})

const onSortChange = (value: boolean, type: SortValue) => {
  sort.value = type

  if (value) {
    urlParams.sort = type
    return
  }

  sort.value = undefined
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
      <div class="mt-2 mb-4 flex justify-between gap-3">
        <AppToggle
          :model-value="sort === 'occurrences'"
          label="Ordenar por ocorrências"
          label-class="text-sm"
          @update:model-value="onSortChange($event, 'occurrences')"
        />

        <AppToggle
          :model-value="sort === 'days'"
          label="Ordenar por jogos"
          label-class="text-sm"
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
