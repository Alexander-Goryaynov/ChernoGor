<template>
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="main-banner header-text" id="top">
        <div class="Modern-Slider">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="item item-1">
                            <div class="img-fill">
                                <div class="text-content">
                                    <h6>Мы будем рады Вам помочь</h6>
                                    <h4>Сложная задача - <br>простое решение</h4>
                                    <p>Нотариальная контора "Chernogor" поможет Вам с легкостью найти подходящего
                                        нотариуса и решить Вашу проблему в кратчайшие сроки.</p>
                                    <router-link v-if="isAuthorized" class="filled-button" :to="{name: 'create-order'}">Оставить заявку
                                    </router-link>
                                    <router-link v-else class="filled-button" :to="{name: 'register'}">Зарегистрироваться
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="item item-2">
                            <div class="img-fill">
                                <div class="text-content">
                                    <h6>Наши сотрудники</h6>
                                    <h4>Настоящие <br>профессионалы</h4>
                                    <p>Сотрудники нотариальной конторы "Chernogor" - высококвалифицированные, опытные
                                        специалисты. <br> Они помогут решить любой Ваш вопрос, связанный с оказанием
                                        абсолютно любой нотариальной услуги.</p>
                                      <router-link class="filled-button" :to="{name: 'notaries'}">Список нотариусов</router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="item item-3">
                            <div class="img-fill">
                                <div class="text-content">
                                    <h6>Качественное обслуживание</h6>
                                    <h4>Наши услуги</h4>
                                    <p>Благодаря нашей слаженной работе было обслужено уже более 1000 довольных
                                        клиентов. <br>
                                        Чтобы ознакомиться с полным списком услуг нотариальной конторы - пройдите по
                                        ссылке и узнайте подробную информацию о каждой из них. </p>
                                    <router-link class="filled-button" :to="{name: 'categories'}">Узнать больше</router-link>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

    </div>
</template>

<script>
import {eventBus} from "../../app";

export default {
    components: {
    },
    data() {
        return {
            isAuthorized: null,
            updateNav: null
        }
    },
    watch: {
        updateNav: function(newVal, oldVal) { // watch it
            if (this.$cookies.get("email")) {
                this.isAuthorized = true;
            }
        }
    },
    created() {
        if (this.$cookies.get("email")) {
           this.isAuthorized = true;
        }
        eventBus.$on('updateNav', data => {
            this.updateNav = data.updateNav;
            this.isAuthorized = true;
        })
    }
};
</script>

<style scoped>

</style>
