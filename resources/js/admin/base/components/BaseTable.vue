<template>
  <div>
    <!-- <button @click="click">goto</button> -->
    <v-client-table
      ref="table"
      :data="data"
      :columns="columns"
      :options="optionsData"
    >
      <!-- <div
        slot="index"
        slot-scope="props"
        v-text="props.index"
      />
      <div
        slot="id"
        slot-scope="props"
      >
        <input
          v-model="allMarked"
          type="checkbox"
          class="form-control"
          @change="markAll()">
      </div> -->
    </v-client-table>
  </div>
</template>

<script>
export default {
  name: 'BaseTable',
  props: ['columns', 'data', 'options'],
  data() {
    return {
      allMarked: [],
      optionsData: {
        templates: {
          // action: 'DeleteButton'
        },
        texts: {
          count: '顯示 {from} - {to} 共 {count} 筆資料|共 {count} 筆資料|共 1 筆資料',
          limitBefore: '顯示',
          limitAfter: '項',
          filterPlaceholder: '搜尋'
        },
        pagination: {
          // edge: true
          // dropdown: true
        },
        sortIcon: {
          base: 'fa fas',
          is: 'fa-sort',
          up: 'fa-sort-up',
          down: 'fa-sort-down'
        }
      }
    }
  },
  mounted() {
    this.optionsData = {
      ...this.optionsData,
      ...this.options
    }
  },
  methods: {
    markAll() {

    },
    click() {
      this.$refs.table.setPage(10)
    }
  }
}
</script>

<style lang="scss" >
  .table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9;
  }

  .table-striped tbody tr:nth-of-type(even) {
    background-color: #fcfcfc;
  }

  .table-striped tbody tr:hover {
    background-color: #eee;
  }
</style>
