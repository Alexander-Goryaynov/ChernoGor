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
                                    <h2 class="float-left">Создание подкатегории</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 offset-md-2">
                            <div class="contact-form">
                                <form id="contact" action="" method="post">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <fieldset>
                                                <select class="form-control rounded-select"
                                                        name="catName"
                                                        id="catName"
                                                        v-model="selected_cat">
                                                    <option v-for="item in categories" :key="item.id" :selected="selected_cat === item.id" :value="item.id">{{ item.name }}
                                                    </option>
                                                </select>
                                            </fieldset>
                                            <fieldset>
                                                <input name="name" type="text" v-model="subcategory.name" class="form-control"
                                                       id="name" placeholder="Название подкатегории">
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <fieldset>
                                                <input name="price" type="number" v-model="subcategory.price" class="form-control"
                                                       id="price">
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12">
                                            <fieldset>
                                                <button type="submit" id="form-submit"
                                                        @click.prevent="check()"
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
    </div>
</template>

<script>
import Swal from 'sweetalert2'

export default {
    props: ['cat_id'],
    data() {
        let subcategory = {
            id: '',
            name: '',
            price: 0,
            category_id: 0
        };
        return {
            subcategory,
            categories: [],
            error_message: '',
            selected_cat: 0
        }
    },
    created() {
        this.selected_cat = this.cat_id;
        axios.get('/api/v1/categories/select').then(response => {
            this.categories = response.data.categories;
        }).catch(function (error) {
            if (error.response) {
                Swal.fire({
                    title: 'Ошибка',
                    text: 'Невозможно загрузить категории',
                    icon: 'error',
                    confirmButtonText: 'Ок'
                });
            }
        });
    },
    name: "ServiceItemComponent",
    methods: {
        check() {
           this.subcategory.category_id = this.selected_cat;
            if (!this.subcategory.name) {
                Swal.fire({
                    title: 'Ошибка',
                    text: 'Заполните поле',
                    icon: 'error',
                    confirmButtonText: 'Ок'
                });
            }
            else {
                this.subcategory.name = this.subcategory.name.trim();
                if (!(/^[a-zA-Zа-яА-Я ]+$/.test(this.subcategory.name))) {
                    this.error_message += "Подкатегория должна содержать только буквы. \n";
                }
                if (!this.subcategory.category_id) {
                    this.error_message += "Выбрите категорию \n";
                }
                if (this.subcategory.price < 500) {
                    this.error_message += "Минимальная стоимость услуг - 500 рублей \n";
                }
                if ((this.subcategory.name.length) < 3 || (this.subcategory.name.length) > 30) {
                    this.error_message += "Подкатегория должна содержать более 5 и менее 30 символов. \n";
                }
                if (this.error_message) {
                    Swal.fire({
                        title: 'Ошибка',
                        text: this.error_message,
                        icon: 'error',
                        confirmButtonText: 'Ок'
                    })
                    this.error_message = '';
                }
                else {
                    axios.post('/api/v1/subcategories', {
                        "name": this.subcategory.name,
                        "price": this.subcategory.price,
                        "category_id": this.subcategory.category_id
                    }).then(response => {
                        Swal.fire({
                            title: 'Успех',
                            text: 'Подкатегория создана успешно',
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
        window.scrollTo(0, 0);
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

.rounded-select {
    border-radius: 10px;
    height: 40px;
    line-height: 40px;
    display: inline-block;
    padding: 0px 15px;
    color: #6a6a6a;
    font-size: 18px;
    text-transform: none;
    box-shadow: none;
    border: none;
    margin-bottom: 35px;
}

.back-light {
    border-radius: 20px;
    background-color: #fdf8f8;
    font-weight: bold;
}
</style>
