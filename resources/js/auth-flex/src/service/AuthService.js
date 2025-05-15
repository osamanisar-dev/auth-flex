import axios from 'axios';

const API_URL = process.env.VUE_APP_API_URL;
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;

const api = axios.create({
    baseURL: API_URL,
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
    async register(data) {
        const response = await api.post('/register', data);
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
    }
}
