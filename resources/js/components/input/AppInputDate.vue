<script setup lang="ts">
import { Menu, MenuButton, MenuItems } from '@headlessui/vue'
import { ref } from 'vue'
import AppDatePicker from '../date-picker/AppDatePicker.vue'
import AppInput from './AppInput.vue'

const selectedDate = ref<Date | undefined>()
const onDateSelect = (value?: Date) => {
  selectedDate.value = value
}
</script>

<template>
  <Menu
    as="div"
    class="relative"
  >
    <MenuButton class="w-full text-left">
      <AppInput
        v-bind="$attrs"
        type="date"
        placeholder="dd/mm/aaaa"
        :value="selectedDate"
      />
    </MenuButton>

    <MenuItems
      as="div"
      class="absolute left-0 z-50 mt-2 origin-top-right divide-y divide-gray-100 rounded-md border border-gray-100 bg-white shadow-lg focus:outline-none"
    >
      <div class="p-3">
        <AppDatePicker
          :value="selectedDate"
          @date-selected="onDateSelect"
        />
      </div>
    </MenuItems>
  </Menu>
</template>
