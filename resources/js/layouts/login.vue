<template>
   <div id="app">
       <b-loading :is-full-page="isFullPage" :active.sync="isLoading" :can-cancel="false"></b-loading>
       <router-view></router-view>
   </div>
</template>

<script>
export default {
    name: 'test',
     data() {
        return {
            isLoading: true,
            isFullPage: true
        }
    }
}
</script>