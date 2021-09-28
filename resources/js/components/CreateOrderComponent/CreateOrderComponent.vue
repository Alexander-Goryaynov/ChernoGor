<template>
    <div>
        <div class="page-heading " id="top">
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
                                            <label for="selectNotary" class="text-white h4 float-left mb-2">
                                                Выбор нотариуса:
                                            </label>
                                            <select class="form-control rounded-select"
                                                    name="selectNotary"
                                                    id="selectNotary"
                                                    @change="selectNotary()"
                                                    v-model="selectedNotary" required>
                                                <option v-for="item in notariesList" :key="item.id + 'notary'" :value="item.id">{{ item.fio }}
                                                </option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <fieldset>
                                            <label for="selectService" class="text-white h4 float-left mb-2">
                                                Выбор типа услуги:
                                            </label>
                                            <select class="form-control rounded-select"
                                                    name="selectService"
                                                    id="selectService"
                                                    @change="selectCategory(selectedService)"
                                                    v-model="selectedService" required>
                                                <template v-if="selectedNotary !== null">
                                                <option v-for="item in categoriesList"  :key="item.id + 'cat'" :value="item.id">{{ item.name }}
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
                                            <label for="selectedSubcategory" class="text-white h4 float-left mb-2">
                                                Выбор подкатегории услуги:
                                            </label>
                                            <select class="form-control rounded-select"
                                                    name="selectedSubcategory"
                                                    id="selectedSubcategory"
                                                    @change="selectSubCategory()"
                                                    v-model="selectedSubcategory" required>
                                                <template v-if="subcategoriesList">
                                                    <option v-for="item in subcategoriesList" :key="item.id + 'subcat'" :value="item.id">{{ item.name }}
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
                                            <label for="selectDate" class="text-white h4 float-left mb-2">
                                                Выбор даты:
                                            </label>
                                            <select class="form-control rounded-select"
                                                    id="selectDate"
                                                    name="selectDate"
                                                    @change="selectDate(selectedDate)"
                                                    v-model="selectedDate" required>
                                                <template v-if="dates">
                                                    <option v-for="item in dates" :selected="!selectedDate" :value="item.value">{{ item.value }}
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
                                            <label for="selectTime" class="text-white h4 float-left mb-2">
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
                                                    <option value="" disabled :selected="!selectedDate">Выберите дату</option>
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
                                            <button type="submit" @click.prevent="makeRequest()" id="form-submit" class="border-button">Создать заявку
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
import Swal from 'sweetalert2'


export default {
    data() {
        let notariesList = [];

        let categoriesList = [];

        return {
            notariesList,
            boxData: {},
            price: 5000,
            selectedNotary: null,
            selectedSubcategory: null,
            selectedService: null,
            categoriesList,
            subcategoriesList: [],
            dates: null,
            selectedDate: null,
            times: null,
            selectedTime: null
        }
    },
    methods: {
        getSubcategory(index) {
            axios.get('api/v1/subcategories/select?category-id=' + index).then(response => {
                this.subcategoriesList = response.data.subcategories;
            })
            .catch(error => {
                return error
            })
        },
        selectNotary() {
            this.uploadDates();
            this.updatePrice();
        },
        selectCategory(index) {
            this.getSubcategory(index);
        },
        selectSubCategory() {
            this.updatePrice();
        },
        uploadDates() {
             axios.get('api/v1/schedule/select?notary-id=' + this.selectedNotary).then(response => {
              this.dates = response.data.dates;
              this.selectedDate = null;
              this.selectedTime = null;
            }).catch (error => {
                console.log('проблема с загрузкой дат')
            })
        },
        selectDate(index) {
            try {
                if (this.dates !== null) {
                    this.times = this.dates.find(x => x.value === index).times;
                }
            }
            catch { }
        },
        selectTime(index) {
            console.log(this.selectedTime)
        },
        updatePrice() {
            if (this.selectedNotary !== null && this.selectedSubcategory !== null) {
                let coeff = parseFloat(this.notariesList.find(x => x.id === this.selectedNotary).coefficient);
                this.price = parseFloat(this.subcategoriesList.find(x => x.id === this.selectedSubcategory).price) * coeff;
            }
        },
        makeRequest() {
           axios.post('api/v1/orders', {
              "notary_id": this.selectedNotary,
              "subcategory_id": this.selectedSubcategory,
              "consultation_date": this.selectedDate,
              "consultation_time":this.selectedTime 
           }).then(response => {
                Swal.fire({
                    title: 'Все хорошо',
                    text: 'Ваша заявка успешно создана',
                    icon: 'success',
                    timer: 1000
                })
                setTimeout(() => this.$router.push({ path: '/'}), 1000);
           }).catch(error => {
                 Swal.fire({
                    title: 'Ошибка',
                    text: 'Что-то пошло не так',
                    icon: 'error',
                    confirmButtonText: 'Ок'
                })
           })
        }
    },
    created() {
        axios.get('/api/v1/notaries/select').then(response => {
            this.notariesList = response.data.notaries;
            axios.get('/api/v1/categories/select').then(response => {
                this.categoriesList = response.data.categories;
            })
            .catch(error => {
                return error
            })
        })
        .catch(error => {
            return error
        })

    },
    mounted() {
        window.scrollTo(0, 0)
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
