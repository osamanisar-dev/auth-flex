# 🎯 AuthFlex

AuthFlex is a modern authentication system built using Laravel APIs for the backend and Vue.js for the frontend. This project implements user registration with email verification, login, logout, a user dashboard displaying user details, toast notifications for user feedback, and social authentication via Google Sign-In configured through Google Cloud.

---

## ✨ Features

- ✅ **User Registration with Email Verification**  
  Users register using email and password. A verification email with a verification link is sent. Users must verify their email before accessing the dashboard.

- 🔐 **Login & Logout**  
  Secure login and logout endpoints with session/token management.

- 🧑‍💼 **User Dashboard**  
  After login, users see a dashboard displaying their profile details fetched from the API.

- 🌐 **Google OAuth Sign-In & Sign-Up**  
  Users can sign up or sign in using their Google account. Google OAuth is properly configured via Google Cloud Console.

- 🔔 **Toast Notifications**  
  All major actions (registration, login, logout, verification, errors) display friendly toast notifications for instant user feedback.

- ⚙️ **API-driven Laravel Backend + Vue.js Frontend**  
  Laravel serves as an API backend with Sanctum/Passport or token-based authentication. Vue.js SPA consumes the API.

---

## 🧱 Tech Stack

| 🖥️ Backend                  | 💻 Frontend           |
|-----------------------------|-----------------------|
| Laravel (API)               | Vue.js                |
| PHP                         | Vue Router            |
| MySQL (or compatible)       | Axios                 |
| Laravel Sanctum / Passport  | Vue Toastification    |
| Laravel Mail (SMTP)         | Bootstrap             |
| Google OAuth via Socialite  | Font Awesome          |

---

## 🚀 Getting Started

### 🛠️ Prerequisites

- ⚙️ PHP >= 8.x
- 📦 Composer
- 🗃️ MySQL or compatible database
- 🧱 Laravel 10+ (API backend)
- 🖼️ Vue.js 3+ (frontend SPA)
- 🔗 Ngrok (for local tunneling and OAuth callbacks)
- ☁️ Google Cloud Console account (for Google OAuth credentials)

---

## ⚙️ Environment Setup

### 1️⃣ Laravel Backend Setup

1. Clone the repo and install dependencies:

```bash
git clone https://github.com/osamanisar-dev/auth-flex
cd auth-flex
composer install
cp .env.example .env
php artisan key:generate
```
### 2️⃣ Vue Frontend Setup
```bash
cd resources/js/auth-flex
npm install
npm run dev
```

# 🔧 Final Configuration Notes

Make sure to complete the following setup steps before running the project:

## 📁 In the Laravel project’s root `.env` file:

- Set `APP_URL` to your 🔗 ngrok URL.
- Set `FRONTEND_URL` to the 🌐 URL where your frontend (Vue) is being served.
- Add your Google OAuth credentials:
  - `GOOGLE_CLIENT_ID`
  - `GOOGLE_CLIENT_SECRET`
  - `GOOGLE_REDIRECT_URI` → should point to your backend’s Google callback endpoint.

## 📁 In the Vue project's root `.env` file:

- Set `VUE_APP_API_URL` to your Laravel 🔗 ngrok URL.
- Add `VUE_APP_GOOGLE_WEB_URL` for Google Sign-In integration.

✅ Double-check these settings to ensure seamless integration between your backend and frontend with Google OAuth and email verification features.

---

🔐 Built with ❤️ by Osama Nisar – Laravel & Vue.js authentication made simple!
