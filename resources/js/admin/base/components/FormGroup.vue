<template>
  <div class="form-group row">
    <label :for="inputId" v-text="label"/>
    <div>
      <slot/>
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
    /** @type {*[] | undefined} */
    const slots = this.$slots.default

    if (slots) {
      const slot = slots[0].elm
      this.inputId = slot.id

      // if (slot.type === 'file') {
      //   slot.classList.add('form-control-file')
      // } else {
      //   slot.classList.add('form-control')
      // }

      console.log(slot)
      if (!slot.name) {
        slot.name = slot.id
      }
    }
  }
}
</script>
