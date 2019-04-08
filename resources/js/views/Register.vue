<template>
  <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Register</h3>
                    <div class="box">
                        <input type="hidden" name="_token" :value="csrf_token">
                        <div class="field">
                            <div class="control">
                                <input class="input is-large" v-model="email" placeholder="Your email" autofocus="true">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input is-large" v-model="username" placeholder="Your username" autofocus="true">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <input class="input is-large" v-model="password" type="password" placeholder="Your Password">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input is-large" v-model="repassword" type="password" placeholder="Type password again">
                            </div>
                        </div>
                        <div class="buttons is-centered are-medium">
                            <button @click="register" class="button is-block is-info is-large">Register</button>
                            <button @click="cancel" class="button is-block is-large">Cancel</button>
                        </div>
                    </div>
                    <p class="has-text-grey">
                        <router-link :to="{name:'register'}">Sign Up</router-link> 
                        <a href="../">Forgot Password</a> &nbsp;·&nbsp;
                        <a href="../">Need Help?</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
  metaInfo () {
    return { 
      title: 'Register'
      }
  },
  data(){
    return {
      email:'',
      password:'',
      repassword:'',
      username:'',
      token:''
    }
  },
  created(){
      
  },
  methods: {  
    register(){
      const data = {
        'email': this.email,
        'password': this.password,
        'username': this.username,
        _token: this.token
      }
      this.axios.post('/api/register',data).then((response) => {
        console.log(response.data)
      })
      console.log(this.email);
    },
    cancel(){

    }
    
  },
   computed: {
      csrf_token() {
        let token = document.head.querySelector('meta[name="csrf-token"]').getAttribute('value');
        this.token = token;
        return token;
      }
    },
}
</script>