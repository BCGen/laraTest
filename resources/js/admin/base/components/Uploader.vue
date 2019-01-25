<template>
  <div>
    <input
      :id="id"
      type="file"
      multiple="false"
    >
  </div>
</template>

<script>
export default {
  name: 'Uploader',
  props: ['id']

}
</script>
