<template>
  <nav class="pagination">
    <ul>
      <li v-if="previousPagesVisible()">
        <a href="#" @click.prevent="change(1)" title="Primeira Página">
          <i class="fa fa-angle-double-left"></i>
        </a>
      </li>
      <li>
        <a
          v-if="prevPageVisible()"
          href="#"
          @click.prevent="change(current_page - 1)"
          title="Página Anterior"
        >
          <i class="fa fa-angle-left"></i>
        </a>
        <span v-else>
          <i class="fa fa-angle-left"></i>
        </span>
      </li>
      <li v-if="previousPagesVisible()">
        <span>...</span>
      </li>
      <li v-for="(page, index) in listCenter()" v-bind:key="index" :class="isActive(page)">
        <a href="#" @click.prevent="change(page)" :title="page">{{ page }}</a>
      </li>
      <li v-if="nextsPagesVisible()">
        <span>...</span>
      </li>
      <li>
        <a
          v-if="nextPageVisible()"
          href="#"
          @click.prevent="change(current_page + 1)"
          title="Próxima Página"
        >
          <i class="fa fa-angle-right"></i>
        </a>
        <span v-else>
          <i class="fa fa-angle-right"></i>
        </span>
      </li>
      <li v-if="nextsPagesVisible()">
        <a href="#" @click.prevent="change(total_page)" title="Última Página">
          <i class="fa fa-angle-double-right"></i>
        </a>
      </li>
    </ul>
  </nav>
</template>
<script>
export default {
  name: 'Pagination',
  props: ['current_page', 'total_page'],
  methods: {
    prevPageVisible() {
      return !(this.current_page - 1 < 1);
    },
    previousPagesVisible() {
      return !(this.current_page - 2 < 2);
    },
    listCenter() {
      const first_page = 1;
      const last_page = this.total_page;
      const prev_page =
        this.current_page - 2 < first_page ? first_page : this.current_page - 2;
      const next_page =
        this.current_page + 2 > last_page ? last_page : this.current_page + 2;
      const numbers = [];
      for (let i = prev_page; i <= next_page; i++) {
        numbers.push(i);
      }
      return numbers;
    },
    nextPageVisible() {
      return !(this.current_page + 1 > this.total_page);
    },
    nextsPagesVisible() {
      return !(this.current_page + 2 > this.total_page);
    },
    isActive(page) {
      return this.current_page === page ? 'active' : '';
    },
    change(page) {
      if (this.current_page !== page) {
        this.$emit('changePage', page);
      }
    },
  },
};
</script>
