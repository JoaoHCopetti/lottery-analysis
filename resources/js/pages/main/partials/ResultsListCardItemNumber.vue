<script setup lang="ts">
defineProps<{
  number: string
}>()
</script>

<template>
  <span class="flex size-10 items-center justify-center rounded-full bg-red-500 text-lg font-bold">
    {{ number }}
  </span>
</template>
