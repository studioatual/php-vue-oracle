export const { format: formatPrice } = new Intl.NumberFormat('pt-BR', {
  style: 'currency',
  currency: 'BRL',
});

export const { format: formatWeight } = new Intl.NumberFormat('pt-BR', {
  style: 'decimal',
  minimumFractionDigits: 3,
});
