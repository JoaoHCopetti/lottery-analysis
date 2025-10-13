<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import AppInputDate from '@/components/input/AppInputDate.vue'
import IPhInfo from 'virtual:icons/ph/info-bold'
import { ref } from 'vue'

const date = ref<Date | undefined>()
</script>

<template>
  <AppCard
    :header-icon="IPhInfo"
    :body-props="{ class: 'h-[calc(100vh-80px)]' }"
  >
    <template #header> Dados gerais </template>

    <template #body>
      <div>
        <AppInputDate
          v-model="date"
          label="A partir de:"
        />
      </div>
    </template>
  </AppCard>
</template>
