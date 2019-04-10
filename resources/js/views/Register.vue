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
                                <p class="help is-danger" v-if="submit && !$v.email.required">Field is required</p>
                                <input class="input is-large" :class="{ 'is-danger': submit && !$v.email.required }" v-model.trim="email" placeholder="Your email" autofocus="true">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <p class="help is-danger" v-if="submit && !$v.username.required">Field is required</p>
                                <input class="input is-large" :class="{ 'is-danger': submit && !$v.username.required }" v-model.trim="username" placeholder="Your username" autofocus="true">
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <p class="help is-danger" v-if="submit && !$v.password.required">Field is required</p>
                                <input class="input is-large" :class="{ 'is-danger': submit && !$v.password.required }" v-model.trim="password" type="password" placeholder="Your Password">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <p class="help is-danger" v-if="submit && !$v.password_confirmation.required">Field is required</p>
                                <input class="input is-large" :class="{ 'is-danger':submit && !$v.password_confirmation.required }" v-model.trim="password_confirmation " type="password" placeholder="Type password again">
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
import { required, minLength, between } from 'vuelidate/lib/validators'
import Swal from 'sweetalert2'
export default {
  metaInfo () {
    return { 
      title: 'Register'
      }
  },
  data(){
    return {
      email: '',
      password: '',
      password_confirmation: '',
      username: '',
      token: '',
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
    },
    password_confirmation: {
      required
    },
    username: {
      required
    }
  },
  methods: {  
    register(){
        this.submit = true;
        if(!this.$v.$invalid){
            const data = {
                email: this.email,
                password: this.password,
                username: this.username,
                password_confirmation: this.password_confirmation,
                _token: this.token
            }
            this.axios.post('/api/register',data)
            .then((response) => {
                Swal.fire({
                    title: 'Success!',
                    text: 'Register successful',
                    type: 'success',
                    confirmButtonText: 'OK'
                })
                this.$router.push('login') 
            })
            .catch((error)=>{
                console.log(error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong!',
                    type: 'error',
                    confirmButtonText: 'OK'
                })
            })
        }
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