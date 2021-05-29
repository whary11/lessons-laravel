import Vue from "vue";
import Router from "vue-router";
import AppHeader from "../layout/Header";
import AppFooter from "../layout/Footer";
// import Components from "./views/Components.vue";
// import Landing from "./views/Landing.vue";
import Login from "../views/Login";
// import Register from "./views/Register.vue";
// import Profile from "./views/Profile.vue";

Vue.use(Router);

export default new Router({
  linkExactActiveClass: "active",
  routes: [
    {
      path: "/login",
      name: "login",
      component: Login,
      components: {
        header: AppHeader,
        default: Login,
        footer: AppFooter
      }
    },
    
  ],
  scrollBehavior: to => {
    if (to.hash) {
      return { selector: to.hash };
    } else {
      return { x: 0, y: 0 };
    }
  }
});
