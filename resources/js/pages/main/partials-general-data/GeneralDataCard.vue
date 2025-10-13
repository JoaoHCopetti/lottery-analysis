<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import AppInputDate from '@/components/input/AppInputDate.vue'
import IPhInfo from 'virtual:icons/ph/info-bold'
import { ref } from 'vue'

const value = ref<string>()
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
          v-model="value"
          label="A partir de:"
        />
        {{ value }}
      </div>
    </template>
  </AppCard>
</template>
