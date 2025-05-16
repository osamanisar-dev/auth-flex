<template>
    <div class="container dashboard-wrapper position-relative">
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="card user-card p-4" style="width: 400px;">
                <div class="card-body">
                    <!-- Centered Header Section -->
                    <div class="text-center mb-4">
                        <div class="user-icon mb-3">
                            <i class="fas fa-user-circle fa-4x text-primary"></i>
                        </div>
                        <h4 class="card-title text-primary position-relative d-inline-block">
                            User Information
                            <span class="title-underline"></span>
                        </h4>
                    </div>

                    <!-- Left-aligned Content -->
                    <div class="user-details text-start">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary me-3 p-2">
                                <i class="fas fa-id-badge"></i>
                            </span>
                            <div class="card-points">
                                <p class="mb-0 fw-bold">{{ user.id }}</p>
                                <small class="text-muted">User ID</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary me-3 p-2">
                                <i class="fas fa-user"></i>
                            </span>
                            <div class="card-points">
                                <p class="mb-0 fw-bold">{{ user.name }}</p>
                                <small class="text-muted">Full Name</small>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <span class="badge bg-primary me-3 p-2">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <div class="card-points">
                                <p class="mb-0 fw-bold">{{ user.email }}</p>
                                <small class="text-muted">Email Address</small>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100 py-2" @click="signOut">
                            <i class="fas fa-sign-out-alt me-2"></i>Sign Out
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AuthService from "@/service/AuthService";
import {toast} from "vue3-toastify";

export default {
    name: 'DashboardComponent',
    data() {
        const user = JSON.parse(localStorage.getItem('user'));
        return {
            user: {
                id: user.id,
                name: user.name,
                email: user.email
            }
        }
    },
    methods: {
        showToast(message, status) {
            toast(message, {autoClose: 3000, "type": status,});
        },
        async signOut() {
            const response = await AuthService.logout();
            this.$router.replace({name: 'Login'}).then(() => {
                this.showToast(response.message, 'success');
            });
        }
    }
}
</script>

<style scoped>
.user-card {
    border-radius: 15px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset,
    0 0 15px rgba(13, 110, 253, 0.2);
    transition: all 0.3s ease;
    border: none;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.95);
}

.user-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset,
    0 0 20px rgba(13, 110, 253, 0.3);
}

.user-icon {
    transition: all 0.3s ease;
}

.user-icon:hover {
    transform: scale(1.1);
}

.card-points {
    margin-left: 10px;
}

.badge {
    border-radius: 10px;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-primary {
    border-radius: 10px;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(13, 110, 253, 0.2);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 7px 14px rgba(13, 110, 253, 0.3);
}

/* Centered title with underline */
.card-title {
    position: relative;
    padding-bottom: 15px;
}

.title-underline {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 3px;
    background: #0d6efd;
    border-radius: 3px;
}
</style>
