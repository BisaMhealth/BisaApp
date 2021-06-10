import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import swal from 'sweetalert2'
window.swal = swal;
const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
};

Vue.use(VueSweetalert2, options);
export default new Vuex.Store({
    state: {
        isLoggedIn: !!localStorage.getItem('welcometomarketdaz'),

    },

    mutations: {

        loginUser(state) {
            state.isLoggedIn = true
        },
        logoutUser(state) {
            state.isLoggedIn = false
        },
        toastMessage(message) {
            var messageT = message
            const Toast = swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 4500,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener("mouseenter", swal.stopTimer);
                        toast.addEventListener("mouseleave", swal.resumeTimer);
                    },
                },
                function() {}
            );
            Toast.fire({
                icon: "success",
                title: messageT,
            }).then(function() {

                window.location.reload();
            });
        }

    },


    getters: {
        isLoggedIn: state => !!state.isLoggedIn
    }
})
