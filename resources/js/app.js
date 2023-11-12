import './bootstrap';
import { createApp } from "vue";
import App from "./App.vue";
import router from "./router/index"

//import User Class
import User from './Helpers/User';
window.User = User;

//sweet alert
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
})
window.Toast = Toast

createApp(App)
    .use(router)
    .mount("#app");