<template>
  <flat-pickr
    v-model="date"
    :placeholder="date"
    :config="config"
    class="form-control"
    required
    name="date"/>
</template>

<script>
import flatPickr from 'vue-flatpickr-component'

export default {
  name: 'TimePicker',
  components: {
    flatPickr
  },
  data() {
    return {
      date: '請選擇時間',
      config: {
        wrap: true,
        altInput: true,
        enableTime: true,
        noCalendar: true,
        time_24hr: true
      }
    }
  }
}
</script>

<style lang="scss" scoped>
  @import "~flatpickr/dist/flatpickr.min.css";
</style>
