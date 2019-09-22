<template>
  <div id="app">
    <component :is="layout">
      <router-view></router-view>
    </component>
  </div>
</template>
<script>
const default_layout = "default";
export default {
  computed: {
    layout() {
      console.log(this.$route);
      return this.$route.meta.layout || default_layout;
    }
  },
  created() {}
};
</script>