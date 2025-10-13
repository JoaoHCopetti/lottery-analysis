<script setup lang="ts">
import { useLotteryNumber } from '@/composables/use-lottery-number'
import { LotteryNumber } from '@/types'
import { computed } from 'vue'

const props = defineProps<{
  number: LotteryNumber
}>()

const number = computed(() => props.number)

const { numberElAttrs } = useLotteryNumber(number)
</script>

<template>
  <button
    class="flex h-full w-full flex-col items-center justify-center rounded"
    v-bind="numberElAttrs"
    tabindex="0"
    type="button"
  >
    <div class="text-xl font-bold">{{ number.number }}</div>

    <div class="text-sm font-bold">{{ number.occurrences }}</div>
  </button>
</template>
