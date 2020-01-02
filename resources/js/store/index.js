import Vue from 'vue';
import Vuex from 'vuex';

import Loader from '~/components/Loader/store';

Vue.use(Vuex);

const modules = {
  Loader,
};

export default new Vuex.Store({
  modules,
});
