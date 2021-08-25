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
                                            <label for="selectNotary" class="text-white h3 float-left mb-2">
                                                Выбор нотариуса:
                                            </label>
                                            <select class="form-control rounded-select"
                                                    name="selectNotary"
                                                    id="selectNotary"
                                                    @change="selectNotary(selectedNotary)"
                                                    v-model="selectedNotary" required>
                                                <option v-for="item in notariesList" :value="item.id">{{ item.fio }}
                                                </option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <label for="selectService" class="text-white h3 float-left mb-2">
                                                Выбор типа услуги:
                                            </label>
                                            <select class="form-control rounded-select"
                                                    name="selectService"
                                                    id="selectService"
                                                    @change="selectCategory(selectedService)"
                                                    v-model="selectedService" required>
                                                <template v-if="selectedNotary !== null">
                                                <option v-for="item in categoriesList" :value="item.id">{{ item.name }}
                                                </option>
                                                </template>
                                                <template v-else>
                                                    <option value="" disabled>Сначала выберите нотариуса</option>
                                                </template>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <label for="selectedSubcategory" class="text-white h3 float-left mb-2">
                                                Выбор подкатегории услуги:
                                            </label>
                                            <select class="form-control rounded-select"
                                                    name="selectedSubcategory"
                                                    id="selectedSubcategory"
                                                    @change="selectSubCategory(selectedSubcategory)"
                                                    v-model="selectedSubcategory" required>
                                                <template v-if="subcategoriesList">
                                                    <option v-for="item in subcategoriesList" :value="item.id">{{ item.name }}
                                                    </option>
                                                </template>
                                                <template v-else>
                                                    <option value="" disabled>Выберите категорию</option>
                                                </template>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <label for="selectDate" class="text-white h3 float-left mb-2">
                                                Выбор даты:
                                            </label>
                                            <select class="form-control rounded-select"
                                                    id="selectDate"
                                                    name="selectDate"
                                                    @change="selectDate(selectedDate)"
                                                    v-model="selectedDate" required>
                                                <template v-if="dates">
                                                    <option v-for="item in dates" :value="item.value">{{ item.value }}
                                                    </option>
                                                </template>
                                                <template v-else>
                                                    <option value="" disabled>Выберите подкатегорию</option>
                                                </template>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <label for="selectTime" class="text-white h3 float-left mb-2">
                                                Выбор времени:
                                            </label>
                                            <select class="form-control rounded-select"
                                                    id="selectTime"
                                                    name="selectTime"
                                                    @change="selectTime(selectedTime)"
                                                    v-model="selectedTime" required>
                                                <template v-if="times">
                                                    <option v-for="item in times" :value="item">{{ item }}
                                                    </option>
                                                </template>
                                                <template v-else>
                                                    <option value="" disabled>Выберите дату</option>
                                                </template>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div v-if="selectedNotary !== null && selectedSubcategory !== null" class="col-lg-12">
                                        <fieldset>
                                            <p class="contact-label back-light">Цена за приём составит: {{ price }}
                                                руб.</p>
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
        let notariesList = [{
            id: 0,
            fio: 'Субботин Валерий Степанович',
            coefficient: 1.25
        },
            {
                id: 1,
                fio: 'Куропаткин Денис Васильевич',
                coefficient: 1
            },
            {
                id: 2,
                fio: 'Артасов Максим Петрович',
                coefficient: 1.5
            },
        ];

        let categoriesList = [{
            id: 0,
            name: 'Удостоверение сделок',
        },
            {
                id: 1,
                name: 'Консультация',
                coefficient: 1
            },
            {
                id: 2,
                name: 'Выдача доверенностей',
            },
        ];
        return {
            notariesList,
            boxData: {},
            price: 5000,
            selectedNotary: null,
            selectedSubcategory: null,
            selectedService: null,
            categoriesList,
            subcategoriesList: '',
            dates: null,
            selectedDate: null,
            times: null,
            selectedTime: null
        }
    },
    methods: {
        getSubcategory(index) {
            if (index === 0) {
                this.subcategoriesList = [{
                    id: 0,
                    name: 'Брачные договоры',
                    price: 2000
                },
                    {
                        id: 1,
                        name: 'Договоры о купля-продажа недвижимости',
                        price: 5000
                    },
                    {
                        id: 2,
                        name: 'Наследственные документы',
                        price: 4500
                    },
                ];
            } else if (index === 1) {

                this.subcategoriesList = [{
                    id: 0,
                    name: 'Вопросы по доверенностям',
                    price: 2000
                },
                    {
                        id: 1,
                        name: 'Вопросы по брачному договору',
                        price: 3500
                    },
                    {
                        id: 2,
                        name: 'Вопросы по договорам о купле-продаже недвижимости',
                        price: 6500
                    },
                ];

            } else if (index === 2) {
                this.subcategoriesList = [{
                    id: 0,
                    name: 'Выдача общей доверенности',
                    price: 5000
                },
                    {
                        id: 1,
                        name: 'Выдача специальной доверенности',
                        price: 6000
                    },
                    {
                        id: 2,
                        name: 'Выдача разовой довереннсоти',
                        price: 3500
                    },
                ];
            }
            console.log(this.subcategoriesList)
            /*axios.get(URL + this.currentCurrency)
                .then(response => {
                    this.Data = response.data;
                })
                .catch(e => {
                    this.errors.push(e)
                })*/
        },
        selectNotary(index) {
            console.log(this.notariesList.find(x => x.id === index));
            this.updatePrice();
        },
        selectCategory(index) {
            console.log(this.categoriesList.find(x => x.id === index));
            this.getSubcategory(index);
            this.updatePrice();

        },
        selectSubCategory(index) {
            console.log(this.subcategoriesList.find(x => x.id === index));

            this.dates = [
                {
                    value: '24 авг 2021',
                    times: ['13:00', '14:00', '16:00']
                }, {
                    value: '25 авг 2021',
                    times: ['11:00', '12:00', '16:00']
                }, {
                    value: '26 авг 2021',
                    times: ['16:00', '18:00', '20:00']
                }
            ]
            this.updatePrice();
        },
        selectDate(index) {
            console.log(this.selectDate)
            this.times = this.dates.find(x => x.value === index).times;
            console.log(this.times)
        },
        selectTime(index) {
            console.log(this.selectedTime)
        },
        updatePrice() {
            if (this.selectedNotary !== null && this.selectedSubcategory !== null) {
                let coeff = parseFloat(this.notariesList.find(x => x.id === this.selectedNotary).coefficient);
                this.price = parseFloat(this.subcategoriesList.find(x => x.id === this.selectedSubcategory).price) * coeff;
            }
        }
    }
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
    background-color: #fdf8f8;
    font-weight: bold;
}
</style>
