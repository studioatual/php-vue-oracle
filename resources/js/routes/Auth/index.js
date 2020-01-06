import Auth from '~/pages/Auth';
import Login from '~/pages/Auth/Pages/Login';
import ForgotPassword from '~/pages/Auth/Pages/ForgotPassword';

import { ifNotAuthenticated } from '~/services/middleware';

export default {
  path: '/auth',
  name: 'auth',
  meta: {
    name: 'Auth',
  },
  beforeEnter: ifNotAuthenticated,
  component: Auth,
  redirect: '/auth/login',
  children: [
    {
      path: '/auth/login',
      name: 'auth.login',
      meta: {
        name: 'Login',
      },
      component: Login,
    },
    {
      path: '/auth/forgot-password',
      name: 'auth.forgot.password',
      meta: {
        name: 'Forgot Password',
      },
      component: ForgotPassword,
    },
  ],
};
