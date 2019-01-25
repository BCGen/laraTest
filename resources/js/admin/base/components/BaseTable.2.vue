<template>
  <div>
    <vuetable
      ref="vuetable"
      :fields="field"
      :data="data"
      :api-mode="false"
      :per-page="5"
      pagination-path=""
      @vuetable:pagination-data="onPaginationData"
    />
    <div class="pagination ui basic segment grid">
      <vuetable-pagination-info
        ref="paginationInfo"
      />

      <vuetable-pagination
        ref="pagination"
        @vuetable-pagination:change-page="onChangePage"
      />
    </div>
  </div>
</template>

<script>
import Vuetable from 'vuetable-2'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination.vue'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo.vue'

export default {
  // name: 'BaseTable',
  components: {
    Vuetable, VuetablePagination, VuetablePaginationInfo
  },
  data() {
    return {
      field: ['name', 'nickname', 'email', 'gender'],
      data: [
        {
          'id': 0,
          'name': "Noelia O'Kon",
          'nickname': 'asperiores',
          'email': 'otho.smitham@example.com',
          'birthdate': '1978-06-28 00:00:00',
          'gender': 'F',
          'salary': '13098.00',
          'group_id': 2,
          'created_at': '2017-01-01 07:21:10',
          'updated_at': '2017-01-01 07:21:10',
          'age': 40,
          'group': {
            'id': 2,
            'name': 'Exec',
            'description': 'Executives'
          }
        }
      ]
    }
  },
  mounted() {
    for (let i = 0; i < 10; i++) {
      this.data.push(
        {
          'id': i,
          'name': 'Lexi Braun MD',
          'nickname': 'autem',
          'email': 'dusty74@example.net',
          'birthdate': '1971-12-07 00:00:00',
          'gender': 'F',
          'salary': '11927.00',
          'group_id': 4,
          'created_at': '2017-01-01 07:21:10',
          'updated_at': '2017-01-01 07:21:10',
          'age': 47,
          'group': {
            'id': 4,
            'name': 'Sup',
            'description': 'Supervisors'
          },
          'address': {
            'id': 15,
            'user_id': 15,
            'line1': '6737 Schimmel Crossing Suite 720\nShieldsberg, AK 44558',
            'line2': 'Tanzania',
            'zipcode': '75615',
            'mobile': '338.920.3112',
            'fax': '(467)912-6668'
          }
        }
      )
    }
  },
  methods: {
    onPaginationData(paginationData) {
      this.$refs.pagination.setPaginationData(paginationData)
      this.$refs.paginationInfo.setPaginationData(paginationData)
    },
    onChangePage(page) {
      this.$refs.vuetable.changePage(page)
    }
  }
}
</script>
