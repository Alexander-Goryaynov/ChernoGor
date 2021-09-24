require('./bootstrap');


import router from "./routes";
import VueCookies from 'vue-cookies';
import VueRouter from "vue-router";
import Index from "./Index";

window.Vue = require('vue').default;
axios.defaults.withCredentials = true;
Vue.use(VueCookies);


// Глобальная регистрация компонентов
/*Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('example-second-component', require('./components/ExampleSecondComponent.vue').default);*/


Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router: router,
    components: {
        "index": Index //глобальная регистрация главного компонента
    }
});

