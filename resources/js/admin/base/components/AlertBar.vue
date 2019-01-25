<template>
  <div
    ref="alert"
    :class="alertColor"
    class="alert text-center"
    v-html="message"
  />
</template>

<script>
export default {
  name: 'AlertBar',
  props: {
    message: {
      type: String,
      default: ''
    },
    color: {
      type: String,
      default: 'success'
    },
    delay: {
      type: Number,
      default: 2000
    },
    duration: {
      type: Number,
      default: 500
    }
  },
  computed: {
    alertColor() {
      return `alert-${this.color}`
    }
  },
  mounted() {
    $(this.$el).fadeTo(this.delay, this.duration).slideUp(this.duration)
  }
}
</script>
