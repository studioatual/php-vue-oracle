const SET_COUNTER = state => {
  state.counter = 1;
};

const REM_COUNTER = state => {
  state.counter = 0;
};

export default {
  SET_COUNTER,
  REM_COUNTER,
};
