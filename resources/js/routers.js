import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '@/js/views/Home';
import Login from '@/js/views/Login';
import Register from '@/js/views/register';
// import About from '@/js/views/About';
import Meta from 'vue-meta'
Vue.use(VueRouter);
Vue.use(Meta)

const router = new VueRouter({
    mode:'history',
    routes: [
        {
          path:'/home',
          name:'home',
          component:Home,
          meta: {
            layout: 'index'
          }
        },
        {
          path:'/login',
          name:'login',
          component:Login,
          meta: {
            layout: 'login'
          }
        },
        {
          path:'/register',
          name:'register',
          component:Register,
          meta: {
            layout: 'login'
          }
        },
      ]   
});
export default router;