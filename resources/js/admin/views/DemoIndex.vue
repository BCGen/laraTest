<template>
  <a-card title="報名列表" class="container">
    <base-table :columns="columns" :data-source="data" :row-selection="true" :row-index="true">
      <template slot="courses" slot-scope="{text}">
        <span v-for="(item, index) in text" :key="index">
          {{ item }}
          <br>
        </span>
      </template>
    </base-table>
  </a-card>
</template>

<script>

export default {
  name: 'DemoIndex',
  data() {
    return {
      /** @type *[] */
      data: [],
      columns: [
        {
          key: 'name',
          title: '姓名'
        }, {
          key: 'phone',
          title: '電話'
        }, {
          key: 'email',
          title: '信箱'
        }, {
          key: 'courses',
          title: '課程',
          scopedSlots: { customRender: 'courses' }
        }, {
          key: 'freebie',
          title: '贈品'
        }, {
          key: 'date',
          title: '報名日期'
        }, {
          key: 'action',
          title: '管理',
          scopedSlots: { customRender: 'action' },
          align: 'center',
          sorter: false
        }
      ]
    }
  },
  mounted() {
    for (let i = 0; i < 10000; i++) {
      this.data.push({
        id: i + 3,
        name: 'Joe Black' + i,
        phone: 2309305327905 + i,
        email: 'b32419er@asdf9o.com',
        courses: i % 2 === 0 ? ['前端開發', '手作設計'] : ['網頁設計', '咖啡達人'],
        freebie: i % 2 === 0 ? '星巴克' : '全家',
        date: '2018-10-31'
      })
    }
  }
}

</script>
