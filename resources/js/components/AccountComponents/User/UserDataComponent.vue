<template>
    <div>
        <div class="page-heading " id="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-style">Редактирование профиля</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="callback-form mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="contact-form">
                            <form id="contact" action="" method="post">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <label for="email" class="text-white h4 float-left mb-2">
                                                E-mail пользователя
                                            </label>
                                            <input name="email" type="text" :value="account.email" class="form-control"
                                                   id="email" disabled>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <label for="name" class="text-white h4 float-left mb-2">
                                                ФИО пользователя:
                                            </label>
                                            <input name="name" type="text" v-model="account.name"
                                                   class="form-control"
                                                   id="name">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <label for="password" class="text-white h4 float-left mb-2">
                                                Пароль:
                                            </label>
                                            <input name="password" :type="type" v-model="password"
                                                   class="form-control"
                                                   id="password" placeholder="Пароль">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <label for="new_password" class="text-white h4 float-left mb-2">
                                                Новый пароль (необязательно):
                                            </label>
                                            <input name="new_password" :type="type" v-model="new_password"
                                                   class="form-control"
                                                   id="new_password" placeholder="Пароль">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                        <fieldset>
                                            <label for="password_confirmed" class="text-white h4 float-left mb-2">
                                                Повторите новый пароль:
                                            </label>
                                            <input name="password_confirmed" :type="type"
                                                   v-model="new_password_confirmation"
                                                   class="form-control" id="password_confirmed"
                                                   placeholder="Повторите пароль">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 mb-3 move">
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
                                                    class="border-button">Сохранить
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

export default {
    data() {
        const account =
            {
                email: "",
                name: "",
            }

        return {
            account,
            new_name: null,
            old_name: null,
            password: null,
            new_password: null,
            new_password_confirmation: null,
            type: 'password',
            error_message:''
        }
    },
    methods: {
        count() {
            console.log(this.array)
        }, showPassword() {
            if (this.type === 'password') {
                this.type = 'text'
            } else {
                this.type = 'password'
            }
        },
        checkData() {
            this.new_name = this.account.name;
            if ((!this.password) || (!this.new_name) || ((!this.new_name) && (this.password) && (!this.new_password))) {
                Swal.fire({
                    title: 'Ошибка',
                    text: 'Измените необходимые поля. Для изменения данных необходим пароль',
                    icon: 'error',
                    confirmButtonText: 'Ок'
                });
            } else {
                this.password = this.password.trim();
                if (this.new_password) this.new_password = this.new_password.trim();
                if (this.new_password_confirmation) this.new_password_confirmation = this.new_password_confirmation.trim();
                if ((this.new_name === this.old_name) && (!this.new_password)) {
                    this.error_message += "Новое имя должно отличаться от старого.\n";
                }
                if ((this.new_password === this.password)) {
                    this.error_message += "Новый пароль должен отличаться от старого.\n";
                }
                if (!(/^[a-zA-Zа-яА-Я ]+$/.test(this.name))) {
                    this.error_message += "ФИО должно содержать только буквы. \n";
                }
                if ((this.new_name.length) < 3 || (this.new_name.length) > 30) {
                    this.error_message += "ФИО должно содержать более 3 и менее 30 символов. \n";
                }
                if ((this.new_password) && ((this.new_password.length) < 3 || (this.new_password.length) > 30)) {
                    this.error_message += "Новый пароль должен содержать более 3 и менее 30 символов. \n";
                }
                if ((this.new_password && this.new_password_confirmation) && (this.new_password !== this.new_password_confirmation)) {
                    this.error_message += "Ваши пароли должны совпадать. \n";
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
                    const params = {}
                    params.name = this.new_name;
                    params.password = this.password;
                    if (this.new_password) params.new_password = this.new_password;
                    if (this.new_password_confirmation) params.new_password_confirmation = this.new_password_confirmation;

                    axios.put('/api/v1/account', params).then(response => {
                        this.$cookies.remove("name");
                        this.$cookies.set("name", this.new_name, 21600);
                        Swal.fire({
                            title: 'Все хорошо',
                            text: this.error_message,
                            icon: 'success',
                            confirmButtonText: 'Ок'
                        })
                        this.$router.push('/categories');
                    }).catch(error => {
                        if (error.response.status === 401) {
                            Swal.fire({
                                title: 'Ошибка',
                                text: 'Введен неверный пароль',
                                icon: 'error',
                                confirmButtonText: 'Ок'
                            })
                        }
                    });
                }
            }
        }
    },
    computed: {},
    mounted() {
        window.scrollTo(0, 0)
    },
    created() {
        axios.get('/api/v1/user').then(response => {
            this.account.name = response.data.name;
            this.old_name = this.account.name;
            this.account.email = response.data.email;
        }).catch(error => {
            console.log('Не удалось загрузить данные')
        })
       /* запрос на сервер */
    },
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
.move {
    padding-top: 35px;
}


</style>
