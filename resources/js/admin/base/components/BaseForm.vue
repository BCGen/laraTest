<template>
  <form :action="action" :method="formMethod" :enctype="enctype">
    <input v-if="showHiddenMethodInput" :value="hiddenMethod" type="hidden" name="_method">

    <input :value="formApi.csrf()" type="hidden" name="_token">

    <slot/>
  </form>
</template>

<script>
import propsValidator from '../utils/propsValidator'
import FormApi from '../utils/formApi'

export default {
  name: 'BaseForm',
  props: {
    /** @type * */
    method: {
      type: String,
      default: '',
      validator(value) {
        const values = ['', 'get', 'post', 'patch', 'put', 'delete']
        return propsValidator.indexOf(values, value)
      }
    }
  },
  data() {
    return {
      action: '',
      /** @type * */
      hiddenMethod: '',
      /** @type Null | 'multipart/form-data' */
      enctype: null,
      formApi: new FormApi()
    }
  },
  computed: {
    showHiddenMethodInput() {
      if (!this.hiddenMethod) {
        return false
      }
      return ['get', 'post'].indexOf(this.hiddenMethod) === -1
    },
    formMethod() {
      return this.hiddenMethod === 'get' ? 'get' : 'post'
    }
  },
  mounted() {
    this.action = this.$attrs.action ? this.$attrs.action : this.formApi.action()
    this.hiddenMethod = this.method ? this.method : this.formApi.method()
    this.setEnctype()
  },
  methods: {
    setEnctype() {
      /** @type * */
      const elm = this.$vnode.elm
      for (let i = 0; i < elm.length; i++) {
        if (elm[i].type === 'file') {
          this.enctype = 'multipart/form-data'
          break
        }
      }
    }
  }
}
</script>
