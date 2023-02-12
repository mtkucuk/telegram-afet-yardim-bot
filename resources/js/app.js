/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import App from './layout/App.vue'


import {createApp} from "vue";
import router from './router';
import Api from './api';




const app = createApp(App);


app.use(router);

app.provide('$globalApi', Api);

app.mount('#app')
