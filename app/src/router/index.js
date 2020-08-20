import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Register from '../views/Register.vue'
import Visit from '../views/Visit.vue'
import Report from '../views/Report.vue'
import Login from '../views/Login.vue'
import Dashboard from "../views/Dashboard.vue"
import Visits from '../components/Visits.vue'
import Visitors from '../components/Visitors.vue'
import Reports from '../components/Reports.vue'
import MailLogs from '../components/MailLogs.vue'
import Locations from '../components/Locations.vue'
import RSLs from '../components/RSLs.vue'

function isLoggedIn () {
  return localStorage.getItem("token")
}

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
    meta: { authOnly: true }
  },{
    path: '/visit',
    name: 'Visit',
    component: Visit,
    meta: { authOnly: true }
  },{
    path: '/report',
    name: 'Report',
    component: Report,
    meta: { authOnly: true }
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: { guestOnly: true }
  },
  {
    path: "/dashboard",
    component: Dashboard,
    meta: { authOnly: true },
    children: [
    {
        name: "Dashboard",
        path: '',
        component: Visits
    },
    {
        name:"Visitors",
        path: 'visitors',
        component: Visitors
    },
    {
        name:"Reports",
        path: 'reports',
        component: Reports
    },
    {
        name:"MailLogs",
        path: 'maillogs',
        component: MailLogs
    },
    {
        name:"Locations",
        path: 'locations',
        component: Locations
    },
    {
        name:"RSLs",
        path: 'rsls',
        component: RSLs
    }
  ]}
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
