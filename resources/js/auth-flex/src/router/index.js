import { createWebHistory, createRouter } from 'vue-router'
import DashboardComponent from "@/components/DashboardComponent.vue";
import LoginComponent from "@/components/LoginComponent.vue";
import RegisterComponent from "@/components/RegisterComponent.vue";


const routes = [
    { path: '/', component: DashboardComponent, name: 'Dashboard', meta: { requiresAuth: true} },
    { path: '/login', component: LoginComponent, name: 'Login' },
    { path: '/register', component: RegisterComponent, name: 'Register' },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token')
    if (!token && to.meta.requiresAuth) {
        return next({name: 'Login'});
    }
    if (token && (to.name === 'Login' || to.name === 'Register')) {
        return next({name: 'Dashboard'});
    }
    next();
});
export default router
