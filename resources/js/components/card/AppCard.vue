<script setup lang="ts">
import { computed, HTMLAttributes } from 'vue'

const HEADER_COLOR_CLASS_MAP = {
  primary: 'bg-blue-600 text-white',
  danger: 'bg-red-700 text-white',
}

const props = withDefaults(
  defineProps<{
    color?: keyof typeof HEADER_COLOR_CLASS_MAP
    headerIcon?: any
    bodyProps?: HTMLAttributes
    fadeBottom?: boolean
  }>(),
  {
    color: 'primary',
    headerIcon: undefined,
    bodyProps: undefined,
    fadeBottom: false,
  },
)

const headerClass = computed(() => {
  const classes = []

  classes.push(HEADER_COLOR_CLASS_MAP[props.color])

  return classes
})
</script>

<template>
  <div class="relative overflow-hidden rounded shadow-lg">
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
      class="relative bg-white px-4 py-3"
      v-bind="bodyProps"
    >
      <slot name="body" />
    </div>

    <div
      v-if="fadeBottom"
      class="absolute bottom-0 left-0 h-14 w-[calc(100%-14px)] bg-gradient-to-t from-white to-transparent"
    />
  </div>
</template>
