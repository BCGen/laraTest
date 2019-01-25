<template>
  <div class="form-group row">
    <label
      class="col-12 col-form-label"
      for="date">
      日期
    </label>
    <div class="col-12 col-sm-6 col-lg-3">
      <flat-pickr
        v-model="dateData"
        :placeholder="date"
        class="form-control"
        required
        name="date"/>
    </div>
  </div>
</template>

<script>
import flatPickr from 'vue-flatpickr-component'

export default {
  name: 'DatePicker',
  components: {
    flatPickr
  },
  props: {
    date: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      dateData: ''
    }
  },
  mounted() {
    this.dateData = this.date ? this.date : new Date()
  }
}
</script>

<style lang="scss" scoped>
  @import "~flatpickr/dist/flatpickr.min.css";
</style>
