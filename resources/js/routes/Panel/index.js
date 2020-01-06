import Panel from '~/pages/Panel';
import Dashboard from '~/pages/Panel/Pages/Dashboard';
import Stock from '~/pages/Panel/Pages/Stock';

import { ifAuthenticated } from '~/services/middleware';

export default {
  path: '/panel',
  name: 'panel',
  meta: {
    name: 'Panel',
  },
  beforeEnter: ifAuthenticated,
  component: Panel,
  redirect: '/panel/dashboard',
  children: [
    {
      path: '/panel/dashboard',
      name: 'panel.dashboard',
      meta: {
        name: 'Dashboard',
      },
      component: Dashboard,
    },
    {
      path: '/panel/Stock',
      name: 'panel.stock',
      meta: {
        name: 'Controle de Estoque',
      },
      component: Stock,
    },
  ],
};
