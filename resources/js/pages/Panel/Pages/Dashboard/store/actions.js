import Swal from 'sweetalert2';
import api from '~/services/api';

const getList = async ({ commit }, init) => {
  try {
    const response = (await api.get('dashboard')).data;
    commit('SET_LIST', response);
    console.log(response);
    init();
  } catch (err) {
    console.log(err);
    if (err.response.data && err.response.data.message) {
      Swal.fire('Erro', err.response.data.message, 'error');
    }
  }
};

export default {
  getList,
};
