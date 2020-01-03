import Auth from '~/pages/Auth';
import Login from '~/pages/Auth/Sections/Login';
import ForgotPassword from '~/pages/Auth/Sections/ForgotPassword';

import { ifNotAuthenticated, checkToken } from '~/services/middleware';

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
      beforeEnter: checkToken,
      component: Login,
    },
    {
      path: '/auth/forgot-password',
      name: 'auth.forgot.password',
      meta: {
        name: 'Forgot Password',
      },
      beforeEnter: checkToken,
      component: ForgotPassword,
    },
  ],
};
