<template>
  <section class="container">
    <button @click="test()">fgdfds</button>
</section>
</template>

<script>
    export default {
        layout:"index",
        mounted() {
            console.log(this.$route);
        },
        methods:{
            test(){
               this.axios.get('/api/user')
            .then((response) => {
            })
            .catch((error)=>{
            })
            }
        }
    }
</script>