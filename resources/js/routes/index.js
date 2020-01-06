import Vue from 'vue';
import Router from 'vue-router';

import Auth from './Auth';
import Panel from './Panel';

import { logout } from '~/services/middleware';

Vue.use(Router);

export default new Router({
  routes: [
    Auth,
    Panel,
    {
      path: '/logout',
      name: 'logout',
      beforeEnter: logout,
    },
    {
      path: '*',
      redirect: '/auth',
    },
  ],
  mode: 'history',
});
