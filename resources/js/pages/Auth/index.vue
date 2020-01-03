<template>
  <div id="auth">
    <div class="container">
      <div class="logotipo">
        <img :src="logo" border="0" alt="Citroflavor" />
      </div>
      <router-view />
    </div>
  </div>
</template>
<script>
import logo from '~/../assets/logotipo.png';

export default {
  name: 'Auth',
  data() {
    return {
      logo,
    };
  },
};
</script>
