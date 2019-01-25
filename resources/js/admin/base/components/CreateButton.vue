<template>
  <div>
    <a
      :href="createHref"
      role="button"
      class="btn btn-primary"
      v-text="label"
    />
  </div>
</template>

<script>

export default {
  name: 'CreateButton',
  props: {
    label: {
      type: String,
      default: '新增'
    },
    href: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      createHref: ''
    }
  },
  mounted() {
    this.createHref = this.href !== '' ? this.href : `${this.$_helper.getRoute()}/create`
  }
}

</script>
