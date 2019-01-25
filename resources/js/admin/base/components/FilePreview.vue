<template>
  <div class="row">
    <div
      v-for="(item, index) in fileList"
      :key="index"
      class="col-12 col-lg-6"
    >
      <div class="box p-2 d-flex align-items-center justify-content-between">
        <span>{{ item.file_name }}</span>
        <i
          class="fas fa-trash-alt fa-lg"
          @click="onDeleteClick(item, index)"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FilePreview',
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

<style lang="scss" scoped>
  .box {
    margin-bottom: 20px;
    // padding: 10px;
    border: 2px solid lightgray;
    border-radius: 5px;
  }

  span {
    max-width: 80%;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
  }

  i {
    color: white;
    background: #ff6a69;
    padding: 10px;
    cursor: pointer;
    transition-duration: 0.4s;
    border-radius: 5px;
  }

  i:hover {
    background: #ff3860;
    box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
    text-shadow: 3px 3px 3px rgba(0, 0, 0, 0.1);
  }

  img {
    max-width: 100%;
    max-height: 300px;
  }
</style>
