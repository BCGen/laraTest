<template>
  <div class="form-group row">
    <label
      :for="inputId"
      class="col-12 col-form-label"
      v-text="label"
    />

    <div class="col-12">
      <slot />
    </div>

  </div>
</template>

<script>
export default {
  name: 'FormGroup',
  props: {
    label: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      inputId: ''
    }
  },
  mounted() {
    console.log(this.$slots)

    /**
     * @type {VNode[] | undefined}
     */
    const slots = this.$slots.default

    if (slots) {
      const slot = slots[0].elm
      this.inputId = slot.id

      if (slot.type === 'file') {
        slot.classList.add('form-control-file')
      } else {
        slot.classList.add('form-control')
      }

      if (!slot.name) {
        slot.name = slot.id
      }
    }
  }
}
</script>
