<template>
    <div><!-- Footer Starts Here -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 footer-item">
                        <h4>Станьте нашим клиентом прямо сейчас!</h4>
                        <p>Вступайте в наши сообщества для получения новейшей информации о нашей нотариальной конторе</p>
                        <ul class="social-icons">
                            <li><a rel="nofollow" href="https://fb.com/templatemo" target="_blank"><i
                                class="fab fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fab fa-behance"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 footer-item">
                        <h4>Разделы сайта</h4>
                        <ul class="menu-list">
                            <li><router-link class="nav-link" :to="{name: 'home'}">Главная</router-link></li>
                            <li><router-link class="nav-link" :to="{name: 'categories'}">Наши услуги</router-link></li>
                            <li><router-link class="nav-link" :to="{name: 'notaries'}">Наши нотариусы</router-link></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <div class="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>© Нотариальная контора "ChernoGor"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "TheFooter"
}
</script>

<style scoped>

</style>
