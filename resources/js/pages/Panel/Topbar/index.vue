<template>
  <div class="topbar">
    <div class="topbar-bg" :class="{ 'show': showMenu || showUser }"></div>
    <div class="topbar-menus">
      <button class="topbar-menus-btn" @click="toggleMenu" :class="{ 'active': showMenu }">
        <i class="fa fa-bars"></i>
      </button>
      <div class="topbar-menus-popup" :class="{ 'show': showMenu }">
        <ul>
          <li v-for="(item, index) in menus" @click="toggleMenu" v-bind:key="index">
            <router-link :to="{ path: item.path }" :title="item.name">
              <span class="icon">
                <i :class="item.icon"></i>
              </span>
              {{ item.name }}
            </router-link>
          </li>
        </ul>
      </div>
    </div>
    <div class="container" :class="{ closed: closed }">
      <button @click="() => this.SET_CLOSED(!this.closed)">
        <i :class="arrow"></i>
      </button>
      <img :src="logo" alt="Citroflavor" />
    </div>
    <div class="breadcrumb">
      <span>{{ showName() }}</span>
    </div>
    <div class="userinfo">
      <span class="userinfo-text">{{ user.name }}</span>
      <span class="userinfo-icon" @click="toggleUserInfo" :class="{ 'active': showUser }">
        <i class="fa fa-user"></i>
      </span>
      <div class="userinfo-popup" :class="{ 'show': showUser }">
        <ul>
          <li>
            <router-link :to="{ name: 'logout' }">Sair</router-link>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState, mapMutations } from 'vuex';
import logo from '~/../assets/logotipo.png';

export default {
  name: 'Topbar',
  data() {
    return {
      logo,
      showUser: false,
      showMenu: false,
    };
  },
  methods: {
    ...mapMutations('Panel', ['SET_CLOSED']),
    toggleMenu() {
      this.showMenu = !this.showMenu;
      this.showUser = false;
    },
    toggleUserInfo() {
      this.showUser = !this.showUser;
      this.showMenu = false;
    },
    showName() {
      const item = this.list[this.list.length - 1];
      if (item.meta && item.meta.name) {
        return item.meta && item.meta.name;
      }
      return item.name;
    },
  },
  computed: {
    ...mapState('Panel', ['menus', 'closed']),
    ...mapState('Auth', ['user']),
    arrow() {
      return this.closed
        ? 'fa fa-angle-double-right'
        : 'fa fa-angle-double-left';
    },
    list() {
      return this.$route.matched;
    },
  },
};
</script>
