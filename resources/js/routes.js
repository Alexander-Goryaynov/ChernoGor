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
        path: "/create-order",
        component: CreateOrderComponent,
        name: "create-order",
    },
    {
        path: "/register",
        component: RegisterComponent,
        name: "register",
    },
    {
        path: "/login",
        component: LoginComponent,
        name: "login",
    },
    {
        path: "/second",
        component: ExampleSecondComponent,
        name: "home2",
    },
    {
        path: "/test",
        component: TestComponent,
        name: "test",
    },
    {
        path: "/categories/:id",
        component: ServiceItemComponent,
        name: "categories-item",
    },
    {
        path: "/subcategories/:id",
        component: ServiceSubItemComponent,
        name: "subcategories-item",
    },
    {
        path: "/notaries/:id",
        component: NotaryCardEditComponent,
        name: "notaries-item",
    },
    {
        path: "/notaries",
        component: NotaryListComponent,
        name: "notaries",
    },

];

const router = new VueRouter({
    routes, // сокращённая запись для `routes: routes`
    mode: 'history', //убираем дефолтный хэш, который был необходим для старых браузеров
    linkActiveClass: 'active',
    linkExactActiveClass: 'active'
});

export default router;

