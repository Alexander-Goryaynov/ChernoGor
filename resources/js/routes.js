import ExampleComponent from "./components/ExampleComponent";
import ExampleSecondComponent from "./components/ExampleSecondComponent";

import VueRouter from "vue-router";
import TestComponent from "./components/TestComponent";
const routes = [
    {
        path: "/",
        component: ExampleComponent,
        name: "home",
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

];

const router = new VueRouter({
    routes, // сокращённая запись для `routes: routes`
    mode: 'history' //убираем дефолтный хэш, который был необходим для старых браузеров
});

export default router;

