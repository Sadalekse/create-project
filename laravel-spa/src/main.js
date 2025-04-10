import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import Toast, { POSITION } from 'vue-toastification'
import 'vue-toastification/dist/index.css'

import 'mdb-vue-ui-kit/css/mdb.min.css'
import 'mdb-vue-ui-kit/js/mdb.es.min.js'

import {
  MDBBtn,
  MDBNavbar,
  MDBNavbarBrand,
  MDBNavbarNav,
  MDBNavbarItem,
  MDBNavbarToggler,
  MDBCollapse
} from 'mdb-vue-ui-kit'

axios.defaults.withCredentials = true
axios.defaults.baseURL = 'http://localhost:8000'

const app = createApp(App)

app.component('mdb-btn', MDBBtn)
app.component('mdb-navbar', MDBNavbar)
app.component('mdb-navbar-brand', MDBNavbarBrand)
app.component('mdb-navbar-nav', MDBNavbarNav)
app.component('mdb-navbar-item', MDBNavbarItem)
app.component('mdb-navbar-toggler', MDBNavbarToggler)
app.component('mdb-collapse', MDBCollapse)

app.use(router)
app.use(Toast, {
  position: POSITION.TOP_RIGHT,
  timeout: 3000,
  closeOnClick: true,
  pauseOnHover: true
})

app.mount('#app')
