<template>
  <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Login</h3>
                    <div class="box">
                        <div class="field">
                            <div class="control">
                                <p class="help is-danger" v-if="submit && !$v.email.required">Field is required</p>
                                <input class="input is-large" :class="{ 'is-danger': submit && !$v.email.required }" v-model.trim="email" placeholder="Your email" autofocus="true">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <p class="help is-danger" v-if="submit && !$v.password.required">Field is required</p>
                                <input class="input is-large" :class="{ 'is-danger': submit && !$v.password.required }" v-model.trim="password" type="password" placeholder="Your Password">
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
import { required, minLength, between } from 'vuelidate/lib/validators'
import Swal from 'sweetalert2'
export default {
  metaInfo () {
    return { 
      title: 'Login'
      }
  },
  data(){
    return {
      email:'',
      password:'',
      token:'',
      submit: false
    }
  },
  created(){
      this.$parent.isLoading = false;
  },
   validations: {
    email: {
      required
    },
    password: {
     required
    }
  },
  methods: {  
    login(){
        this.submit = true;
        if(!this.$v.$invalid){
            const data = {
                'email': this.email,
                'password': this.password,
            }
            this.axios.post('/api/login',data)
            .then((response) => {
                Swal.fire({
                    title: 'Success!',
                    text: 'Login successful',
                    type: 'success',
                    confirmButtonText: 'OK'
                })
                this.$store.commit('authenticated');
                this.$router.push('home') 
            })
            .catch((error)=>{
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong!',
                    type: 'error',
                    confirmButtonText: 'OK'
                })
            })
        }
    }
  },
   computed: {
    },
}
</script>