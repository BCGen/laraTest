<template>
  <i class="fas fa-plus fa-2x" />
</template>

<script>

export default {
  name: 'PlusIcon'
}

</script>

<style lang="scss" scoped>
  i {
    color: silver;
    padding: 5px;
    cursor: pointer;
    transition-duration: 0.4s;
    border-radius: 8px;
  }

  i:hover {
    color: #17a2b8;
    text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.1);
  }
</style>
