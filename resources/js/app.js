
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */
// require('./bootstrap');
import './bootstrap';
import Vue from 'vue';

import Buefy from 'buefy';
import router from '@/js/routers.js';
import App from '@/js/views/App';
import { store } from './stores'
import login from "./layouts/login.vue";
import index from "./layouts/index.vue";
import Meta from 'vue-meta'
import axios from 'axios';
import VueAxios from 'vue-axios';
import 'buefy/dist/buefy.css';
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)
 

let token = document.head.querySelector('meta[name="csrf-token"]');
axios.defaults.headers.common['X-CSRF-TOKEN'] = token.getAttribute('value');
Vue.use(VueAxios,axios)
Vue.use(Buefy);
Vue.use(Meta)
Vue.component('login',login)
Vue.component('index',index)
 new Vue(
    {
        router,
        render:h=> h(App),
        store
    }
).$mount('#app');