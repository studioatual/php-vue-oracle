import Swal from 'sweetalert2';
import api from '~/services/api';

const getList = async ({ commit }, query) => {
  commit('SET_QUERY', query);

  let params = '?';
  params += `page=${query.page}`;
  params += `&per_page=${query.per_page}`;
  params += `&order=${query.order}`;
  params += `&sort=${query.sort}`;

  if (query.search !== '') {
    params += `&search=${query.search}`;
    params += `&type=${query.type}`;
  }

  try {
    const response = (await api.get(`stock${params}`)).data;
    commit('SET_LIST', response.data);
    commit('SET_CURRENT_PAGE', response.current_page);
    commit('SET_PER_PAGE', response.per_page);
    commit('SET_TOTAL', response.total);
  } catch (err) {
    if (err.response.data && err.response.data.message) {
      Swal.fire('Erro', err.response.data.message, 'error');
    }
  }
};

export default {
  getList,
};
