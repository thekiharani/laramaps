<template>
<div class="fancy">
    {{ message }}
</div>
</template>

<script>
const default_layout = "default";

export default {
  computed: {},
  data() {
      return {
          message:'Hello World'
      }
  }
};
</script>

<style scoped>
    /*.fancy {
        font-family: "Sacramento", cursive !important;
        font-size: 2em;
    }*/
</style>
