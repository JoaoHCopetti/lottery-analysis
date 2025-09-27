<script setup lang="ts">
import { computed, useSlots } from 'vue'

const BUTTON_COLOR_CLASS_MAP = {
  primary: 'bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white',
  light: 'bg-white hover:bg-gray-200 active:bg-gray-300 text-gray-900',
  danger: 'bg-red-700 hover:bg-red-800 active:bg-red-900 text-white',
}

const props = withDefaults(
  defineProps<{
    label?: string
    icon?: any
    color?: keyof typeof BUTTON_COLOR_CLASS_MAP
  }>(),
  {
    label: '',
    icon: '',
    color: 'primary',
    iconOnly: false,
  },
)

const isIconOnly = computed(() => props.icon && !props.label && !useSlots()['label'])
</script>

<template>
  <button
    class="cursor-pointer rounded-md p-2 transition-all"
    :class="[
      BUTTON_COLOR_CLASS_MAP[color],
      {
        'flex size-9 items-center justify-center': isIconOnly,
      },
    ]"
  >
    <Component
      :is="icon"
      v-if="icon"
    />

    <slot
      v-if="$slots['label']"
      name="label"
    />

    <template v-else>{{ label }}</template>
  </button>
</template>
