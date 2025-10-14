<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import AppInputDate from '@/components/input/AppInputDate.vue'
import { router } from '@inertiajs/vue3'
import { useUrlSearchParams } from '@vueuse/core'
import IPhInfo from 'virtual:icons/ph/info-bold'
import { onMounted, ref } from 'vue'

const date = ref<Date | undefined>()
const urlParams = useUrlSearchParams()

onMounted(() => {
  if (urlParams.date) {
    date.value = new Date(urlParams.date + ' 00:00')
  }
})

const onDateChange = () => {
  const changedDate = date.value?.toISOString().split('T')[0]

  router.reload({ data: { date: changedDate } })
}
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
          @update:model-value="onDateChange"
        />
      </div>
    </template>
  </AppCard>
</template>
