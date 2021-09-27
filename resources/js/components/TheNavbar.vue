<template>
    <div>
        <!-- Header -->
        <div class="sub-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <ul class="left-info">
                            <li><a href="#"><i class="fas fa-star"></i>Пн-Пт 09:00-17:00</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i>8(800)55-35-35</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <header>
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <router-link class="navbar-brand" :to="{name: 'home'}"><h2>ChernoGor</h2></router-link>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><a class="fas fa-bars"></a></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{name: 'home'}"> Главная</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{name: 'categories'}">Наши услуги</router-link>
                            </li>
                            <li v-if="isAuthorized && !isAdmin" class="nav-item">
                                <router-link class="nav-link" :to="{name: 'create-order'}">Создать заявку</router-link>
                            </li>
                            <li v-if="!isAuthorized" class="nav-item">
                                <router-link class="nav-link" :to="{name: 'register'}"> Регистрация</router-link>
                            </li>
                            <li v-if="!isAuthorized" class="nav-item">
                                <router-link class="nav-link" :to="{name: 'login'}"> Войти</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{name: 'notaries'}"> Нотариусы</router-link>
                            </li>
                            <li v-if="isAuthorized && !isAdmin" class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#"
                                             id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true"
                                             aria-expanded="false">
                                    Личный кабинет
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                                    <router-link class="dropdown-item" :to="{name: 'user-account'}">Аккаунт
                                    </router-link>
                                    <router-link class="dropdown-item" :to="{name: 'user-account-orders'}">Заказы
                                    </router-link>
                                </div>
                            </li>
                            <li v-if="isAuthorized && isAdmin" class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com"
                                   id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    Управление
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                    <router-link class="dropdown-item" :to="{name: 'admin-accounts'}">Аккаунты
                                    </router-link>
                                    <router-link class="dropdown-item" :to="{name: 'admin-orders'}">Заказы
                                    </router-link>
                                </div>
                            </li>
                            <li v-if="isAuthorized" class="nav-item">
                                <a class="nav-link" href="#" @click.prevent="logout()">Выйти</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    </div>
</template>

<script>
import Swal from "sweetalert2";
import {eventBus} from "../app";

export default {
    data() {
        return {
            isAdmin: false,
            isAuthorized: false,
            updateNav: null
        }
    },
    watch: {
        updateNav: function(newVal, oldVal) { // watch it
            if (this.$cookies.get("name") && this.$cookies.get("email") && this.$cookies.get("role")) {
                this.isAuthorized = true;
                if (this.$cookies.get("role") === 'admin') {
                    this.isAdmin = true;
                }
            }
            console.log('Переменная в навбаре - ' + this.updateNav);
        }
    },
    created() {
        if (this.$cookies.get("name") && this.$cookies.get("email") && this.$cookies.get("role")) {
           this.isAuthorized = true;
           if (this.$cookies.get("role") === 'admin') {
               this.isAdmin = true;
           }
        }
        eventBus.$on('updateNav', data => {
            this.updateNav = data.updateNav;
            this.isAuthorized = true;
            if (this.updateNav === 1) {
                this.isAdmin = false;
            }
            else if (this.updateNav === 2) {
                this.isAdmin = true;
            }
        })
    },
    methods: {
        logout() {
            try {
               if (this.$cookies.get("name") && this.$cookies.get("email")) {
                    this.$cookies.remove("name");
                    this.$cookies.remove("role");
                    this.$cookies.remove("email");
                    this.$cookies.remove("laravel_session");

                    this.isAuthorized = false;
                    this.isAdmin = false;
                    axios.post('/logout').then(response => {
                        console.log(response);
                        this.$router.push('/login');
                    });
               }
            } catch {
                Swal.fire({
                    title: 'Ошибка',
                    text: 'Попробуйте выйти чуть позже',
                    icon: 'error',
                    confirmButtonText: 'Ок'
                });
            }
        }
    }
}
</script>

<style scoped>
.dropdown:hover > .dropdown-menu {
    display: block;
}

.dropdown-item.active, .dropdown-item:active {
    background-color: white !important;
    color: black !important;
}

.nav-link {
    text-transform: none !important;
}
</style>
