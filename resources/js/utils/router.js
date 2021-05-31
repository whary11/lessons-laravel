import { createRouter, createWebHashHistory, createWebHistory } from "vue-router";
import AppHeader from "../layout/Header";
import AppFooter from "../layout/Footer";
import Dashboard from '../views/Dashboard'
import DashboardLayout from '../layout/DashboardLayout'
import AuthLayout from '../layout/Auth'
import Login from "../views/Login";
import Register from "../views/Register";



const routes =  [
  {
    path: "/gateway",
    redirect: { name: 'dashboard' },
    component: DashboardLayout,
    children: [
      {
        path: "/gateway/dashboard",
        name: "dashboard",
        components: {
          default: Dashboard
        },
      },
    ]
  },

  {
    path: "/gateway/auth",
    // redirect: { name: 'login' },
    component: AuthLayout,
    
    
    children: [
      {
        path: "/gateway/login",
        name: "login",
        // redirect:  to => {
        //   let token = localStorage.getItem('token')

        //   if (token) {
        //     return {name:'dashboard'}
        //   }

        //   return {name:'login'}
        // },
        components: {
          default: Login
        },
        
      },

      
      {
        path: "/gateway/register",
        name: "register",
        components: {
          default: Register
        },
      },
    ]
  }
]


const router = createRouter({
  history: createWebHistory(),
  linkActiveClass: "active",
  routes,
});


router.beforeEach((to, from, next) => {

  let token = localStorage.getItem('token')
  console.log(to.name);
  if ((to.name == 'login' || to.name == 'register') && (token && token != 'undefined')) {
    next({name:'dashboard'});
  }

  if ((to.name == 'dashboard') && (!token || token == 'undefined')) {
    next({name:'login'});
  }
  next()
 
})


export default router;