import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useLotteryStore = defineStore('lottery', () => {
  const highlightedNumber = ref<string>('')

  return { highlightedNumber }
})
