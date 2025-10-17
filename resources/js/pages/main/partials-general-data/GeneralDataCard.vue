<script setup lang="ts">
import AppCard from '@/components/card/AppCard.vue'
import AppInputDate from '@/components/input/AppInputDate.vue'
import AppTabs from '@/components/tabs/AppTabs.vue'
import { router } from '@inertiajs/vue3'
import { useUrlSearchParams } from '@vueuse/core'
import IPhInfo from 'virtual:icons/ph/info-bold'
import { onMounted, ref } from 'vue'

const date = ref<Date | undefined>()
const urlParams = useUrlSearchParams()

defineProps<{
  minDate: string
}>()

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
      <AppTabs
        :tabs="[
          { slot: 'general', label: 'Geral' },
          { slot: 'selected-numbers', label: 'Números selecionados' },
        ]"
      >
        <template #[`general`]>
          <div>
            <AppInputDate
              v-model="date"
              label="A partir de:"
              :date-picker-props="{ minDate }"
              @update:model-value="onDateChange"
            />
          </div>
        </template>

        <template #[`selected-numbers`]> Números selecionados </template>
      </AppTabs>
    </template>
  </AppCard>
</template>
