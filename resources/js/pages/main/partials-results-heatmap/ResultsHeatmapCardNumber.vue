<script setup lang="ts">
import { useLotteryNumber } from '@/composables/use-lottery-number'
import { LotteryNumber } from '@/types'
import { computed } from 'vue'

const props = defineProps<{
  number: LotteryNumber
}>()

const number = computed(() => props.number)

const { numberElAttrs, paddedNumber } = useLotteryNumber(number)
</script>

<template>
  <button
    class="flex h-full w-full flex-col items-center justify-center rounded"
    v-bind="numberElAttrs"
    tabindex="0"
    type="button"
  >
    <div class="font-bold">{{ paddedNumber }}</div>

    <div class="text-xs font-bold">{{ number.occurrences }}</div>

    <div class="text-[.7rem] font-bold opacity-80">
      <template v-if="number.last_occurrence_in_days">
        Há {{ number.last_occurrence_in_days }} dias
      </template>

      <template v-else>&nbsp;</template>
    </div>
  </button>
</template>
