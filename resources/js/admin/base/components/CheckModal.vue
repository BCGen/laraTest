<template>
  <div
    data-backdrop="static"
    data-keyboard="false"
    class="modal fade"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">

    <div
      class="modal-dialog modal-dialog-centered"
      role="document">

      <div
        v-if="!showProgress"
        class="modal-content">

        <div class="modal-header">
          <h5
            class="modal-title"
            v-html="title"
          />

          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>

        <div
          class="modal-body"
          v-html="content"
        />

        <div class="modal-footer">
          <button
            :class="cancelBtnColor"
            type="button"
            class="btn"
            data-dismiss="modal"
            v-html="cancelLabel"
          />

          <button
            :disabled="showProgress"
            :class="checkBtnColor"
            type="button"
            class="btn"
            @click="toggleProgress"
            v-html="checkLabel"
          />
        </div>
      </div>

      <div
        v-if="showProgress"
        class="modal-content py-3 px-2">

        <div class="modal-body text-center">
          {{ progressContent }}
          <div class="progress mt-3">
            <div
              class="progress-bar progress-bar-striped progress-bar-animated bg-danger w-100"
              role="progressbar"
            />
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<script>

export default {
  name: 'CheckModal',
  props: {
    content: {
      type: String,
      default: ''
    },
    title: {
      type: String,
      default: ''
    },
    cancelLabel: {
      type: String,
      default: '取消'
    },
    cancelColor: {
      type: String,
      default: 'secondary'
    },
    checkLabel: {
      type: String,
      default: '確定'
    },
    checkColor: {
      type: String,
      default: 'primary'
    },
    progressContent: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      showProgress: false
    }
  },
  computed: {
    cancelBtnColor: function() {
      return `btn-${this.cancelColor}`
    },
    checkBtnColor: function() {
      return `btn-${this.checkColor}`
    }
  },
  methods: {
    toggleProgress() {
      this.showProgress = !this.showProgress
    }
  }
}

</script>

<style lang="scss" scoped>
  .modal {
    padding-right: 0 !important;
  }
</style>
