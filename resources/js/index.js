import Vue from 'vue';
import App from './App.vue';

import '../scss/main.scss';

import router from './routes';
import store from './store';

import './services/filters';

new Vue({
  store,
  router,
  render: h => h(App),
}).$mount('#app');
