<script setup lang="ts">
import { LotteryResult } from '../main-page-props'
import ResultsListCardItemNumber from './ResultsListCardItemNumber.vue'

defineProps<{
  result: LotteryResult
}>()
</script>

<template>
  <li>
    <div class="text-xs font-bold text-gray-600">Concurso</div>

    <div>
      <span class="mr-1 font-semibold">{{ result.id }}</span>

      <span class="text-xs text-gray-600">({{ result.date }})</span>
    </div>

    <div class="flex flex-row justify-between">
      <ResultsListCardItemNumber
        v-for="number in result.numbers"
        :key="`results-list-card-number-${number}`"
        :number="number"
      />
    </div>
  </li>
</template>
