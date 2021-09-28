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
                                    <h2 class="float-left">Изменение подкатегории</h2>
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
                                                        v-model="new_category">
                                                        <option v-for="item in categories" :key="item.id" :selected="category_id === item.id" :value="item.id">{{ item.name }}
                                                        </option>
                                                </select>
                                            </fieldset>
                                            <fieldset>
                                                <input name="name" type="text" v-model="new_name" class="form-control"
                                                       id="name">
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <fieldset>
                                                <input name="price" type="number" v-model="new_price" class="form-control"
                                                       id="price">
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12">
                                            <fieldset>
                                                <button type="submit" id="form-submit" :disabled="check"
                                                        @click.prevent="changeSubCategory()"
                                                        class="border-button">Изменить подкатегорию
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
    props: {
        id: Number,
        name: String,
        price: Number,
        category_id: Number
    },
    data() {
        let subcategory = {
            id: '',
            name: '',
            price: ''
        };
        return {
            subcategory,
            new_name: '',
            new_price: '',
            new_category: '',
            categories: [],
            error_message: ''
        }
    },
    methods: {
        changeSubCategory() {
            this.new_name = this.new_name.trim();
            if (!(/^[a-zA-Zа-яА-Я ]+$/.test(this.new_name))) {
                this.error_message += "Подкатегория должна содержать только буквы. \n";
            }
            if ((this.new_name.length) < 3 || (this.new_name.length) > 30) {
                this.error_message += "Подкатегория должна содержать более 5 и менее 30 символов. \n";
            }
            if (this.new_price < 500) {
                this.error_message += "Минимальная стоимость услуг - 500 рублей \n";
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
                axios.put('/api/v1/subcategories/' + this.$route.params.id,
                    {
                        "name": this.new_name,
                        "price": this.new_price,
                        "category_id": this.new_category
                    }).then(response => {
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
    },
    created() {
        this.new_name = this.name;
        this.new_price = this.price;
        this.new_category =  this.category_id
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
    computed: {
        check() {
            const sub_cat_id = (this.new_category === this.category_id) || (this.new_category === null);
            if (!sub_cat_id && this.new_name !== '' && this.new_price !== null) {
                return false
            }
            else {
                const sub_name = (this.name === this.new_name) || (this.new_name === '');
                const sub_price = (this.price === this.new_price) || (this.new_price < 0);
                return (sub_name && sub_price);
            }
        }
    },
    mounted() {
        window.scrollTo(0, 0);
        if (!this.name || !this.price || this.category_id === null) {
            Swal.fire({
                title: 'Ошибка',
                text: 'Сначала выберите категорию',
                icon: 'error',
                timer: 1000,
            }).then((result) => {
                this.$router.push('/categories');
            });
        }
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
