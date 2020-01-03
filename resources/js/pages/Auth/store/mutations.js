const SET_ERRORS = (state, errors) => {
  state.errors = errors;
};

const SET_USER = (state, user) => {
  state.user = user;
};

export default {
  SET_ERRORS,
  SET_USER,
};
