import Vue from 'vue';
import Vuex from 'vuex';

import Loader from '~/components/Loader/store';
import Auth from '~/pages/Auth/store';
import Panel from '~/pages/Panel/store';
import Dashboard from '~/pages/Panel/Pages/Dashboard/store';
import Stock from '~/pages/Panel/Pages/Stock/store';

Vue.use(Vuex);

const modules = {
  Loader,
  Auth,
  Panel,
  Dashboard,
  Stock,
};

export default new Vuex.Store({
  modules,
});
