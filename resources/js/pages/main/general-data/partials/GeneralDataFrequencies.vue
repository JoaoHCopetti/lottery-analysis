<script setup lang="ts">
import AppContainer from '@/components/container/AppContainer.vue'
import AppHint from '@/components/hint/AppHint.vue'
import { NumberFrequencyData } from '@/types'
import { groupBy } from 'lodash-es'
import IPhChartLineFill from 'virtual:icons/ph/chart-line-fill'
import { computed } from 'vue'
import GeneralDataFrequenciesItem from './GeneralDataFrequenciesItem.vue'

const props = defineProps<{
  recentIntervalFrequencies: NumberFrequencyData[]
}>()

const groupedIntervals = computed(() => groupBy(props.recentIntervalFrequencies, 'number'))
</script>

<template>
  <AppContainer
    class="mb-3"
    :body-props="{ class: 'max-h-[300px] overflow-auto' }"
  >
    <template #title> <IPhChartLineFill class="mr-1" /> Frequências dos intervalos </template>

    <template #body>
      <AppHint class="mb-3">
        <div>Intervalo em que um número ficou sem cair entre ocorrências</div>

        <div>Zero indica que caiu duas vezes seguidas</div>
      </AppHint>

      <ul>
        <template
          v-for="(intervals, number) in groupedIntervals"
          :key="`frequency_item_${number}`"
        >
          <GeneralDataFrequenciesItem
            :intervals="intervals"
            :number="number"
            class="mb-3"
          />
        </template>
      </ul>
    </template>
  </AppContainer>
</template>
