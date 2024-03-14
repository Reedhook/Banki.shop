
import './bootstrap';
import { createApp } from 'vue';
import HomeComponent from './components/Home.vue';

const app = createApp({});
app.component('home-component', HomeComponent);

app.mount('#app');
