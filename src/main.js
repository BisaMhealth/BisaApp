import Vue from 'vue';
import App from './pages/App.vue';
import VueRouter from "vue-router";
import axios from "axios";
window.Vue = require("vue");
window.axios = axios;
Vue.use(VueRouter);
import store from "./store";

//sweet alert
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import swal from 'sweetalert2'
window.swal = swal;
const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
};

Vue.use(VueSweetalert2, options);
Vue.use(VueSweetalert2);

import Toasted from 'vue-toasted';
Vue.use(Toasted, {
    duration: 3000,
    position: 'top-right',
    action: {
        text: 'Okay',
        onClick: (e, toastObject) => {
            toastObject.goAway(0);
        }
    }
})

import VueFlatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
Vue.use(VueFlatPickr);


import Login from "./pages/Login.vue";
import Dashboard from "./pages/Dashboard";
import ForgotPass from "./pages/ForgotPass";
import Overview from "./pages/Overview";
import Users from "./pages/Users";
import Questions from "./pages/Questions";
import VueApexCharts from 'vue-apexcharts';
// import $ from 'jquery';
Vue.component('apexchart', VueApexCharts);


const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "",
            name: "login",
            component: Login
        },
        {
            path: "/forgot-password",
            name: "ForgotPass",
            component: ForgotPass
        },
        {
            path: "/dashboard",
            name: "dashboard",
            component: Dashboard,
            meta: { requiresAuth: true },
            children: [
                {
                    path: "",
                    name: "Overview",
                    component: Overview
                },
                {
                    path: "users",
                    name: "Users",
                    component: Users
                },
                {
                    path: "questions",
                    name: "Questions",
                    component: Questions
                },



            ]
        }]
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next();
            return;
        }
        next("");
    } else {
        next();
    }
});
new
    Vue({
        el: "#app",
        router,
        store,
        render: h => h(App),

    });