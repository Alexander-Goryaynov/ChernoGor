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
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <button type="button" @click="$router.push('/categories')"
                                            class="action-button">
                                        <i class="fas fa-backward"></i> Назад
                                    </button>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <h2 class="float-left">Изменение категории</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 offset-md-2">
                            <div class="contact-form">
                                <form id="contact" action="" method="post">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <fieldset>
                                                <input name="name" type="text" v-model="new_name" class="form-control"
                                                       id="name">
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12">
                                            <fieldset>
                                                <button type="submit" id="form-submit" @click.prevent="check()"
                                                        class="border-button">Изменить категорию
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
    </div>
</template>

<script>

import Swal from "sweetalert2";

export default {
    data() {
        let category = {
            id: '',
            name: ''
        };
        return {
            category,
            new_name: '',
            error_message: ''
        }
    },
    created() {
        const catId = this.$route.params.id;
        axios.get('/api/v1/categories/' + catId + '/edit').then(response => {
            this.category = {
                id: catId,
                name: response.data.name
            }
            this.new_name = this.category.name;
        });
    },
    name: "ServiceItemComponent",
    methods: {
        check() {
            if (!this.new_name) {
                Swal.fire({
                    title: 'Ошибка',
                    text: 'Заполните поле',
                    icon: 'error',
                    confirmButtonText: 'Ок'
                });
            } else {
                this.new_name = this.new_name.trim();
                if (!(/^[a-zA-Zа-яА-Я ]+$/.test(this.new_name))) {
                    this.error_message += "Категория должна содержать только буквы. \n";
                }
                if ((this.new_name.length) < 3 || (this.new_name.length) > 30) {
                    this.error_message += "Категория должна содержать более 5 и менее 30 символов. \n";
                }
                if (this.new_name === this.category.name) {
                    this.error_message += "Название должно отличаться \n";
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
                    axios.put('/api/v1/categories/' + this.$route.params.id, {"name": this.new_name}).then(response => {
                        Swal.fire({
                            title: 'Успех',
                            text: 'Категория изменена успешно',
                            icon: 'success',
                            confirmButtonText: 'Ок'
                        });
                        this.$router.push('/categories')
                    }).catch(function (error) {
                        if (error.response) {
                            Swal.fire({
                                title: 'Ошибка',
                                text: 'Невозможно создать категорию',
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

.action-button {
    background-color: transparent;
    color: #75b3dc;
    border: 2px solid #75b3dc;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: 700;
    padding: 5px 10px;
    border-radius: 30px;
    display: inline-block;
    transition: all 0.3s;
}

.action-button:hover {
    background-color: #71bff3;
    color: #317aa4;
}

</style>
