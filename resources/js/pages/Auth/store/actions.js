import Swal from 'sweetalert2';
import api from '~/services/api';
import router from '~/routes';

const login = async ({ commit }, form) => {
  try {
    commit('SET_ERRORS', []);

    const user = (await api.post('auth', JSON.stringify(form))).data;
    commit('SET_USER', user);
    localStorage.setItem('user-token', user.token);

    router.push({ name: 'panel' });
  } catch (err) {
    if (err.response.data && err.response.data.message) {
      Swal.fire('Erro', err.response.data.message, 'error');
      return;
    }
    commit('SET_ERRORS', err.response.data);
  }
};

const autoLogin = async ({ commit }) => {
  try {
    const token = localStorage.getItem('user-token');
    const user = (
      await api.get('auth', {
        headers: {
          Authorization: token,
        },
      })
    ).data;
    commit('SET_USER', user);
    router.push({ name: 'panel' });
  } catch (err) {
    localStorage.removeItem('user-token');
    if (err.response.status === 401) {
      router.push({ name: 'auth' });
    }
  }
};

const recoverLogin = async ({ commit }, email) => {
  try {
    const response = (
      await api.post('recover/password', JSON.stringify({ email }))
    ).data;
    router.push({ name: 'auth' });
    Swal.fire('Sucesso', 'Um E-mail foi enviado com a sua senha.', 'success');
  } catch (err) {
    console.log(err.response.data);
    if (err.response.data && err.response.data.message) {
      Swal.fire('Erro', err.response.data.message, 'error');
    }
    commit('SET_ERRORS', err.response.data);
  }
};

export default {
  login,
  autoLogin,
  recoverLogin,
};
