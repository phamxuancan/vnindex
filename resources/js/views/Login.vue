<template>
  <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Login</h3>
                    <div class="box">
                        <input type="hidden" name="_token" :value="csrf_token">
                        <div class="field">
                            <div class="control">
                                <input class="input is-large" v-model="username" placeholder="Your name" autofocus="true">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <input class="input is-large" v-model="password" type="password" placeholder="Your Password">
                            </div>
                        </div>
                        <div class="field">
                            <label class="checkbox">
                              <input type="checkbox">
                              Remember me
                            </label>
                        </div>
                        <button @click="login" class="button is-block is-info is-large is-fullwidth">Login</button>
                    </div>
                    <p class="has-text-grey">
                        <a href="../">Sign Up</a> &nbsp;·&nbsp;
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
      title: 'Login'
      }
  },
  data(){
    return {
      username:'',
      password:'',
      token:''
    }
  },
  created(){
      
  },
  methods: {  
    login(){
      const data = {
        'username': this.username,
        'password': this.password,
        _token: this.token
      }
      this.axios.post('/api/login',data).then((response) => {
        console.log(response.data)
      })
      console.log(this.username);
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