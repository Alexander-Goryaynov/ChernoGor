<template>
    <div>
        <!-- Page Content -->
        <div class="page-mini-heading header-text">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>

        <div class="callback-form mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h2>Регистрация</h2>
                            <span>Заполните данные формы</span>
                        </div>
                    </div>
                    <div class="col-md-8 offset-md-2">
                        <div class="contact-form">
                            <form id="contact" action="" method="post">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <input name="name" type="text" v-model="name" class="form-control" id="name"
                                                   placeholder="ФИО">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <input name="email" type="text" v-model="email" class="form-control"
                                                   id="email" pattern="[^ @]*@[^ @]*" placeholder="E-Mail адрес">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <input name="password" :type="type" v-model="password" class="form-control"
                                                   id="password" placeholder="Пароль">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                        <fieldset>
                                            <input name="password_confirmed" :type="type" v-model="password_confirmed"
                                                   class="form-control" id="password_confirmed"
                                                   placeholder="Повторите пароль">
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
                                            <button type="submit" id="form-submit" @click.prevent="checkData()"
                                                    class="border-button">Создать аккаунт
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
import Swal from 'sweetalert2'

export default {
    data() {
        return {
            type: 'password',
            name: '',
            fio: '',
            email: '',
            password: '',
            password_confirmed: '',
            error_message: ''
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
            if (!this.name || !this.email || !this.password || !this.password_confirmed) {
                Swal.fire({
                    title: 'Ошибка',
                    text: 'Заполните все поля',
                    icon: 'error',
                    confirmButtonText: 'Ок'
                });
            } else {
                this.name = this.name.trim();
                this.email = this.email.trim();
                this.password = this.password.trim();
                this.password_confirmed = this.password_confirmed.trim();
                if (!(/^[a-zA-Zа-яА-Я ]+$/.test(this.name))) {
                    this.error_message += "ФИО должно содержать только буквы. \n";
                }
                if ((this.name.length) < 3 || (this.name.length) > 30) {
                    this.error_message += "ФИО должно содержать более 3 и менее 30 символов. \n";
                }
                if (!(/\S+@\S+\.\S+/.test(this.email))) {
                    this.error_message += "Email должен быть корректного формата. \n";
                }
                if ((this.password.length) < 3 || (this.password.length) > 30) {
                    this.error_message += "Пароль должен содержать более 3 и менее 30 символов. \n";
                }
                if (this.password !== this.password_confirmed) {
                    this.error_message += "Пароли должны совпадать. \n";
                }
                if (this.error_message) {
                    Swal.fire({
                        title: 'Ошибка',
                        text: this.error_message,
                        icon: 'error',
                        confirmButtonText: 'Ок'
                    })
                    this.error_message = '';
                } else {
                    axios.post('/register', {
                        "name": this.name,
                        "email": this.email,
                        "password": this.password,
                        "password_confirmation": this.password_confirmed,
                    }).then(response => {
                        this.$cookies.set("email", this.email, 21600);
                        this.$cookies.set("name", this.name, 21600);
                        this.$cookies.set("role", 'user', 21600);
                        this.$router.push('/categories');
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

.section-heading {
    margin-bottom: 30px !important;
}

.callback-form {
    margin-top: 2rem !important;
}
</style>
