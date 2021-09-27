<template>
    <div>
        <!-- Page Content -->
        <div class="page-heading header-text " id="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Наши услуги</h1>
                        <span>Решаем ваши проблемы уже на протяжении 10 лет</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-services">
            <div class="container">
                <div class="row" id="tabs">
                    <div class="col-md-4">
                        <div v-if="categories">
                            <div v-if="isAdmin">
                                <button name="create" id="create"
                                        class="action-button float-right mb-3"
                                        @click="createCategory()">Создать категорию <i class="fas fa-plus-circle"></i>
                                </button>
                            </div>
                            <ul v-for="cat in categories" :key="cat.id + 'cat'">
                                <li>
                                    <button v-if="isAdmin"
                                            class="action-button float-right"
                                            @click="deleteCat(cat.id)">Удалить <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <button v-if="isAdmin" class="action-button float-right mb-1 mr-1"
                                            @click="edit(cat.id)">
                                        Изменить <i class="far fa-edit"></i>
                                    </button>
                                    <a :id="cat.id" href="#" :class="['mb-1', {'text-white': active === cat.id}]"
                                       @click.prevent="show(cat.id)">{{ cat.name }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <section class='tabs-content mb-5'>
                            <article id='tabs-1'>
                                <img src="images/single_service_02.jpg" alt="">
                                <p class="mb-1">
                                    На сайте представлен перечень основных предоставляемых услуг. Для получения более
                                    подробной
                                    информации о каждой категории и подкатегории советуем использовать источник: <a
                                    href="https://notariat.ru/sovet/">https://notariat.ru/sovet/</a>
                                </p>
                                <div v-if="active !== null">
                                    <h4>{{ this.categories.find(x => x.id === active).name }}</h4>
                                    <button v-if="isAdmin" class="action-button float-right mb-1 mr-1"
                                            @click="createSub(active)">
                                        Создать подкатегорию <i class="fas fa-plus-circle"></i>
                                    </button>
                                </div>
                                <div v-else>
                                    <h4>Пожалуйста, выберите категорию</h4>
                                </div>
                                <hr>
                                <div v-if="subcategories" class="mt-5">
                                    <ul v-for="sub in subcategories" :key="sub.id + 'sub'">
                                        <button v-if="isAdmin" class="action-button float-right"
                                                @click="deleteSub(sub.id)">Удалить <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button v-if="isAdmin"
                                                class="action-button float-right mb-1 mr-1"
                                                @click="editSub(sub.id, sub.name, sub.price)">
                                            Изменить <i class="far fa-edit"></i>
                                        </button>
                                        <li><a class="text-white mb-2">{{ sub.name }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div v-else>
                                    Подкатегорий пока нет...
                                </div>
                            </article>
                        </section>
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

        let categories = [];
        return {
            categories,
            active: null,
            subcategories: null,
            isAdmin: false,
            status: '',
        }
    },
    methods: {
        show(index) {
            this.active = index
            if (this.categories.find(x => x.id === index).subcategories.length !== 0) {
                this.subcategories = this.categories.find(x => x.id === index).subcategories;
            } else {
                this.subcategories = null;
            }
        },
        edit(index) {
            this.$router.push('/categories/' + index);
        },
        editSub(index, name, price) {
            this.$router.push({
                name: 'subcategories-item',
                params: {
                    id: parseInt(index),
                    name: name,
                    price: price,
                    category_id: this.active
                }
            })
        },
        createSub(index) {
            this.$router.push({
                name: 'subcategories-create',
                params: {
                    cat_id: parseInt(index)
                }
            })
        },
        deleteSub(index) {
            axios.delete('/api/v1/subcategories/' + index).then(response => {
                axios.get('/api/v1/services/tree').then(response => {
                    this.categories = response.data.categories;
                    this.show(this.active);
                    Swal.fire({
                        title: 'Успех',
                        text: 'Категория удалена успешно',
                        icon: 'success',
                        confirmButtonText: 'Ок'
                    });
                });
            }).catch(function (error) {
                if (error.response) {
                    Swal.fire({
                        title: 'Ошибка',
                        text: 'Невозможно удалить подкатегорию',
                        icon: 'error',
                        confirmButtonText: 'Ок'
                    });
                }
            });
        },
        createCategory() {
            this.$router.push({name: 'categories-create'})
        },
        deleteCat(index) {
            let subcats = this.categories.find(x => x.id === index).subcategories;
            if (subcats.length !== 0) {
                Swal.fire({
                    title: 'Ошибка',
                    text: 'В категории не должно быть подкатегорий',
                    icon: 'error',
                    confirmButtonText: 'Ок'
                });
            } else {
                axios.delete('/api/v1/categories/' + index).then(response => {
                    let num = this.categories.findIndex(function (item, i) {
                        return item.id === index
                    });
                    let removed = this.categories.splice(num, 1);
                    //удаление
                    Swal.fire({
                        title: 'Успех',
                        text: 'Категория удалена успешно',
                        icon: 'success',
                        confirmButtonText: 'Ок'
                    });
                }).catch(function (error) {
                    if (error.response) {
                        Swal.fire({
                            title: 'Ошибка',
                            text: 'Невозможно удалить категорию',
                            icon: 'error',
                            confirmButtonText: 'Ок'
                        });
                    }
                });
            }
        }
    }, created() {
        if (this.$cookies.get('role') === 'admin') {
            this.isAuthorized = true;
            this.isAdmin = true;
        }

        eventBus.$on('logout', data => {
            this.isAuthorized = false;
            this.isAdmin = false;
        })

        axios.get('/api/v1/services/tree').then(response => {
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
    name: "ServiceComponent",
    mounted() {
        window.scrollTo(0, 0)
    }
}
</script>

<style scoped>
.button-style {
    padding: 0;
    border: none;
    background: none;
}

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
