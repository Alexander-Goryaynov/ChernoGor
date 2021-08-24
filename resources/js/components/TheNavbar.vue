<template>
    <div>
        <!-- Header -->
        <div class="sub-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <ul class="left-info">
                            <li><a href="#"><i class="fas fa-star"></i>Пн-Пт 09:00-17:00</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i>8(800)55-35-35</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <header>
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <router-link class="navbar-brand" :to="{name: 'home'}"><h2>ChernoGor</h2></router-link>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><a class="fas fa-bars"></a></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{name: 'home'}"> Главная </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{name: 'services'}">Наши услуги</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{name: 'create-order'}">Создать заявку</router-link>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">One Page</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    </div>
</template>

<script>
export default {
    name: "TheNavbar"
}
</script>

<style scoped>

</style>
