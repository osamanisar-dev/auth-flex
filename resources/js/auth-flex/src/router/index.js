import {createWebHistory, createRouter} from 'vue-router'
import DashboardComponent from "@/components/DashboardComponent.vue";
import LoginComponent from "@/components/LoginComponent.vue";
import RegisterComponent from "@/components/RegisterComponent.vue";
import axios from "axios";
import AuthService from "@/service/AuthService";


const routes = [
    {path: '/', component: DashboardComponent, name: 'Dashboard', meta: {requiresAuth: true}},
    {path: '/login', component: LoginComponent, name: 'Login'},
    {path: '/register', component: RegisterComponent, name: 'Register'},
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token')

    // Step 1: Handle OAuth callback (tokens in URL)
    if (to.path === '/' && to.query.token && to.query.user) {
        localStorage.setItem('token', to.query.token);
        localStorage.setItem('user', decodeURIComponent(to.query.user));
        axios.defaults.headers.common['Authorization'] = `Bearer ${to.query.token}`;
        window.history.replaceState({}, '', '/');
        const message = to.query.auth === 'register'
            ? 'Sign Up Successfully!'
            : 'Sign In Successfully!';
        AuthService.showToast(message, 'success');
        return next({ name: 'Dashboard' });
    }
    if (!token && to.meta.requiresAuth) {
        return next({name: 'Login'});
    }
    if (token && (to.name === 'Login' || to.name === 'Register')) {
        return next({name: 'Dashboard'});
    }
    next();
});
export default router
