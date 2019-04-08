<template>
  <div id="app">
    <component :is="layout">
      <router-view></router-view>
    </component>
  </div>
</template>
<script>
const default_layout = 'test';
export default {
  computed:{
    layout(){
      return (this.$route.meta.layout || default_layout)
    }
  },
  created() {
    console.log(this.$route);
  }
}
</script>