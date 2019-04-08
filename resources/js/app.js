
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
import './bootstrap';
import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import Buefy from 'buefy';
import router from '@/js/routers.js';
import App from '@/js/views/App';
import { store } from './stores'
import login from "./layouts/login.vue";
import index from "./layouts/index.vue";
import Meta from 'vue-meta'

 
Vue.use(VueAxios, axios)
 
Vue.use(Meta)
Vue.use(Buefy)
Vue.component('login',login)
Vue.component('index',index)
 new Vue(
    {
        router,
        render:h=> h(App),
        store
    }
).$mount('#app');