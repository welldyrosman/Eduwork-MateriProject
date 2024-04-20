import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import { useUserStore } from './stores/user'
// import "bootstrap/dist/css/bootstrap.min.css"
// import "bootstrap-icons/font/bootstrap-icons.min.css"
// import "bootstrap"

const app = createApp(App)

app.use(createPinia())
const userAuth=useUserStore();
userAuth.setAuth();
app.use(router)

app.mount('#app')
