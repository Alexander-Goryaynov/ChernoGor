<template>
    <div>
        <div class="fun-facts">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="left-content">
                            <span>Достижения организации "Chernogor"</span>
                            <h2>Наши решения <br><em>ваших проблем</em></h2>
                            <p>За долгие годы существования нашей конторы было обслужено огромное множество клиентов из
                                разных регионов, были найдены решения для тысячи разных задач.
                                <br><br>Наша компания - лидер в Ульяновске. Благодаря слаженной работе наших сотрудников
                                нотариальная контора "Chernogor" лидирует на рынке труда уже более 3 лет.</p>
                            <router-link :to="{name: 'categories'}" class="filled-button">Ознакомиться с каталогом услуг</router-link>
                        </div>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="count-area-content">
                                    <div class="count-digit">2365</div>
                                    <div class="count-title">рабочих дней</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="count-area-content">
                                    <div class="count-digit">1050</div>
                                    <div class="count-title">оказанных услуг</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="count-area-content">
                                    <div class="count-digit">1</div>
                                    <div class="count-title">место в рейтинге Ульяновска</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="count-area-content">
                                    <div class="count-digit">15</div>
                                    <div class="count-title">опытных специалистов</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="more-info">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="more-info-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="left-image">
                                        <img src="images/more-info.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6 align-self-center">
                                    <div class="right-content">
                                        <span>Почему мы?</span>
                                        <h2>Крупнейшая нотариальная контора в <em>Ульяновске</em></h2>
                                        <p>В штаб нашей компании входят более 15 лучших специалистов со всего города.
                                            Познакомьтесь с ними прямо сейчас! </p>
                                        <router-link :to="{name: 'notaries'}" class="filled-button">Список нотариусов</router-link>
                                    </div>
                                </div>
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
    name: "MainAwardsComponent"
}
</script>

<style scoped>

</style>
