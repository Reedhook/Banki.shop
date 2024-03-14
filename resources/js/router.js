import {createRouter, createWebHistory} from "vue-router";

const routes = [
    {
        path: '/home',
        name: 'home',
        component: () => import('./components/Home.vue')
    },
    {
        path: '/result',
        name: 'result',
        component: () => import('./components/Result.vue')
    }
];
const router = createRouter({
    history: createWebHistory(),
    routes
});
export default router;
