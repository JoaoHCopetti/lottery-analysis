<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import { DetailedNumberData } from '@/types'
import IPhInfo from 'virtual:icons/ph/info-bold'
import GeneralDataFrequencies from './partials/GeneralDataFrequencies.vue'
import GeneralDataInputDate from './partials/GeneralDataInputDate.vue'
import GeneralDataUnluckyNumbers from './partials/GeneralDataUnluckyNumbers.vue'

defineProps<{
  minDate?: string
  unluckyNumbers: DetailedNumberData[]
}>()
</script>

<template>
  <AppCard
    :header-icon="IPhInfo"
    :body-props="{ class: 'h-[calc(100vh-80px)]' }"
  >
    <template #header> Dados gerais </template>

    <template #body>
      <GeneralDataInputDate :min-date="minDate" />

      <GeneralDataUnluckyNumbers :unlucky-numbers="unluckyNumbers" />

      <GeneralDataFrequencies />
    </template>
  </AppCard>
</template>
