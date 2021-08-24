<template>
    <div>
        <div class="page-heading">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-style">Запишитесь на приём прямо сейчас!</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="callback-form mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <h2>Оформление <em>заявки</em></h2>
                            <span>Заполните данные формы</span>
                        </div>
                    </div>
                    <div class="col-md-8 offset-md-2">
                        <div class="contact-form">
                            <form id="contact" action="" method="post">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <select class="form-control rounded-select" id="selectNotary">
                                                <option selected="true" disabled="disabled">Выбор нотариуса</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <select class="form-control rounded-select" id="selectService">
                                                <option selected="true" disabled="disabled">Выбор типа услуги</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <select class="form-control rounded-select" id="selectSubcategory">
                                                <option selected="true" disabled="disabled">Выбор подкатегории</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <select class="form-control rounded-select" id="selectDate">
                                                <option selected="true" disabled="disabled">Выбор даты</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <select class="form-control rounded-select" id="selectTime">
                                                <option selected="true" disabled="disabled">Выбор времени</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                            <p class="contact-label back-light">Цена за приём составит: {{price}} руб.</p>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-12">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="border-button">Создать заявку
                                            </button>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {

        return {
            price: 5000
        }
    },
    name: "CreateOrderComponent"
}
</script>

<style scoped>
.text-style {
    text-transform: none !important;
}
.rounded-select {
    border-radius: 10px;
    height: 40px;
    line-height: 40px;
    display: inline-block;
    padding: 0px 15px;
    color: #6a6a6a;
    font-size: 18px;
    text-transform: none;
    box-shadow: none;
    border: none;
    margin-bottom: 35px;
}
.back-light {
    border-radius: 20px;
    background-color: #84d8ff;
    font-weight: bold;
}
</style>
