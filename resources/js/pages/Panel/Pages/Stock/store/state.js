export default {
  list: [],
  query: {
    page: 1,
    per_page: 15,
    order: 'descricao',
    sort: 'asc',
    search: '',
    type: 'tag',
  },
  types: [
    { item: 'tag', name: 'Tag' },
    { item: 'descricao', name: 'Descrição' },
    { item: 'custo_medio', name: 'Custo Médio' },
    { item: 'quantidade_kg', name: 'Quantidade Kg' },
  ],
  current_page: null,
  per_page: 15,
  total: 0,
};
