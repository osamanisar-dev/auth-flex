<template>
    <div class="card-container">
        <form class="form" @submit.prevent="login">
            <div class="flex-column">
                <label>Email </label></div>
            <div class="inputForm">
                <i class="fa-solid fa-at"></i>
                <input v-model="email" placeholder="Enter your Email" class="input" type="email">
            </div>
            <div class="flex-column">
                <label>Password </label></div>
            <div class="inputForm">
                <i class="fa-solid fa-lock"></i>
                <input v-model="password" placeholder="Enter your Password" class="input" type="password">
            </div>
            <div class="button">
                <button class="btn btn-dark" type="submit">Sign In</button>
            </div>
            <p class="p">Don't have an account? <span class="span">
              <router-link to="/register">Sign Up</router-link>
              </span>

            </p>
            <p class="p line">Or With</p>

            <div class="flex-row">
                <button type="button" class="btn google" @click="signInWithGoogle">
                    <svg xml:space="preserve" style="enable-background:new 0 0 512 512;" viewBox="0 0 512 512" y="0px"
                         x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"
                         id="Layer_1" width="20" version="1.1">
<path d="M113.47,309.408L95.648,375.94l-65.139,1.378C11.042,341.211,0,299.9,0,256
	c0-42.451,10.324-82.483,28.624-117.732h0.014l57.992,10.632l25.404,57.644c-5.317,15.501-8.215,32.141-8.215,49.456
	C103.821,274.792,107.225,292.797,113.47,309.408z" style="fill:#FBBB00;"></path>
                        <path d="M507.527,208.176C510.467,223.662,512,239.655,512,256c0,18.328-1.927,36.206-5.598,53.451
	c-12.462,58.683-45.025,109.925-90.134,146.187l-0.014-0.014l-73.044-3.727l-10.338-64.535
	c29.932-17.554,53.324-45.025,65.646-77.911h-136.89V208.176h138.887L507.527,208.176L507.527,208.176z"
                              style="fill:#518EF8;"></path>
                        <path d="M416.253,455.624l0.014,0.014C372.396,490.901,316.666,512,256,512
	c-97.491,0-182.252-54.491-225.491-134.681l82.961-67.91c21.619,57.698,77.278,98.771,142.53,98.771
	c28.047,0,54.323-7.582,76.87-20.818L416.253,455.624z" style="fill:#28B446;"></path>
                        <path d="M419.404,58.936l-82.933,67.896c-23.335-14.586-50.919-23.012-80.471-23.012
	c-66.729,0-123.429,42.957-143.965,102.724l-83.397-68.276h-0.014C71.23,56.123,157.06,0,256,0
	C318.115,0,375.068,22.126,419.404,58.936z" style="fill:#F14336;"></path>

</svg>
                    Continue with Google
                </button>
            </div>

            <div class="flex-row">
                <button type="button" class="btn google" @click="signInWithSlack" style="background-color: #4A154B; color: #FFFFFF;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 2447.6 2452.5" fill="none">
                        <g clip-rule="evenodd" fill-rule="evenodd"><path d="m897.4 0c-135.3.1-244.8 109.9-244.7 245.2-.1 135.3 109.5 245.1 244.8 245.2h244.8v-245.1c.1-135.3-109.5-245.1-244.9-245.3.1 0 .1 0 0 0m0 654h-652.6c-135.3.1-244.9 109.9-244.8 245.2-.2 135.3 109.4 245.1 244.7 245.3h652.7c135.3-.1 244.9-109.9 244.8-245.2.1-135.4-109.5-245.2-244.8-245.3z" fill="#36c5f0"/><path d="m2447.6 899.2c.1-135.3-109.5-245.1-244.8-245.2-135.3.1-244.9 109.9-244.8 245.2v245.3h244.8c135.3-.1 244.9-109.9 244.8-245.3zm-652.7 0v-654c.1-135.2-109.4-245-244.7-245.2-135.3.1-244.9 109.9-244.8 245.2v654c-.2 135.3 109.4 245.1 244.7 245.3 135.3-.1 244.9-109.9 244.8-245.3z" fill="#2eb67d"/><path d="m1550.1 2452.5c135.3-.1 244.9-109.9 244.8-245.2.1-135.3-109.5-245.1-244.8-245.2h-244.8v245.2c-.1 135.2 109.5 245 244.8 245.2zm0-654.1h652.7c135.3-.1 244.9-109.9 244.8-245.2.2-135.3-109.4-245.1-244.7-245.3h-652.7c-135.3.1-244.9 109.9-244.8 245.2-.1 135.4 109.4 245.2 244.7 245.3z" fill="#ecb22e"/><path d="m0 1553.2c-.1 135.3 109.5 245.1 244.8 245.2 135.3-.1 244.9-109.9 244.8-245.2v-245.2h-244.8c-135.3.1-244.9 109.9-244.8 245.2zm652.7 0v654c-.2 135.3 109.4 245.1 244.7 245.3 135.3-.1 244.9-109.9 244.8-245.2v-653.9c.2-135.3-109.4-245.1-244.7-245.3-135.4 0-244.9 109.8-244.8 245.1 0 0 0 .1 0 0" fill="#e01e5a"/></g>
                    </svg>
                    Continue with Slack
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import AuthService from "@/service/AuthService";
import {toast} from "vue3-toastify";

export default {
    name: 'LoginComponent',
    data() {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        showToast(message, status) {
            toast(message, {
                autoClose: 3000,
                'type': status
            })
        },
        async login() {
            const user = {
                email: this.email,
                password: this.password
            }
            try {
                const response = await AuthService.login(user);
                this.$router.replace({name: 'Dashboard'}).then(() => {
                    this.showToast(response.message, 'success');
                });
            } catch (e) {
                const errorMsg = e.response.data.message;
                this.showToast(errorMsg, 'error')
            }
        },
        async signInWithGoogle() {
            await AuthService.signUpWithGoogle();
        },
        async signInWithSlack() {
            await AuthService.signUpWithSlack();
        }
    }
}
</script>

<style scoped>
.card-container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f5f7fa;
    padding: 20px;
}

.form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    background-color: #ffffff;
    padding: 30px;
    width: 450px;
    border-radius: 20px;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

::placeholder {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.form button {
    align-self: flex-end;
}

.flex-column > label {
    color: #151717;
    font-weight: 600;
}

.inputForm {
    border: 1.5px solid #ecedec;
    border-radius: 10px;
    height: 50px;
    display: flex;
    align-items: center;
    padding-left: 10px;
    transition: 0.2s ease-in-out;
}

.input {
    margin-left: 10px;
    border-radius: 10px;
    border: none;
    width: 100%;
    height: 100%;
}

.input:focus {
    outline: none;
}

.inputForm:focus-within {
    border: 1.5px solid #2d79f3;
}

.flex-row {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.google {
    border: 1px solid gray;
}
.google:hover {
    background-color: #d3d3d3;
}
.google svg {
    margin: 0;
}

.flex-row > div > label {
    font-size: 14px;
    color: black;
    font-weight: 400;
}

.span {
    font-size: 14px;
    margin-left: 5px;
    color: #2d79f3;
    font-weight: 500;
    cursor: pointer;
}

.p {
    text-align: center;
    color: black;
    font-size: 14px;
    margin: 5px 0;
}

.btn {
    width: 90%;
    border-radius: 10px;
    margin-top: 18px;
    height: 42px;
}

.button {
    display: flex;
    justify-content: center;
}
</style>
