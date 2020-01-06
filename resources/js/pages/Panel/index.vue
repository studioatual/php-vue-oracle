<template>
  <div id="panel">
    <topbar />
    <sidebar />
    <div class="pages" :class="{ 'opened': closed }">
      <router-view />
    </div>
  </div>
</template>
<script>
import { mapState } from 'vuex';
import Topbar from './Topbar';
import Sidebar from './Sidebar';

export default {
  name: 'Panel',
  components: {
    Topbar,
    Sidebar,
  },
  computed: {
    ...mapState('Panel', ['closed']),
  },
};
</script>
