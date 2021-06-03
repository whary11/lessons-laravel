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

import router from "./utils/router";
import './utils/registerServiceWorker'
import "element-plus/lib/theme-chalk/index.css"




const appInstance = createApp(App);
appInstance.use(router);
appInstance.use(ArgonDashboard);
appInstance.mount("#app");
