<template>
    <div class="testimonials">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Что <em>о нас</em> говорят?</h2>
                        <span>Отзывы наших клиентов</span>
                    </div>
                </div>
                <div class="col-md-12 height-carousel">
                    <div id="carousel-example-2" class="carousel slide carousel-fade" data-ride="carousel">
                        <!--Indicators-->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-2" data-slide-to="1"></li>
                            <li data-target="#carousel-example-2" data-slide-to="2"></li>
                        </ol>
                        <!--/.Indicators-->
                        <!--Slides-->
                        <div class="carousel-inner height-carousel" role="listbox">
                            <div class="carousel-item active height-carousel">
                                <div class="view show-picture">
                                    <img class="d-block w-100 show-picture" src="images/review.jpg"
                                         alt="First slide">
                                    <div class="mask rgba-black-light"></div>
                                </div>
                                <div class="carousel-caption">
                                    <div class="testimonial-item">
                                        <div class="inner-content inner-content-review">
                                            <h4 class="inner-content-review">Валерий Мяонтьев</h4>
                                            <span class="inner-content-review">Предприниматель</span>
                                            <p class="inner-content-review">Благодарю компанию ЧерноГор за предоставленные услуги! Всё было просто замечательно! Сегодня же выпью за это, ну и за любовь заодно...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item height-carousel">
                                <!--Mask color-->
                                <div class="view show-picture">
                                    <img class="d-block w-100 show-picture" src="images/review.jpg"
                                         alt="Second slide">
                                    <div class="mask rgba-black-strong"></div>
                                </div>
                                <div class="carousel-caption">
                                    <div class="testimonial-item">
                                        <div class="inner-content inner-content-review">
                                            <h4 class="inner-content-review">Марсель Лодочкин</h4>
                                            <span class="inner-content-review">Дизайнер интерьеров</span>
                                            <p class="inner-content-review">Большое спасибо нотарису Илье Корочкину! Очень приятный человек, знаток своего дела. Как только снова появится нужда в оказании нотариальных услуг - сразу к вам! </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item height-carousel">
                                <!--Mask color-->
                                <div class="view show-picture">
                                    <img class="d-block w-100 show-picture" src="images/review.jpg"
                                         alt="Third slide">
                                    <div class="mask rgba-black-slight"></div>
                                </div>
                                <div class="carousel-caption">
                                    <div class="testimonial-item">
                                        <div class="inner-content">
                                            <h4 class="inner-content-review">Александр Субботин</h4 class="inner-content-review">
                                            <span class="inner-content-review"> Аналитик в IT-компании</span>
                                            <p class="inner-content-review">Данная нотариальная контора помогла мне составить договор о купле-продаже недвижимости в кратчайшие сроки. Качественное обслуживание, приятный персонал. Я остался крайне доволен!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/.Slides-->
                        <!--Controls-->
                        <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        <!--/.Controls-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

name: "MainStatsComponent"
}
</script>

<style scoped>

</style>
