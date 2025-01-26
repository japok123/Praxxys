import { createApp } from 'vue'
import App from './App.vue'
import router from './router'  
import 'bootstrap/dist/css/bootstrap.css'
import { registerPlugins } from '@/plugins'
import axios from './service/axios'
import Swal from 'sweetalert2'
import $ from 'jquery'; 
import 'bootstrap/dist/js/bootstrap.bundle.min.js'; 
import 'admin-lte/dist/css/adminlte.min.css'; 
import 'admin-lte/dist/js/adminlte.min.js';



const app = createApp(App)
app.config.globalProperties.$axios = axios
app.config.globalProperties.$swal = Swal
registerPlugins(app)
app.use(router)
app.mount('#app')
