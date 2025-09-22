<script setup lang="ts">
import { computed } from 'vue'

const HEADER_CLASS_COLOR_MAP = {
  primary: 'bg-blue-600 text-white',
}

const props = withDefaults(
  defineProps<{
    color?: keyof typeof HEADER_CLASS_COLOR_MAP
  }>(),
  { color: 'primary' },
)

const headerClass = computed(() => {
  const classes = []

  classes.push(HEADER_CLASS_COLOR_MAP[props.color])

  return classes
})
</script>

<template>
  <div class="shadow-lg">
    <div
      v-if="$slots['header']"
      class="rounded-t-md px-4 py-3 text-lg font-bold"
      :class="headerClass"
    >
      <slot name="header" />
    </div>

    <div
      class="rounded-b-md bg-white px-4 py-3"
      :class="{
        'rounded-t-md': !$slots['header'],
      }"
    >
      <slot name="body" />
    </div>
  </div>
</template>
