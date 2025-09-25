<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import AppDatePicker from '@/components/date-picker/AppDatePicker.vue'
import IPhInfo from 'virtual:icons/ph/info-bold'
</script>

<template>
  <AppCard
    :header-icon="IPhInfo"
    :body-props="{ class: 'h-[calc(100vh-80px)]' }"
  >
    <template #header> Dados gerais </template>

    <template #body>
      <AppDatePicker />
    </template>
  </AppCard>
</template>
