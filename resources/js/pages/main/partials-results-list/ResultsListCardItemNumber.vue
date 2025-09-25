<script setup lang="ts">
import { useLotteryNumber } from '@/composables/use-lottery-number'
import { computed, inject } from 'vue'
import { lotteryNumbersKey } from '../injection-keys'

const props = defineProps<{
  number: string
}>()

const numbers = inject(lotteryNumbersKey)

const number = computed(() => numbers?.find((number) => number.number === props.number))

const { numberElAttrs } = useLotteryNumber(number.value!)
</script>

<template>
  <button
    class="flex size-10 items-center justify-center rounded-full text-lg font-bold"
    tabindex="1"
    type="button"
    v-bind="numberElAttrs"
  >
    {{ number?.number }}
  </button>
</template>
