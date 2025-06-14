import { createApp } from 'vue'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import App from './App.vue'
import router from './router'
// import Camera from 'simple-vue-camera'

const app = createApp(App)
// createApp(App).component('camera', Camera).mount('#app')
app.use(router)
app.use(ElementPlus)
app.config.globalProperties.api = import.meta.env.VITE_APP_API
app.mount('#app')
