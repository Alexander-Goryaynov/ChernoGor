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
                            <ul v-for="cat in categories" :key="cat.id + 'cat'">
                                <li>
                                    <button v-if="isAdmin && !subcategoriesCount(cat.id)" class="action-button float-right"
                                            @click="">Удалить <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <button v-if="isAdmin" class="action-button float-right mb-1 mr-1" @click="edit(cat.id)">
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
                                <h4 v-if="active !== null">{{ categories[active].name }}</h4>
                                <h4 v-else>Пожалуйста, выберите категорию</h4>
                                <hr>
                                <div v-if="subcategories">
                                    <ul v-for="sub in subcategories" :key="sub.id + 'sub'">
                                        <button v-if="isAdmin" class="action-button float-right"
                                                @click="">Удалить <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button v-if="isAdmin" class="action-button float-right mb-1 mr-1" @click="editSub(sub.id)">
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
export default {
    data() {
        let categories = [
            {
                id: 0,
                name: 'Удостоверение сделок',
                subcategories: [{
                    id: 0,
                    name: 'Доверенности',
                    price: 5000
                }, {
                    id: 1,
                    name: 'Брачный договор',
                    price: 5000
                }, {
                    id: 2,
                    name: 'Договор о купле-продаже недвижимости',
                    price: 5000
                }, {
                    id: 3,
                    name: 'Проверка подлинности подписи',
                    price: 5000
                }, {
                    id: 4,
                    name: 'Договор о разделе совместного имущества',
                    price: 5000
                }
                ]
            },
            {
                id: 1,
                name: 'Удостоверение сделок 1',
                subcategories: [{
                    id: 5,
                    name: 'Доверенности 1',
                    price: 5000
                }, {
                    id: 6,
                    name: 'Брачный договор 1',
                    price: 5000
                }, {
                    id: 7,
                    name: 'Договор о купле-продаже недвижимости 1',
                    price: 5000
                }, {
                    id: 8,
                    name: 'Проверка подлинности подписи',
                    price: 5000
                }, {
                    id: 9,
                    name: 'Договор о разделе совместного имущества',
                    price: 5000
                }]
            },
            {

                id: 2,
                name: 'Удостоверение сделок 2',
                subcategories: [{
                    id: 10,
                    name: 'Доверенности 2',
                    price: 5000
                }, {
                    id: 11,
                    name: 'Брачный договор 2',
                    price: 5000
                }, {
                    id: 12,
                    name: 'Договор о купле-продаже недвижимости 2',
                    price: 5000
                }, {
                    id: 13,
                    name: 'Проверка подлинности подписи',
                    price: 5000
                }, {
                    id: 14,
                    name: 'Договор о разделе совместного имущества',
                    price: 5000
                }]
            },
            {
                id: 3,
                name: 'Удостоверение сделок 3',
                subcategories: []
            }
        ];
        return {
            categories,
            active: null,
            subcategories: null,
            isAdmin: true
        }
    },
    methods: {
        show(index) {
            this.active = index
            this.subcategories = this.categories[index].subcategories;
        },
        subcategoriesCount(index) {
            return !!this.categories[index].subcategories.length;
        },
        edit(index) {
            this.$router.push('/categories/' + index);
        },
        editSub(index) {
            this.$router.push('/subcategories/' + index);
        }
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
