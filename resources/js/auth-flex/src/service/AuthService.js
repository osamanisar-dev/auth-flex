import axios from 'axios';
import {toast} from "vue3-toastify";

const api = axios.create({
    baseURL: process.env.VUE_APP_API_URL,
})

api.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
}, error => {
    return Promise.reject(error);
});

export default {
    showToast(message, status) {
        toast(message, {
            autoClose: 3000,
            "type": status,
        });
    },
    async register(data) {
        const response = await api.post('/register', data);
        localStorage.setItem('token', response.data.token);
        localStorage.setItem('user', JSON.stringify(response.data.user));
        return response.data;
    },

    async login(data) {
        const response = await api.post('/login', data);
        localStorage.setItem('token', response.data.token);
        localStorage.setItem('user', JSON.stringify(response.data.user));
        return response.data;
    },

    async logout() {
        const response = await api.post('/logout');
        localStorage.removeItem('token')
        localStorage.removeItem('user')
        delete axios.defaults.headers.common['Authorization']
        return response.data;
    },

    async signUpWithGoogle() {
        try {
            window.location.href = 'https://943b-2400-adcc-2105-cb00-bf27-e8a4-63a2-7c94.ngrok-free.app/auth/google';
        } catch (error) {
            console.error('Google OAuth error:', error);
        }
    }
}
