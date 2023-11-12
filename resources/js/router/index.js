import {createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import DashboardView from "../views/DashboardView.vue"
import LoginView from '../views/auth/LoginView.vue'
import RegisterView from '../views/auth/RegisterView.vue'
import ForgetView from '../views/auth/ForgetView.vue'
import Logout from '../components/Logout.vue'
import User from "../Helpers/User";

//employeew
import EmployeeView from '../views/employee/EmployeeView.vue'
import EmployeeCreateView from '../views/employee/EmployeeCreateView.vue'
import EmployeeEditView from '../views/employee/EmployeeEditView.vue'

//supplier
import SupplierView from '../views/supplier/SupplierView.vue'
import SupplierCreateView from '../views/supplier/SupplierCreateView.vue'

const routes = [
    {
        path: "/",
        name: "home",
        component: HomeView,
        meta: {
            title: 'Home',
        },
    },
    {
        path: "/admin/dashboard",
        name: "dashboard",
        component: DashboardView,
        meta: {
            title: 'Dashboard',
            auth: true,
        },
    },

    //employee
    {
        path: "/admin/employee",
        name: "employee",
        component: EmployeeView,
        meta: {
            title: 'Employee',
            auth: true,
        },
    },
    {
        path: "/admin/employee/add",
        name: "employee-add",
        component: EmployeeCreateView,
        meta: {
            title: 'Employee Add',
            auth: true,
        },
    },
    {
        path: "/admin/employee/edit/:id",
        name: "employee-edit",
        component: EmployeeEditView,
        meta: {
            title: 'Employee Edit',
            auth: true,
        },
    },

    //Supplier
    {
        path: "/admin/supplier",
        name: "supplier",
        component: SupplierView,
        meta: {
            title: 'Supplier',
            auth: true,
        },
    },
    {
        path: "/admin/supplier/add",
        name: "supplier-add",
        component: SupplierCreateView,
        meta: {
            title: 'Supplier Add',
            auth: true,
        },
    },
    {
        path: "/admin/supplier/edit/:id",
        name: "supplier-edit",
        component: SupplierCreateView,
        meta: {
            title: 'Supplier Edit',
            auth: true,
        },
    },


    //Auth
    {
        path: "/login",
        name: "login",
        component: LoginView,
        meta:{
            title: 'Login',
        },
    },
    {
        path: "/register",
        name: "register",
        component: RegisterView,
        meta:{
            title: 'Register',
        },
    },
    {
        path: "/forget-password",
        name: "forget",
        component: ForgetView,
        meta:{
            title: 'Forget Password',
        },
    },
    {
        path: "/logout",
        name: "logout",
        component: Logout,
        meta:{
            title: 'Logout',
        },
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.auth)) {
        if (!User.loggedIn()) {
            next({
                name: 'login',
            });
        } else {
            next();
        }
    }
    document.title = to.meta && to.meta.title ? `Inventory - ${to.meta.title}` : 'Inventory';
    next();
});

export default router;