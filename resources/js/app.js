/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

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
import Vue from "vue";
import App from "./App.vue";
import router from "./utils/router";
// import Argon from "./plugins/argon-kit";
import './utils/registerServiceWorker'

Vue.config.productionTip = false;
// Vue.use(Argon);
new Vue({
  router,
  render: h => h(App)
}).$mount("#app");