<template>
  <div class="page">
    <div class="page-title">
      <h1>Lista de Produtos</h1>
    </div>
    <div class="page-options">
      <div class="search">
        <div>
          <form @submit.prevent="search()" class="form">
            <div class="form-input">
              <input
                type="text"
                v-model="query.search"
                placeholder="Pesquise Aqui..."
              />
            </div>
            <div class="form-select">
              <select v-model="query.type">
                <option
                  v-for="(type, index) in types"
                  v-bind:key="index"
                  :value="type.item"
                  >{{ type.name }}</option
                >
              </select>
            </div>
            <div class="form-button">
              <button type="submit">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </form>
        </div>

        <div class="resultpage">
          <span class="resultpage-text">Resultados:</span>
          <div class="resultpage-select">
            <select
              name="per_page"
              @change="changeResultPage()"
              v-model="query.per_page"
            >
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="15">15</option>
              <option value="20">20</option>
              <option value="30">30</option>
              <option value="40">40</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="page-body">
      <table class="table table-striped table-hover">
        <thead>
          <th
            class="align-right tag"
            :class="{ active: query.order === 'tag' }"
          >
            <span @click="setOrder('tag')">
              <i :class="iconSort"></i>
              Tag
            </span>
          </th>
          <th :class="{ active: query.order === 'descricao' }">
            <span @click="setOrder('descricao')">
              <i :class="iconSort"></i>
              Descrição
            </span>
          </th>
          <th
            class="align-right custo_medio"
            :class="{ active: query.order === 'custo_medio' }"
          >
            <span @click="setOrder('custo_medio')">
              <i :class="iconSort"></i>
              Custo Médio
            </span>
          </th>
          <th
            class="align-right quantidade_kg"
            :class="{ active: query.order === 'quantidade_kg' }"
          >
            <span @click="setOrder('quantidade_kg')">
              <i :class="iconSort"></i>
              Quant. KG
            </span>
          </th>
        </thead>
        <tbody>
          <tr v-for="(item, index) in list" v-bind:key="index">
            <td class="align-right tag">{{ item.tag }}</td>
            <td class="descricao">{{ item.descricao }}</td>
            <td class="align-right custo_medio">
              {{ vPrice(item.custo_medio) }}
            </td>
            <td class="align-right quantidade_kg">
              {{ vWeight(item.quantidade_kg) }}
            </td>
          </tr>
        </tbody>
      </table>
      <pagination
        :current_page="current_page"
        :total_page="total_page"
        @changePage="changePage"
        v-if="total_page > 1"
      />
    </div>
  </div>
</template>
<script>
import { mapState, mapActions, mapGetters } from 'vuex';
import Pagination from '~/components/Pagination';
import { formatPrice, formatWeight } from '~/services/format';

export default {
  name: 'Stock',
  components: {
    Pagination,
  },
  methods: {
    ...mapActions('Stock', ['getList']),
    setOrder(order) {
      if (order !== this.query.order) {
        this.query.order = order;
        this.query.sort = 'asc';
      } else {
        this.query.sort = this.query.sort === 'desc' ? 'asc' : 'desc';
      }
      this.getList(this.query);
    },
    refresh() {
      this.getList({
        page: 1,
        per_page: 15,
        order: 'descricao',
        sort: 'asc',
        search: '',
        type: 'tag',
      });
    },
    changePage(page) {
      this.getList({
        ...this.query,
        page,
      });
    },
    changeResultPage() {
      this.getList({
        ...this.query,
        page: 1,
      });
    },
    search() {
      this.getList({
        ...this.query,
        page: 1,
      });
    },
    vPrice(value) {
      return formatPrice(parseFloat(value));
    },
    vWeight(value) {
      return formatWeight(parseFloat(value));
    },
  },
  computed: {
    ...mapState('Stock', ['query', 'types', 'list', 'current_page']),
    ...mapGetters('Stock', ['total_page']),
    iconSort() {
      return this.query.sort === 'asc'
        ? 'fa fa-sort-amount-down'
        : 'fa fa-sort-amount-up';
    },
  },
  mounted() {
    this.getList(this.query);
  },
};
</script>
