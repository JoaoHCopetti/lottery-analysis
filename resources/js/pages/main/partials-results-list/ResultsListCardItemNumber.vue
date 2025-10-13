<script setup lang="ts">
import { useLotteryNumber } from '@/composables/use-lottery-number'
import { LotteryNumber } from '@/types'
import { computed, ComputedRef, inject } from 'vue'
import { lotteryNumbersKey } from '../injection-keys'

const props = defineProps<{
  number: string
}>()

const numbers = inject(lotteryNumbersKey) as ComputedRef<LotteryNumber[]>

const number = computed(() => numbers.value.find((number) => number.number === props.number)!)

const { numberElAttrs } = useLotteryNumber(number)
</script>

<template>
  <button
    class="flex size-10 items-center justify-center rounded-full text-lg font-bold"
    tabindex="1"
    type="button"
    v-bind="numberElAttrs"
  >
    {{ number.number }}
  </button>
</template>
