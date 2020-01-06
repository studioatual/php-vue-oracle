import store from '~/store';

export const ifNotAuthenticated = (to, from, next) => {
  if (store.getters['Auth/isAuthenticated']) {
    next('/panel');
    return;
  }

  if (localStorage.getItem('user-token')) {
    store.dispatch('Auth/autoLogin', { next, url: '/panel' });
    return;
  }

  next();
};

export const ifAuthenticated = (to, from, next) => {
  if (store.getters['Auth/isAuthenticated']) {
    next();
  }

  if (localStorage.getItem('user-token')) {
    store.dispatch('Auth/autoLogin', { next, url: null });
    return;
  }

  next('/auth');
};

export const logout = (to, from, next) => {
  if (store.getters['Auth/isAuthenticated']) {
    store.commit('Auth/SET_USER', null);
    localStorage.removeItem('user-token');
    next('/auth');
    return;
  }

  next();
};
