<script setup lang="ts">
import IPhArrowLeftBold from 'virtual:icons/ph/arrow-left-bold'
import IPhArrowRightBold from 'virtual:icons/ph/arrow-right-bold'
import { inject, Ref } from 'vue'
import AppButton from '../button/AppButton.vue'
import { selectedMonthKey } from './date-picker-injection-keys'

const currentMonth = inject(selectedMonthKey) as Ref<number>
</script>

<template>
  <div class="flex items-center justify-between">
    <AppButton
      :icon="IPhArrowLeftBold"
      color="light"
      @click="currentMonth--"
    />

    <div class="font-bold">
      <AppButton
        color="light"
        class="mr-3"
        label="Fevereiro"
      />

      <AppButton
        color="light"
        label="2025"
      />
    </div>

    <AppButton
      :icon="IPhArrowRightBold"
      color="light"
      @click="currentMonth++"
    />
  </div>
</template>
