<template>
    <div>
        <div class="page-heading " id="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-style">Наши нотариусы</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container pt-5">
            <div class="row">
                <div class="col-md-8 order-md-2 col-lg-9">
                    <div class="container-fluid">
                        <div class="row   mb-5">
                            <div class="col-12">
                                <div class="dropdown text-md-left text-center float-md-left mb-3 mt-3 mt-md-0 mb-md-0">
                                    <label class="mr-2 shown-hidden">Описание: </label>
                                    <a class="btn btn-lg btn-light dropdown-toggle" @click="visible = !visible" >
                                        <template v-if="visible">Скрыть</template>
                                        <template v-else>Показать</template>
                                        <span class="caret"></span>
                                    </a>

                                </div>
                                <div id="wrapper">
                                    <div class="btn-group btn-group-sm float-md-right" id="button-group-block">
                                        <input type="text" class="style-input">
                                        <button type="button" class="btn btn-primary"><h6>Поиск</h6></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <template v-for="index in 12">
                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                    <div class="card h-100 border-0 rounded">
                                        <div class="card-img-top">
                                            <div class="image-view">
                                            <img src="https://via.placeholder.com/240x240/5fa9f8/efefef"
                                                 class="img-fluid mx-auto d-block rounded" alt="Card image cap">
                                            <h2 class="text-image-view">
                                                <span v-if="visible" class="image-span">
                                                    Первоклассный специалист. Чудесный собеседник.
                                                </span>
                                            </h2>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="card-title">
                                                <router-link :to="{name: 'notaries-item', params: { id: index }}"
                                                   class=" font-weight-bold text-dark small">Субботин Валерий Степанович</router-link>
                                                <br>
                                                <h6 class="mt-2">Ул. Водопроводная, 25А</h6>
                                            </h4>
                                            <h5 class="card-price text-primary">
                                                <h6 class="font-italic">Высшая квалификация</h6>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="row sorting mb-5 mt-5">
                            <div class="col-12">
                                <a class="btn btn-light" @click="scrollUp()">
                                    <i class="fas fa-arrow-up mr-2"></i> Back to top</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 order-md-1 col-lg-3 sidebar-filter">
                    <h3 class="mt-0 mb-5">Список <span class="text-primary">нотариусов</span></h3>
                    <h5 class="mt-5 mb-3 font-weight-bold">Квалификация</h5>
                    <div class="price-filter-control">
                            <select class="form-control rounded-select m-1"
                                name="qualification"
                                id="qualification">
                            <option :value="5" selected>Все квалификации</option>
                            <option v-for="item in qualifications" :value="item.id">
                                {{ item.name }}
                            </option>
                        </select>
                        <div v-if="show">
                            <hr>
                            <h5 class="font-weight-bold text-dark">Коэффициенты кваливикаций</h5>
                            <h5>Средняя: цена услуги</h5>
                            <br>
                            <h5>Высшая: цена услуги <span class="text-primary">* 1,25</span></h5>
                            <br>
                            <h5>Наивысшая: цена услуги <span class="text-primary">* 1,5</span></h5></div>
                        </div>
                    <a href="#" class="btn btn-lg btn-block btn-primary mt-5" @click.prevent="showClue">{{message}}</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        let qualifications = [
            {
                id: 0,
                name: 'Средняя квалификация',
                coefficient: 1
            },
            {
                id: 1,
                name: 'Высшая квалификация',
                coefficient: 1.25
            },
            {
                id: 2,
                name: 'Наивысшая квалификация',
                coefficient: 1.5
            }
        ];
        return {
            qualifications,
            show: false,
            message: 'Показать подсказку',
            visible: false
        }
    },
    methods: {
        scrollUp() {
            window.scrollTo(0, 0)
        },
        showClue() {
            this.show = !this.show;
            if (this.show) {
                this.message = 'Скрыть подсказку';
            }
            else {
                this.message = 'Показать подсказку';
            }
        },
    },
    mounted() {
        window.scrollTo(0, 0)
    },
    name: "NotaryListComponent"
}

</script>

<style scoped>
.text-style {
    text-transform: none !important;
}


@media (max-width: 800px) {
    #wrapper {
        text-align: center;
    }

    #button-group-block {
        display: inline-block;
    }

    .style-input {
        height: 26px !important;
    }
}

.style-input {
    height: 2rem;
}

.image-view {
    position	: relative;
    width		: 100%; /* for IE 6 */
}

.text-image-view {
    margin-left: 5px;
    width: 90%;
    position	: absolute;
    top		    : 10px;
    left		: 0;
}

.image-span {
    font-size: 15px;
    font-weight: 300;
    color: #FBFDFE;
    background-color: rgb(43,126,198, 0.8) !important;
    padding: 8px;
    line-height: 23px;
    -moz-border-bottom-left-radius: 5px;
    -webkit-border-bottom-left-radius: 5px;
    border-bottom-left-radius: 5px;
    -moz-border-bottom-right-radius: 5px;
    -webkit-border-bottom-right-radius: 5px;
    border-bottom-right-radius: 5px;
    -moz-border-top-right-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    border-top-right-radius: 5px;
    -webkit-box-decoration-break: clone;
    -o-box-decoration-break: clone;
    box-decoration-break: clone;
}

.shown-hidden {
    font-size: 16px;
}
</style>
