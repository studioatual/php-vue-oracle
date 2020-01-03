<template>
  <div class="page">
    <div class="message">Entre com seu usuário e senha abaixo.</div>
    <form @submit.prevent="send" method="post" autocomplete="off" class="form">
      <div class="form-group" :class="{ 'error': errors.username }">
        <label>USUÁRIO</label>
        <input type="text" v-model="form.username" placeholder="Digite seu Usuário" />
        <span>{{ errors.username | first }}</span>
      </div>
      <div class="form-group" :class="{ 'error': errors.password }">
        <div class="form-group-line">
          <label>SENHA</label>
          <router-link
            :to="{ name: 'auth.forgot.password' }"
            class="form-group-link"
          >Esqueceu a senha?</router-link>
        </div>
        <input type="password" v-model="form.password" placeholder="Digite sua Senha" />
        <span>{{ errors.password | first }}</span>
      </div>
      <button type="submit" class="btn">Entrar</button>
    </form>
  </div>
</template>
<script>
import { mapActions, mapState } from 'vuex';

export default {
  name: 'Login',
  methods: {
    ...mapActions('Auth', ['login']),
    send() {
      this.login(this.form);
    },
  },
  computed: {
    ...mapState('Auth', ['form', 'errors']),
  },
};
</script>

