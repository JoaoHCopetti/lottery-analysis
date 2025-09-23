<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import IPhListBulletsBold from 'virtual:icons/ph/list-bullets-bold'
import { LotteryResult } from '../main-page-props'
import ResultsListCardItem from './ResultsListCardItem.vue'

defineProps<{
  results: LotteryResult[]
}>()
</script>

<template>
  <AppCard
    :header-icon="IPhListBulletsBold"
    body-class="h-[calc(100vh-80px)] overflow-auto"
  >
    <template #header> Resultados </template>

    <template #body>
      <ul>
        <ResultsListCardItem
          v-for="result in results"
          :key="`result-list-card-item-${result.id}`"
          :result="result"
          class="mb-4"
        />
      </ul>
    </template>
  </AppCard>
</template>
