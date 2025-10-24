<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import AppContainer from '@/components/container/AppContainer.vue'
import AppInputDate from '@/components/input/AppInputDate.vue'
import AppTabs from '@/components/tabs/AppTabs.vue'
import { LotteryNumber } from '@/types'
import { router } from '@inertiajs/vue3'
import { useUrlSearchParams } from '@vueuse/core'
import IPhInfo from 'virtual:icons/ph/info-bold'
import { onMounted, ref } from 'vue'
import ResultsListCardItemNumber from '../partials-results-list/ResultsListCardItemNumber.vue'

const date = ref<Date | undefined>()
const urlParams = useUrlSearchParams()

defineProps<{
  minDate: string
  unluckyNumbers: LotteryNumber[]
}>()

onMounted(() => {
  if (urlParams.date) {
    date.value = new Date(urlParams.date + ' 00:00')
  }
})

const onDateChange = () => {
  const changedDate = date.value?.toISOString().split('T')[0]

  router.reload({ data: { date: changedDate } })
}
</script>

<template>
  <AppCard
    :header-icon="IPhInfo"
    :body-props="{ class: 'h-[calc(100vh-80px)]' }"
  >
    <template #header> Dados gerais </template>

    <template #body>
      <AppTabs
        :tabs="[
          { slot: 'general', label: 'Geral' },
          { slot: 'selected-numbers', label: 'Números selecionados' },
        ]"
      >
        <template #[`general`]>
          <AppContainer class="mb-3">
            <template #title><IPhCalendarFill class="mr-1" />A partir de</template>

            <template #body>
              <AppInputDate
                v-model="date"
                placeholder="dd/mm/aaaa"
                :date-picker-props="{ minDate }"
                @update:model-value="onDateChange"
              />
            </template>
          </AppContainer>

          <AppContainer>
            <template #title> <IPhWarningDiamondFill class="mr-1" /> Números de azar </template>

            <template #body>
              <div class="mb-4 text-sm text-gray-500">Não cai há mais de 20 jogos</div>

              <div class="flex justify-evenly gap-3">
                <ResultsListCardItemNumber
                  v-for="number in unluckyNumbers"
                  :key="number.number"
                  :number="number.number"
                />
              </div>
            </template>
          </AppContainer>
        </template>

        <template #[`selected-numbers`]> Números selecionados </template>
      </AppTabs>
    </template>
  </AppCard>
</template>
