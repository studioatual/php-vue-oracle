const SET_ERRORS = (state, errors) => {
  state.errors = errors;
};

const SET_USER = (state, user) => {
  state.user = user;
};

const RESET_FORM = state => {
  state.form = {
    username: '',
    password: '',
  };
};

export default {
  SET_ERRORS,
  SET_USER,
  RESET_FORM,
};
