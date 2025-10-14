<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import { LotteryResult } from '@/types'
import { useVirtualList } from '@vueuse/core'
import IPhListBulletsBold from 'virtual:icons/ph/list-bullets-bold'
import { computed } from 'vue'
import ResultsListCardItem from './ResultsListCardItem.vue'

const props = defineProps<{
  results: LotteryResult[]
}>()

const results = computed(() => props.results)

const { list, wrapperProps, containerProps } = useVirtualList(results, {
  itemHeight: 98,
})
</script>

<template>
  <AppCard
    :header-icon="IPhListBulletsBold"
    :body-props="{
      class: 'h-[calc(100vh-80px)] ',
      ...containerProps,
    }"
    fade-bottom
  >
    <template #header> Resultados </template>

    <template #body>
      <ul v-bind="wrapperProps">
        <ResultsListCardItem
          v-for="result in list"
          :key="result.data.id"
          :result="result.data"
          class="mb-4"
        />
      </ul>
    </template>
  </AppCard>
</template>
