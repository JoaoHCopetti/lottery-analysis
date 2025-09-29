export const getMonthName = (monthZeroBased: number) =>
  new Date(1900, monthZeroBased, 1).toLocaleDateString(navigator.language, {
    month: 'long',
  })
