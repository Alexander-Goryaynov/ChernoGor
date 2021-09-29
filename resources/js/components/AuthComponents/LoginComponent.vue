<template>
    <div>
        <!-- Page Content -->
        <div class="page-mini-heading header-text">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>

        <div class="callback-form make-space">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h2>Авторизация</h2>
                            <span>Заполните данные формы</span>
                        </div>
                    </div>
                    <div class="col-md-8 offset-md-2">
                        <div class="contact-form">
                            <form id="contact" action="" method="post">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <input name="email" type="text" v-model="email" class="form-control"
                                                   id="email" pattern="[^ @]*@[^ @]*" placeholder="E-Mail адрес">
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                        <fieldset>
                                            <input name="password" :type="type" v-model="password" class="form-control"
                                                   id="password" placeholder="Пароль">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 mb-3">
                                        <fieldset>
                                            <button type="button" id="hide-show" @click="showPassword()"
                                                    class="action-button">
                                                <div v-if="type === 'text'">
                                                    <i class="far fa-eye-slash"></i>
                                                </div>
                                                <div v-if="type === 'password'">
                                                    <i class="fas fa-eye-slash"></i>
                                                </div>
                                            </button>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <button type="submit" id="form-submit"
                                                    @click.prevent="checkData()" class="border-button">Войти
                                            </button>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import Swal from "sweetalert2";
import {eventBus} from "../../app";

export default {
    data() {
        return {
            type: 'password',
            email: '',
            password: '',
            error_message: '',
            updateNav: 0
        }
    },
    methods: {
        showPassword() {
            if (this.type === 'password') {
                this.type = 'text'
            } else {
                this.type = 'password'
            }
        },
        checkData() {
            if (!this.email || !this.password) {
                Swal.fire({
                    title: 'Ошибка',
                    text: 'Заполните все поля',
                    icon: 'error',
                    confirmButtonText: 'Ок'
                });
            } else {
                this.email = this.email.trim();
                this.password = this.password.trim();
                if (this.error_message) {
                    Swal.fire({
                        title: 'Ошибка',
                        text: this.error_message,
                        icon: 'error',
                        confirmButtonText: 'Ок'
                    })
                    this.error_message = '';
                } else {
                    axios.post('/login', {
                        "email": this.email,
                        "password": this.password,
                    }).then(response => {
                        axios.get('/api/v1/user').then(response => {
                            if (response.status === 200) {
                                this.$cookies.set("email", response.data.email, 21600);
                                this.$cookies.set("name", response.data.name, 21600);
                                this.$cookies.set("role", response.data.role, 21600);
                                console.log(this.$cookies.get("name"));
                                console.log(this.$cookies.get("role"));
                                console.log(this.$cookies.get("email"));
                                if (this.$cookies.get("role") === 'admin') {
                                    this.updateNav = 2
                                } else this.updateNav = 1
                                console.log('Переменная в Логине - ' + this.updateNav);
                                eventBus.$emit('updateNav', this.updateNav);
                                if (this.$cookies.get("role") === 'user') {
                                    this.$router.push('/');
                                }
                                else if (this.$cookies.get("role") === 'admin') {
                                    this.$router.push({ name: 'admin-orders' });
                                }
                            }
                        }).catch(function (error) {
                            if (error.response) {
                                console.log('Проблема с получением информации пользователя')
                            }
                        });
                    }).catch(function (error) {
                        if (error.response) {
                            Swal.fire({
                                title: 'Ошибка',
                                text: 'Ошибка авторизации',
                                icon: 'error',
                                confirmButtonText: 'Ок'
                            });
                        }
                    });
                }
            }
        }
    },
    mounted() {
        window.scrollTo(0, 0)
    }
}
</script>

<style scoped>
.text-style {
    text-transform: none !important;
}

.action-button {
    background-color: transparent;
    color: #fff;
    border: 2px solid #fff;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: 700;
    padding: 5px 10px;
    border-radius: 30px;
    display: inline-block;
    transition: all 0.3s;
}

.action-button:hover {
    background-color: #fff;
    color: #75b3dc;
}

.make-space {
    margin-bottom: 6rem;
}

.section-heading {
    margin-bottom: 40px !important;
}

.callback-form {
    margin-top: 3rem !important;
}

</style>
