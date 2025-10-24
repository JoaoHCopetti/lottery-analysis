<template>
  <div>
    <div
      class="ml-4 inline-flex items-center rounded-t bg-blue-600 px-3 py-1 text-sm font-semibold whitespace-nowrap text-white shadow"
    >
      <slot name="title" />
    </div>

    <div class="rounded p-3 shadow">
      <slot name="body" />
    </div>
  </div>
</template>
