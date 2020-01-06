<template>
  <div class="sidebar" :class="{ 'closed': closed }">
    <div class="menus">
      <li v-for="(item, index) in menus" v-bind:key="index">
        <router-link :to="{ path: item.path }" :title="item.name">
          <span class="icon">
            <i :class="item.icon"></i>
          </span>
          {{ item.name }}
        </router-link>
      </li>
    </div>
  </div>
</template>
<script>
import { mapState, mapMutations } from 'vuex';

export default {
  name: 'Sidebar',
  methods: {
    ...mapMutations('Panel', ['SET_CLOSED']),
  },
  computed: {
    ...mapState('Panel', ['menus', 'closed']),
  },
};
</script>
