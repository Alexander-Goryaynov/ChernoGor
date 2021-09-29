<template>
    <div>
        <div class="request-form">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h4>Хотите записаться к нам на приём?</h4>
                        <span v-if="!isAuthorized">Зарегистрируйтесь и оставьте заявку на нашем сайте прямо сейчас</span>
                        <span v-else>Здравствуйте, {{ userName }}, оставьте заявку на нашем сайте прямо сейчас</span>
                    </div>
                    <div class="col-md-4">
                        <router-link v-if="!isAuthorized" class="bord border-button" :to="{name: 'register'}">Зарегистрироваться</router-link>
                        <router-link v-else class="bord filled-button" :to="{name: 'create-order'}">Оставить заявку</router-link>
                    </div>  
                </div>
            </div>
        </div>

        <div class="services">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h2>Нотариальная контора <em>"ChernoGor"</em></h2>
                            <h5>Узнайте больше о нашей деятельности</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-item">
                            <img src="images/service_01.jpg" alt="">
                            <div class="down-content">
                                <h4>Найти нотариуса</h4>
                                <p>Для ознакомления с нашими нотариусами для записи на прием необходимо перейти по
                                    ссылке ниже</p>
                                <router-link class="filled-button" :to="{name: 'notaries'}">Список нотариусов</router-link>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-item">
                            <img src="images/service_02.jpg" alt="">
                            <div class="down-content">
                                <h4>О наших услугах</h4>
                                <p>Чтобы изучить полный список предоставляемых услуг, для этого нужно перейти по ссылке
                                    ниже на страницу с услугами</p>
                                <router-link class="filled-button" :to="{name: 'categories'}">Список услуг</router-link>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-item">
                            <img src="images/service_03.jpg" alt="">
                            <div class="down-content">
                                <h4>Нужна консультация?</h4>
                                <p>Наши сотрудники call-центра с радостью помогут Вам определиться с нотариусом и
                                    записаться на прием</p>
                                <router-link v-if="isAuthorized" class="filled-button" :to="{name: 'create-order'}">Оставить заявку</router-link>
                                <router-link v-else class="filled-button" :to="{name: 'login'}">Войти</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
     components: {
    },
    data() {
        return {
            isAuthorized: null,
            updateNav: null,
            userName: null
        }
    },
    watch: {
        updateNav: function(newVal, oldVal) { // watch it
            if (this.$cookies.get("name") && this.$cookies.get("email")) {
                this.isAuthorized = true;
                this.userName = this.$cookies.get("name");
            }
        }
    },
    created() {
        if (this.$cookies.get("name") && this.$cookies.get("email")) {
           this.isAuthorized = true;
           this.userName = this.$cookies.get("name");
        }
        eventBus.$on('updateNav', data => {
            this.updateNav = data.updateNav;
            this.isAuthorized = true;
        })
    }
}
</script>

<style scoped>
 .bord {
     border: 2px solid #ffffff !important;
 }
</style>
