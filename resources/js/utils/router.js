import { createRouter, createWebHashHistory, createWebHistory } from "vue-router";
import AppHeader from "../layout/Header";
import AppFooter from "../layout/Footer";
import Dashboard from '../views/Dashboard'
import DashboardLayout from '../layout/DashboardLayout'
import Login from "../views/Login";



const routes =  [
  {
    path: "/",
    redirect: "/gateway/dashboard",
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
  }
]


const router = createRouter({
  history: createWebHistory(),
  // linkActiveClass: "active",
  routes,
});


export default router;