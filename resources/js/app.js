import './bootstrap';
import { createApp } from 'vue';
import HomeComponent from './components/Home.vue';
import router from "./router";
import IndexComponent from "./components/Index.vue";
const app = createApp({});
app.component('index-component', IndexComponent);

app.use(router);
app.mount('#app');
