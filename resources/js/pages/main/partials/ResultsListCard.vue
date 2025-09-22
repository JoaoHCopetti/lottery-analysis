<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import IPhListBulletsBold from '~icons/ph/list-bullets-bold'
import { LotteryResult } from '../MainPageProps'

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
      <div
        v-for="result in results"
        :key="`result-${result.id}`"
      >
        {{ result }}
      </div>
    </template>
  </AppCard>
</template>
