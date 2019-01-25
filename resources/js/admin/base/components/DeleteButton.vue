<template>
  <div class="d-inline">
    <i
      :data-target="modalIdSelector"
      data-toggle="modal"
      class="fas fa-trash-alt fa-sm"
      @click="onDeleteClick"
    />

    <!-- Modal -->
    <div
      :id="modalId"
      class="modal fade"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-dialog-centered"
        role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              id="exampleModalLongTitle"
              class="modal-title">刪除檔案</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div
            v-if="!isLoading && !hasError"
            class="modal-body">
            確定刪除檔案嗎？
          </div>

          <div v-if="isLoading && !hasError">
            <div
              class="modal-body">
              刪除中，請稍後...
            </div>
            <div class="progress">
              <div
                class="progress-bar progress-bar-striped progress-bar-animated bg-danger w-100"
                role="progressbar"
              />
            </div>
          </div>

          <div
            v-if="hasError"
            class="modal-body text-danger"
            v-text="error"/>

          <div class="modal-footer">
            <button
              :disabled="isLoading"
              type="button"
              class="btn btn-primary"
              data-dismiss="modal">取消</button>

            <button
              :disabled="isLoading"
              type="button"
              class="btn btn-danger"
              @click="onSubmit">確定</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'DeleteButton',
  props: ['item_id', 'route'],
  data() {
    return {
      isLoading: false,
      error: '',
      location: ''
    }
  },
  computed: {
    hasError() {
      return this.error.length !== 0
    },
    modalId() {
      return 'model' + this.item_id
    },
    modalIdSelector() {
      return '#' + this.modalId
    }
  },
  methods: {
    onSubmit() {
      this.isLoading = true
      this.setLocation()
      axios.delete(`${this.location}/${this.item_id}`)
        .then(respose => {
          window.location.href = this.location
        }).catch(error => {
          console.log(error)
          this.error = '發生錯誤，請刷新頁面後再試一次。'
          this.isLoading = false
        })
    },

    onDeleteClick() {
      this.error = ''
    },

    setLocation() {
      this.location = this.route ? this.route : window.location.href
    }
  }
}
</script>

<style lang="scss" scoped>
  i {
    color: white;
    background: #ff6a69;
    padding: 8px 10px;
    cursor: pointer;
    transition-duration: 0.4s;
    border-radius: 4px;
    margin: 3px 5px;
  }

  i:hover {
    // color: #ff3860;
    background: #ff3860;
    box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
    text-shadow: 3px 3px 3px rgba(0, 0, 0, 0.1);
  }
</style>
