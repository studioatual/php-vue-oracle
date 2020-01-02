<template>
  <div>
    <h1>App</h1>
    <loader />
  </div>
</template>
<script>
import Loader from '~/components/Loader';

export default {
  name: 'App',
  components: {
    Loader,
  },
};
</script>
