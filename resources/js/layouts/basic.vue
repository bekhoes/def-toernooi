<template>

  <div class="font-hairline h-screen w-screen flex text-gray-80 bg-def">
    <child />
  </div>
</template>

<script>
export default {
  name: 'BasicLayout'
}
</script>
<style scoped>
  .bg-def {
    background-image: url("/background_interchange.webp");
      background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    overflow-x:hidden;
  }
</style>
