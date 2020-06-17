/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import App from './App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import auth from '@websanova/vue-auth'
import authBearer from '@websanova/vue-auth/drivers/auth/bearer.js';
import authAxios from '@websanova/vue-auth/drivers/http/axios.1.x.js';
import authRouter from '@websanova/vue-auth/drivers/router/vue-router.2.x.js';
import {routes} from './routes';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

axios.defaults.baseURL = '/api/';

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

Vue.router = router
Vue.use(auth, {
   auth: authBearer,
   http: authAxios,
   router: authRouter,
});
App.router = Vue.router

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});
