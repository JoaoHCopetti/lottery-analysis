<script setup lang="ts">
import AppContainer from '@/components/container/AppContainer.vue'
import { LotteryNumber } from '@/types'
import IPhInfoFill from 'virtual:icons/ph/info-fill'
import IPhWarningDiamondFill from 'virtual:icons/ph/warning-diamond-fill'
import ResultsListCardItemNumber from '../../results-list/ResultsListCardItemNumber.vue'

defineProps<{
  unluckyNumbers: LotteryNumber[]
}>()
</script>

<template>
  <AppContainer class="mb-3">
    <template #title> <IPhWarningDiamondFill class="mr-1" /> Números de azar </template>

    <template #body>
      <div class="mb-4 flex items-center gap-1 text-sm text-gray-500">
        <IPhInfoFill /> Não cai há mais de 20 jogos
      </div>

      <div class="flex justify-evenly gap-3">
        <div
          v-for="number in unluckyNumbers"
          :key="number.number"
          class=""
        >
          <ResultsListCardItemNumber :number="number.number" />

          <span class="mt-2 block text-center text-xs text-gray-500">
            {{ number.last_occurrence_in_contests }}
            jogos
          </span>
        </div>
      </div>
    </template>
  </AppContainer>
</template>
