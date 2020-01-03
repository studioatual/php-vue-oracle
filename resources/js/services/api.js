import axios from 'axios';
import store from '~/store';

const api = axios.create({
  baseURL: process.env.API_URL,
});

const requestSuccess = config => {
  store.commit('Loader/SET_LOADER');

  if (store.getters['Auth/isAuthenticated']) {
    config.headers.common.Authorization = localStorage.getItem('user-token');
  }

  return config;
};

const requestError = err => {
  return Promise.reject(err);
};

const responseSuccess = response => {
  store.commit('Loader/REM_LOADER');
  return response;
};

const responseError = err => {
  store.commit('Loader/REM_LOADER');
  return Promise.reject(err);
};

api.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
api.interceptors.request.use(requestSuccess, requestError);
api.interceptors.response.use(responseSuccess, responseError);

export default api;
