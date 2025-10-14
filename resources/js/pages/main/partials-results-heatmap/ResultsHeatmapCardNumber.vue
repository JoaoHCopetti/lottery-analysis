<script setup lang="ts">
import { useLotteryNumber } from '@/composables/use-lottery-number'
import { LotteryNumber } from '@/types'
import { computed } from 'vue'

const props = defineProps<{
  number: LotteryNumber
}>()

const number = computed(() => props.number)

const { numberElAttrs, paddedNumber } = useLotteryNumber(number)

const lastOccurrenceFormatted = computed(() => {
  const lastOccurrenceDate = new Date(props.number.last_occurrence + ' 00:00')
  const currentYear = new Date().getFullYear()

  return lastOccurrenceDate.toLocaleDateString(navigator.language, {
    day: '2-digit',
    month: '2-digit',
    ...(lastOccurrenceDate.getFullYear() !== currentYear ? { year: '2-digit' } : {}),
  })
})
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

    <div class="text-[.7rem] font-bold opacity-60">
      {{ lastOccurrenceFormatted }}
    </div>
  </button>
</template>
