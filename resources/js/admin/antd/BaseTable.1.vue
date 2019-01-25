<template>
  <div>
    <a-input
      v-ant-ref="c => searchInput = c"
      class="mb-2"
      placeholder="搜尋"
      style="width: 188px; display: block;"
      @change="change"
      @pressEnter="enter"
    />

    <a-table
      v-bind="$attrs"
      :columns="columns"
      :row-selection="rowSelection"
      :data-source="dataSource"
      filtered="true"
    >
      <!-- <template v-for="item in scopedSlots">
        <slot :name="item" />
      </template>-->
      <slot name="courses"/>

      <span slot="action" slot-scope="text, record">
        <delete-button/>
      </span>

      <div
        slot="filterDropdown"
        slot-scope="{ setSelectedKeys, selectedKeys, confirm, clearFilters, column }"
        class="custom-filter-dropdown"
      >
        <a-input
          v-ant-ref="c => searchInput = c"
          :placeholder="`Search ${column.dataIndex}`"
          :value="selectedKeys[0]"
          style="width: 188px; margin-bottom: 8px; display: block;"
          @change="e => setSelectedKeys(e.target.value ? [e.target.value] : [])"
          @pressEnter="() => handleSearch(selectedKeys, confirm)"
        />

        <a-button
          type="primary"
          icon="search"
          size="small"
          style="width: 90px; margin-right: 8px"
          @click="() => handleSearch(selectedKeys, confirm)"
        >Search</a-button>

        <a-button size="small" style="width: 90px" @click="() => handleReset(clearFilters)">Reset</a-button>
      </div>

      <a-icon
        slot="filterIcon"
        slot-scope="filtered"
        :style="{ color: filtered ? '#108ee9' : undefined }"
        type="search"
      />

      <template slot="customRender" slot-scope="text">
        <span v-if="searchText">
          <template
            v-for="(fragment, i) in text.toString().split(new RegExp(`(?<=${searchText})|(?=${searchText})`, 'i'))"
          >
            <mark
              v-if="fragment.toLowerCase() === searchText.toLowerCase()"
              :key="i"
              class="highlight"
            >{{ fragment }}</mark>
            <template v-else>{{ fragment }}</template>
          </template>
        </span>

        <template v-else>{{ text }}</template>
      </template>
    </a-table>
  </div>
</template>

<script>

export default {
  name: 'BaseTable',
  inheritAttrs: false,
  data() {
    return {
      dataSource: [],
      searchText: '',
      columns: [],
      rowSelection: {
        onChange: (selectedRowKeys, selectedRows) => {
          console.log(`selectedRowKeys: ${selectedRowKeys}`, 'selectedRows: ', selectedRows)
        },
        onSelect: (record, selected, selectedRows) => {
          console.log(record, selected, selectedRows)
        },
        onSelectAll: (selected, selectedRows, changeRows) => {
          console.log(selected, selectedRows, changeRows)
        }
      }
    }
  },
  computed: {
    scopedSlots() {
      return Object.values(this.columns).map(value => value['dataIndex'])
    }
  },
  mounted() {
    console.log(this.$slots)
    const $el = this
    const rowSelection = this.$attrs['row-selection']

    const columns = this.$attrs['columns']

    this.dataSource = this.$attrs['data-source']

    columns.forEach((value, key) => {
      const dataIndex = value['dataIndex'] ? value['dataIndex'] : value['key']
      columns[key] = {
        dataIndex,
        sorter: (a, b) => $el.sorter(a[dataIndex], b[dataIndex]),
        scopedSlots: {
          filterDropdown: 'filterDropdown',
          filterIcon: 'filterIcon',
          customRender: 'customRender'
        },
        ...value
      }
    })

    this.columns = columns

    if (rowSelection !== true) {
      this.rowSelection = rowSelection === false ? null : rowSelection
    }
  },
  methods: {
    sorter(a, b) {
      if (typeof a !== typeof b || typeof a !== 'number') {
        a = a.toString().toUpperCase()
        b = b.toString().toUpperCase()
      }

      return (a > b) ? 1 : (a < b) ? -1 : 0
    },
    handleSearch (selectedKeys, confirm) {
      confirm()
      this.searchText = selectedKeys[0]
    },

    handleReset (clearFilters) {
      clearFilters()
      this.searchText = ''
    },
    enter() {
      console.log('hi')
    },
    change(e) {
      const searchText = e.target.value.toUpperCase()
      const dataSource = Object.values(this.$attrs['data-source'])

      this.dataSource = dataSource
        .filter(value => Object.values(value)
          .some(value => {
            value = Array.isArray(value) ? value.join(' ') : value.toString()
            return value.toUpperCase().indexOf(searchText) !== -1
          })
        )
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

.ant-pagination-options-size-changer.ant-select {
  margin-right: 0;
}
</style>
