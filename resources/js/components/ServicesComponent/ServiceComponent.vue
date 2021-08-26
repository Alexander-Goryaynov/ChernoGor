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
            ]},
            {
                id: 1,
                name: 'Удостоверение сделок 1',
                subcategories: [{
                    id: 0,
                    name: 'Доверенности 1',
                    price: 5000
                }, {
                    id: 1,
                    name: 'Брачный договор 1',
                    price: 5000
                }, {
                    id: 2,
                    name: 'Договор о купле-продаже недвижимости 1',
                    price: 5000
                }, {
                    id: 3,
                    name: 'Проверка подлинности подписи',
                    price: 5000
                }, {
                    id: 4,
                    name: 'Договор о разделе совместного имущества',
                    price: 5000
                }]
            },
            {

                id: 2,
                name: 'Удостоверение сделок 2',
                subcategories: [{
                    id: 0,
                    name: 'Доверенности 2',
                    price: 5000
                }, {
                    id: 1,
                    name: 'Брачный договор 2',
                    price: 5000
                }, {
                    id: 2,
                    name: 'Договор о купле-продаже недвижимости 2',
                    price: 5000
                }, {
                    id: 3,
                    name: 'Проверка подлинности подписи',
                    price: 5000
                }, {
                    id: 4,
                    name: 'Договор о разделе совместного имущества',
                    price: 5000
                }]
            }
        ];
        return {
            categories,
            active: null,
            subcategories: null
        }
    },
    methods: {
        show(index) {
            this.active = index
            this.subcategories = this.categories[index].subcategories;
        }
    },
    name: "ServiceComponent"
}
</script>

<style scoped>
.button-style {
    padding: 0;
    border: none;
    background: none;
}
</style>
