<script setup lang="ts">
import { computed } from 'vue'

const HEADER_CLASS_COLOR_MAP = {
  primary: 'bg-blue-600 text-white',
  danger: 'bg-red-700 text-white',
}

const props = withDefaults(
  defineProps<{
    color?: keyof typeof HEADER_CLASS_COLOR_MAP
    headerIcon?: any
    bodyClass?: string
  }>(),
  { color: 'primary', headerIcon: undefined, bodyClass: '' },
)

const headerClass = computed(() => {
  const classes = []

  classes.push(HEADER_CLASS_COLOR_MAP[props.color])

  return classes
})
</script>

<template>
  <div class="overflow-hidden rounded shadow-lg">
    <div
      v-if="$slots['header']"
      class="px-4 py-3 text-lg font-bold"
      :class="headerClass"
    >
      <div class="flex items-center">
        <Component
          :is="headerIcon"
          class="mr-2"
        />

        <slot name="header" />
      </div>
    </div>

    <div
      class="bg-white px-4 py-3"
      :class="bodyClass"
    >
      <slot name="body" />
    </div>
  </div>
</template>
