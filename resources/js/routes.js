import ExampleComponent from "./components/ExampleComponent";
import ExampleSecondComponent from "./components/ExampleSecondComponent";

import VueRouter from "vue-router";
import TestComponent from "./components/TestComponent";
import MainComponent from "./components/MainComponentItems/MainComponent";
import ServiceComponent from "./components/ServicesComponent/ServiceComponent";
import CreateOrderComponent from "./components/CreateOrderComponent/CreateOrderComponent";
import RegisterComponent from "./components/AuthComponents/RegisterComponent";
import LoginComponent from "./components/AuthComponents/LoginComponent";
import ServiceItemComponent from "./components/ServicesComponent/ServiceItemComponent";
import ServiceSubItemComponent from "./components/ServicesComponent/ServiceSubItemComponent";
import NotaryCardEditComponent from "./components/NotaryComponents/NotaryCardEditComponent";
import NotaryListComponent from "./components/NotaryComponents/NotaryListComponent";
import AdminOrdersComponent from "./components/AccountComponents/Admin/AdminOrdersComponent";
import AdminUsersComponent from "./components/AccountComponents/Admin/AdminUsersComponent";
import UserDataComponent from "./components/AccountComponents/User/UserDataComponent";
import UserOrdersComponent from "./components/AccountComponents/User/UserOrdersComponent";
import ServiceCreateCatComponent from "./components/ServicesComponent/ServiceCreateCatComponent";
import ServiceCreateSubCatComponent from "./components/ServicesComponent/ServiceCreateSubCatComponent";
import NotaryCardCreateComponent from "./components/NotaryComponents/NotaryCardCreateComponent";
const routes = [
    {
        path: "/",
        component: MainComponent,
        name: "home",
    },
    {
        path: "/categories",
        component: ServiceComponent,
        name: "categories",
    },
    {
        path: "/categories/create",
        component: ServiceCreateCatComponent,
        name: "categories-create", //admin
    },
    {
        path: "/subcategories/create",
        component: ServiceCreateSubCatComponent,
        name: "subcategories-create", //admin
        props: true
    },
    {
        path: "/create-order",
        component: CreateOrderComponent,
        name: "create-order", //user
    },
    {
        path: "/register",
        component: RegisterComponent,
        name: "register", //guest
    },
    {
        path: "/login",
        component: LoginComponent,
        name: "login", //guest
    },
    {
        path: "/categories/:id",
        component: ServiceItemComponent,
        name: "categories-item", //admin
    },
    {
        path: "/subcategories/:id",
        component: ServiceSubItemComponent,
        name: "subcategories-item", //admin
        props: true
    },
    {
        path: "/notaries/create",
        component: NotaryCardCreateComponent,
        name: "notaries-create", //admin
    },
    {
        path: "/notaries/:id",
        component: NotaryCardEditComponent,
        name: "notaries-item", //admin
    },
    {
        path: "/notaries",
        component: NotaryListComponent,
        name: "notaries",
    },
    {
        path: "/admin/orders",
        component: AdminOrdersComponent,
        name: "admin-orders", //admin
    },
    {
        path: "/admin/accounts",
        component: AdminUsersComponent,
        name: "admin-accounts", //admin
    },
    {
        path: "/account",
        component: UserDataComponent,
        name: "user-account", //user
    },
    {
        path: "/account/orders",
        component: UserOrdersComponent,
        name: "user-account-orders", //user
    },

];

const router = new VueRouter({
    routes, // сокращённая запись для `routes: routes`
    mode: 'history', //убираем дефолтный хэш, который был необходим для старых браузеров
    linkActiveClass: 'active',
    linkExactActiveClass: 'active'
});

export default router;

