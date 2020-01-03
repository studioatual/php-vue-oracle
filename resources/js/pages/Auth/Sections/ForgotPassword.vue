<template>
  <div class="page">
    <div class="message">
      Confirme seu E-mail de Registro
      <br />para receber a Senha
    </div>
    <form @submit.prevent="send" method="post" autocomplete="off" class="form">
      <div class="form-group">
        <input type="email" v-model="email" placeholder="E-mail" required />
      </div>
      <div class="form-group">
        <button class="btn">Enviar</button>
      </div>
      <div class="form-group">
        <router-link
          :to="{ name: 'auth.login' }"
          title="Voltar ao Login"
          class="btn goback"
        >Voltar ao Login</router-link>
      </div>
    </form>
  </div>
</template>
<script>
import { mapActions } from 'vuex';

export default {
  name: 'ForgotPassword',
  data() {
    return {
      email: '',
    };
  },
  methods: {
    ...mapActions('Auth', ['recoverLogin']),
    send() {
      this.recoverLogin(this.email);
    },
  },
};
</script>
