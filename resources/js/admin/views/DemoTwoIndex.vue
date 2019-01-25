<template>
  <base-card title="報名列表">
    <view-table :columns="columns" :data="data"/>
  </base-card>
</template>

<script>

export default {
  name: 'DemoTwoIndex',
  data() {
    return {
      /**
       * @type *[]
       */
      data: [],
      columns: [
        {
          type: 'selection',
          align: 'center',
          width: 60
        },
        {
          key: 'index',
          title: '#'
        },
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
    for (let i = 0; i < 100; i++) {
      this.data.push({
        key: i,
        index: i + 1,
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
