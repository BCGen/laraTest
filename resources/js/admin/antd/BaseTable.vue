<template>
  <div>
    <a-row type="flex" justify="space-between">
      <div v-if="selectedIds.length === 0"/>

      <a-button v-if="selectedIds.length !== 0" type="danger" @click="handleDelete">
        <a-icon type="delete"/>刪除
      </a-button>

      <a-input
        v-ant-ref="c => searchInput = c"
        class="mb-2"
        placeholder="搜尋"
        style="width: 188px; display: block;"
        @change="handleSearch"
      />
    </a-row>

    <a-table
      ref="table"
      v-bind="$attrs"
      :columns="columns"
      :row-selection="rowSelection"
      :data-source="data"
      :pagination="{
        showSizeChanger: true,
        showQuickJumper: true
      }"
      filtered="true"
    >
      <template v-for="item in scopedSlots" slot-scope="text, record, index" :slot="item">
        <slot v-bind="{text, record, index}" :name="item"/>
      </template>

      <delete-button slot="action" slot-scope="text"/>

      <!-- <img
        slot="index"
        slot-scope="text"
        src="http://kids.unicornplus.co.jp/storage/classCard/iqw5s7EAgazn04rsuW6m.jpeg"
        style="max-height: 100px;"
      >-->
      <span slot="index" slot-scope="text">{{ text }}</span>
    </a-table>
  </div>
</template>

<script>
export default {
  name: 'BaseTable',
  inheritAttrs: false,
  data() {
    return {
      /**  @type * */
      dataSource: [],
      /**  @type String */
      searchText: '',
      columns: [],
      /**  @type * */
      rowSelection: null,
      /**  @type * */
      selectedRows: [],
      /**  @type * */
      selectedIds: []
    }
  },
  computed: {
    scopedSlots() {
      return Object.values(this.columns).map(value => value['dataIndex'])
    },
    data() {
      if (this.$attrs['row-index']) {
        return Object.values(this.dataSource).map((value, key) => {
          return {
            rowIndex: key + 1,
            ...value
          }
        })
      }
      return this.dataSource
    }
  },
  watch: {
    selectedRows(value) {
      this.selectedIds = Object.values(value).map(value => value['id'])
    }
  },
  mounted() {
    this.initColumns()
    this.initDataSource()
    this.indtRowSelection()
  },
  methods: {
    sorter(a, b) {
      if ([typeof b, 'number'].indexOf(typeof a) === -1) {
        a = a.toString().toUpperCase()
        b = b.toString().toUpperCase()
      }

      return (a > b) ? 1 : (a < b) ? -1 : 0
    },
    handleDelete(e) {
      if (this.selectedIds.length > 0) {
        alert(this.selectedIds)
      }
    },
    handleSearch(e) {
      const searchText = e.target.value.toUpperCase()
      const dataSource = Object.values(this.$attrs['data-source'])

      dataSource
        .map((value, key) => {
          console.log(key)
          console.log(value)
          console.log(this.columns)
          return value
        })
        .filter(value => Object.values(value)
          .some(value => {
            value = Array.isArray(value) ? value.join(' ') : value.toString()
            return value.toUpperCase().indexOf(searchText) !== -1
          })
        )

      this.dataSource = dataSource
        .filter(value => Object.values(value)
          .some(value => {
            value = Array.isArray(value) ? value.join(' ') : value.toString()
            return value.toUpperCase().indexOf(searchText) !== -1
          })
        )
    },
    initColumns() {
      const em = this
      /** @type * */
      const columns = this.$attrs['columns']
      const rowIndex = this.$attrs['row-index']

      columns.forEach((value, key) => {
        const dataIndex = value['dataIndex'] || value['key']

        columns[key] = {
          dataIndex,
          sorter: (a, b) => em.sorter(a[dataIndex], b[dataIndex]),
          ...value
        }
      })

      if (rowIndex) {
        columns.unshift({
          key: 'rowIndex',
          dataIndex: 'rowIndex',
          title: typeof rowIndex === 'boolean' ? '#' : rowIndex,
          scopedSlots: { customRender: 'index' },
          sorter: (a, b) => em.sorter(a['rowIndex'], b['rowIndex'])
        })
      }

      this.columns = columns
    },
    initDataSource() {
      this.dataSource = this.$attrs['data-source']
    },
    indtRowSelection() {
      /** @type * */
      const rowSelection = this.$attrs['row-selection']

      if (rowSelection) {
        this.rowSelection = {
          onChange: (selectedRowKeys, selectedRows) => {
            this.selectedRows = selectedRows
          },
          ...rowSelection
        }
      }
    }
  }
}
</script>

<style lang="scss" module>
.ant-table-body {
  .ant-table-thead > tr,
  .ant-table-tbody > tr {
    border: 1px solid #e8e8e8 !important;
  }
}

</style>
