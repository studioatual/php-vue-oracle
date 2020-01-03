import Vue from 'vue';

Vue.filter('first', value => {
  if (value) {
    if (value.length > 0) {
      return value[0];
    }
  }
  return '';
});
