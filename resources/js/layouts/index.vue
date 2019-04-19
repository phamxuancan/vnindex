<template>
<div>
<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="https://bulma.io">
      <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
    </a>
    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>
  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item">
        Documentation
      </a>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          More
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item">
            About
          </a>
          <a class="navbar-item">
            Jobs
          </a>
          <a class="navbar-item">
            Contact
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item">
            Report an issue
          </a>
        </div>
      </div>
      <input class=" navbar-item input" type="search"/>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary">
            <strong>Sign up</strong>
          </a>
          <router-link :to="{name:'login'}" v-if="!$store.state.is_login" @click="login();"  class="button is-light">
            Đăng nhập
          </router-link>
          <a v-if="$store.state.is_login" @click="logout();" class="button is-light">
            Đăng xuất
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
<div class="box cta">
    <div class="columns is-mobile is-centered">
        <div class="field is-grouped is-grouped-multiline">
            <div class="control"><span class="tag is-link is-large">Link</span></div>
            <div class="control"><span class="tag is-success is-large">Success</span></div>
            <div class="control"><span class="tag is-black is-large">Black</span></div>
            <div class="control"><span class="tag is-warning is-large">Wafrning</span></div>
            <div class="control"><span class="tag is-danger is-large">Danger</span></div>
            <div class="control"><span class="tag is-info is-large">Info</span></div>
        </div>
    </div>
</div>
        <!-- View router !-->
        <router-view></router-view>
        <!-- end view router -->
<footer>
<div class="box cta">
    <div class="columns is-mobile is-centered">
        Development mode
    </div>
</div>
</footer>
</div>
</template>

<script>
    export default {
        name: 'index',
        mounted() {
            console.log('Compsonent mounted.')
        },
        data() {
            return {
                authenticated: false
            }
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
<style>
    .search-area{
        height: 100px;
    }
    .card{
        background-color: #209cee !important;
    }
</style>
