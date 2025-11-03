<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import { LotteryResultModel } from '@/types'
import { useVirtualList } from '@vueuse/core'
import IPhListBulletsBold from 'virtual:icons/ph/list-bullets-bold'
import { computed } from 'vue'
import ResultsListCardItem from './ResultsListCardItem.vue'

const props = defineProps<{
  results: LotteryResultModel[]
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
      class: 'h-[calc(100vh-80px)] p-0',
      ...containerProps,
    }"
    fade-bottom
  >
    <template #header> Resultados </template>

    <template #body>
      <ul v-bind="{ ...wrapperProps }">
        <ResultsListCardItem
          v-for="result in list"
          :key="result.data.id"
          :result="result.data"
        />
      </ul>
    </template>
  </AppCard>
</template>
