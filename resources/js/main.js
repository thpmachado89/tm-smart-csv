import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios';
import './index.css'
import Logo from '@/components/Logo.vue';
import Navbar from '@/components/Navbar.vue';
import NavbarLogged from '@/components/NavbarLogged.vue';


axios.defaults.baseURL = 'http://localhost/api/';
axios.defaults.headers['Authorization'] = `Bearer ${localStorage.getItem('token')}`;

const app = createApp(App)

app.use(router)


app.component('Logo', Logo);
app.component('Navbar', Navbar);
app.component('NavbarLogged', NavbarLogged);

app.mount('#app')