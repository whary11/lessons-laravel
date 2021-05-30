/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
// Imports

// import click-outside

require('./bootstrap');
import { createApp } from "vue";
import App from "./App.vue";


import ArgonDashboard from "./plugins/argon-dashboard";
import "element-plus/lib/theme-chalk/index.css";


// Importar directivas

// import clickOutside from './utils/directives/click-ouside'
// import VueLazyload from 'vue-lazyload'

// /// Directivas
// // Vue.directive('click-outside',clickOutside, {})
// Vue.use(VueLazyload, {
//   error: '/assets/img/default/vuejs-logo.jpeg',
// })
/*!
=========================================================
* Vue Argon Design System - v1.1.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-design-system
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-design-system/blob/master/LICENSE.md)
* Coded by www.creative-tim.com
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
*/
// import Vue from "vue";
import router from "./utils/router";
import './utils/registerServiceWorker'
import "element-plus/lib/theme-chalk/index.css"




const appInstance = createApp(App);
appInstance.use(router);
appInstance.use(ArgonDashboard);
appInstance.mount("#app");
