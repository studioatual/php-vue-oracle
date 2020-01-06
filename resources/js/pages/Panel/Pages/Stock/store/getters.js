const total_page = state => {
  if (state.total != 0) {
    return state.total % state.per_page == 0
      ? state.total / state.per_page
      : Math.floor(state.total / state.per_page) + 1;
  }
  return 0;
};

export default {
  total_page,
};
