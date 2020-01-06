const SET_LIST = (state, list) => {
  state.list = list;
};

const SET_QUERY = (state, query) => {
  state.query = query;
};

const SET_CURRENT_PAGE = (state, current_page) => {
  state.current_page = current_page;
};

const SET_PER_PAGE = (state, per_page) => {
  state.per_page = per_page;
};

const SET_TOTAL = (state, total) => {
  state.total = total;
};

export default {
  SET_LIST,
  SET_QUERY,
  SET_CURRENT_PAGE,
  SET_PER_PAGE,
  SET_TOTAL,
};
