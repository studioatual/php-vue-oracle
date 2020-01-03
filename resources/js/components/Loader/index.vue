<template>
  <div id="loader" v-show="show > 0">
    <div class="load">
      <div class="item"></div>
      <div class="item"></div>
      <div class="item"></div>
      <div class="item"></div>
    </div>
  </div>
</template>
<script>
import { mapState } from 'vuex';

export default {
  name: 'Loader',
  computed: {
    ...mapState('Loader', ['show']),
  },
};
</script>
