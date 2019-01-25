<template>
  <div class="row">
    <image-box
      v-for="(item, index) in fileList"
      :key="index"
      :item="item"
      @delete="onDeleteClick(item, index)"
    />
  </div>
</template>

<script>

import imageBox from './ImageBox.vue'

export default {
  name: 'ImagePreview',
  components: {
    imageBox
  },
  props: ['action', 'list'],
  data() {
    return {
      fileList: []
    }
  },
  mounted() {
    if (this.list) {
      this.fileList = this.list
    }
  },
  methods: {
    onDeleteClick(item, index) {
      axios.delete(`${this.action}/${item.id}`)
        .then(response => {
          if (response.data.message === 'success') {
            this.removeItem(index)
          }
        })
        .catch(error => {
          console.log(error)
          alert('發生錯誤，請重新整理後再試一次。')
        })
    },
    removeItem(index) {
      this.list.splice(index, 1)
    }
  }
}

</script>
