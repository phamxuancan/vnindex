<template>
  <section class="container">
    <button @click="logout()">logout</button>
</section>
</template>

<script>
    export default {
        layout:"index",
        mounted() {
            console.log(this.$route);
        },
        created(){
            this.axios.get('/api/user')
            .then((response) => {
                console.log(response);
            })
            .catch((error)=>{
            })
        },
        methods:{
            logout(){
               this.axios.post('/api/logout')
            .then((response) => {
                this.$router.push('login');
            })
            .catch((error)=>{
            })
            }
        }
    }
</script>