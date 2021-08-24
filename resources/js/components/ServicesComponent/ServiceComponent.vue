<template>
    <div>
        <!-- Page Content -->
        <div class="page-heading header-text">
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
                        <div class="same-size" v-if="categories">
                            <ul v-for="(cat, index) in categories" :key="index">
                                <li>
                                    <a :id="index" href="#" :class="['mb-1',{'text-white': active === index}]"
                                       @click.prevent="show(index)">{{ cat.name }}
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
                                <div v-if="subheads">
                                    <ul v-for="(sub, index) in subheads" :key="index + 'sub'">
                                        <li><a class="text-white mb-2">{{ sub }}</a>
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
                name: 'Удостоверение сделок',
                subheads: ['Доверенности', 'Брачный договор',
                    'Договор о купле-продаже недвижимости', 'Договор займа', 'Договор о разделе совместного имущества'],
            },
            {
                name: 'Удостоверение сделок 2',
                subheads: ['Доверенности 1', 'Брачный договор 1',
                    'Договор о купле-продаже недвижимости1', 'Договор займа', 'Договор о разделе совместного имущества'],
            },
            {
                name: 'Удостоверение сделок 3',
                subheads: ['Доверенности 123', 'Брачный договор 123',
                    'Договор о купле-продаже недвижимости1', 'Договор займа', 'Договор о разделе совместного имущества'],
            },
        ];
        return {
            categories,
            active: null,
            subheads: null
        }
    },
    methods: {
        show(index) {
            this.active = index
            this.subheads = this.categories[index].subheads;
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

.same-size {

}
</style>
