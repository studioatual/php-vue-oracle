import Vue from 'vue';
import Vuex from 'vuex';

import Loader from '~/components/Loader/store';
import Auth from '~/pages/Auth/store';

Vue.use(Vuex);

const modules = {
  Loader,
  Auth,
};

export default new Vuex.Store({
  modules,
});
