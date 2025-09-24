<script setup lang="ts">
import { LotteryResult } from '@/types'
import { computed } from 'vue'
import ResultsListCardItemNumber from './ResultsListCardItemNumber.vue'

const props = defineProps<{
  result: LotteryResult
}>()

const date = computed(() => new Date(props.result.date).toLocaleDateString(navigator.language))
</script>

<template>
  <li>
    <div class="text-xs font-bold text-gray-600">Concurso</div>

    <div>
      <span class="mr-1 font-semibold">{{ result.id }}</span>

      <span class="text-xs text-gray-600">({{ date }})</span>
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
