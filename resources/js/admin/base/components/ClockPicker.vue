<template class="input-group clockpicker">
  <input
    ref="input"
    :value="value"
    :placeholder="placeholder"
    type="text"
    class="form-control text-center"
    @input="$emit('input', $event.target.value)"
  >
</template>

<script>

export default {
  name: 'ClockPicker',
  props: {
    value: {
      type: String,
      default: ''
    },
    placeholder: {
      type: String,
      default: ''
    }
  },
  mounted() {
    $(this.$el).clockpicker({
      placement: 'top',
      autoclose: true,
      vibrate: false,
      afterDone: () => {
        this.$emit('input', this.$refs.input.value)
        this.emitAfterDone()
      }
    })
  },
  methods: {
    emitAfterDone() {
      this.$emit('afterDone')
    }
  }
}

</script>

<style lang="scss">
  @import "../assets/scss/clockPicker";
</style>

<style lang="scss" scoped>
  input {
    cursor: pointer;
  }
</style>
