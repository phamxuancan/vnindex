<template>
<div>
   <nav class="navbar has-shadow">
        <div class="container">
            <!-- <div class="navbar-brand"><a class="navbar-item" href="../"><img src="http://bulma.io/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox"/></a>
            <div class="navbar-burger burger" data-target="navMenu"><span></span><span></span><span></span></div>
        </div> -->
        <div class="navbar-menu" id="navMenu" v-if="authenticated">
            <div class="" >
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">Account</a>
                    <div class="navbar-dropdown">
                        <a class="navbar-item">Dashboard</a>
                        <a class="navbar-item">Profile</a>
                        <a class="navbar-item">Settings</a>
                    </div>
                </div>
            </div>
        </div>
         <div class="navbar-menu-login" v-if="!authenticated">
            <div class="btn-login" >
                <router-link :to="{name:'login'}" class="button is-info">Đăng nhập</router-link>
            </div>
         </div>
    </div>
</nav>
<section class="hero is-info">
<div class="hero-body">
    <div class="container">
        <div class="card">
            <div class="card-content">
                <div class="content">
                    <div class="control has-icons-left has-icons-right">
                        <input class="input is-large" type="search"/>
                        <span class="icon is-medium is-left">
                            <i class="fa fa-search"></i>
                        </span>
                        <span class="icon is-medium is-right">
                            <i class="fa fa-empire"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<div class="box cta">
    <div class="columns is-mobile is-centered">
        <div class="field is-grouped is-grouped-multiline">
            <div class="control"><span class="tag is-link is-large">Link</span></div>
            <div class="control"><span class="tag is-success is-large">Success</span></div>
            <div class="control"><span class="tag is-black is-large">Black</span></div>
            <div class="control"><span class="tag is-warning is-large">Warning</span></div>
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
    }
</script>