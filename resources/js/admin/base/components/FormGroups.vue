<template>
  <div>
    <slot/>
  </div>
</template>

<script>
export default {
  name: 'FormGroups',
  props: {
    labelClass: {
      type: String,
      default: ''
    },
    inputClass: {
      type: String,
      default: ''
    }
  },
  mounted() {
    /** @type *[] | undefined */
    const slots = this.$slots.default
    const em = this

    slots && slots.forEach((value, key) => {
      if (em.labelClass && value.componentOptions && value.componentOptions.tag === 'form-group') {
        const labelClassList = value['elm']['children'][0].classList
        em.labelClass.split(' ').forEach(value => {
          if (value.trim()) {
            labelClassList.add(value)
          }
        })

        const inputClassList = value['elm']['children'][1].classList
        em.inputClass.split(' ').forEach(value => {
          if (value.trim()) {
            inputClassList.add(value)
          }
        })

        if (this.$attrs.hasOwnProperty('form-controller')) {
          const input = value['elm']['children'][1]['children'][0]
          if (input.type === 'file') {
            input.classList.add('form-control-file')
          } else {
            input.classList.add('form-control')
          }
        }
      }
    })
  }
}
</script>
