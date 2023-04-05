import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'

axios.defaults.baseURL = 'http://localhost:8000/api/';
// axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';

import './assets/main.css'

const app = createApp(App)

app.use(router) 

app.mount('#app')
