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
                                        <input type="text" v-model="filter.fio" class="style-input" v-on:keyup.enter="searchNotary">
                                        <button type="button" class="btn btn-primary" @click.prevent="searchNotary"
                                               ><h6>Поиск</h6></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="loading" class="row mt-5">
                            <p>Загрузка...</p>
                        </div>
                        <div v-else-if="notaries.length > 0" class="row">
                            <template v-for="notary in notaries">
                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                    <div class="card h-100 border-0 rounded">
                                        <div class="card-img-top">
                                            <div class="image-view">
                                            <img :src="notary.photo"
                                                 class="img-fluid mx-auto d-block rounded" alt="Card image cap">
                                            <h2 class="text-image-view">
                                                <span v-if="visible" class="image-span">
                                                    {{ notary.description }}
                                                </span>
                                                <span v-if="isAdmin" class="text-span float-right">
                                                    <button
                                                        class="action-button"
                                                        @click="sweetAlert(notary.id)"><i class="fas fa-trash-alt"></i>
                                                    </button>
                                                    <button
                                                        class="action-button"
                                                        @click="edit(notary.id)"><i class="fas fa-pen-alt"></i>
                                                    </button>
                                                </span>
                                            </h2>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                            <h4 class="card-title">
                                                <router-link v-if="isAdmin" :to="{name: 'notaries-item', params: { id: notary.id }}"
                                                   class="font-weight-bold text-dark small">{{ notary.fio }}</router-link>
                                                <router-link v-else-if="isAuthorized" :to="{name: 'create-order'}"
                                                             class="font-weight-bold text-dark small">{{ notary.fio }}</router-link>
                                                <router-link v-else :to="{name: 'login'}"
                                                             class="font-weight-bold text-dark small">{{ notary.fio }}</router-link>
                                                <br>
                                                <h6 class="mt-2">{{ notary.office_address }}</h6>
                                            </h4>
                                            <h5 class="card-price text-primary">
                                                <h6 class="font-italic">{{ notary.qualification_name }}</h6>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div v-else class="row padding-fix">
                            <p>По Вашему запросу не нашлось нотариусов</p>
                        </div>
                        <div v-if="notaries.length >= 3" class="row sorting mb-5 mt-5">
                            <div class="col-12">
                                <a class="btn btn-light" @click="scrollUp()">
                                    <i class="fas fa-arrow-up mr-2"></i>Наверх</a>
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
                                id="qualification"
                                v-model="select_qualif"
                                @change="searchNotary()">
                            <option value="all" selected>Все квалификации</option>
                            <option v-for="item in qualifications" :value="item.id" >
                                {{ item.name }}
                            </option>
                        </select>
                        <div v-if="show">
                            <hr>
                            <h5 class="font-weight-bold text-dark">Коэффициенты квалификаций</h5>
                            <h5>Средняя: цена услуги</h5>
                            <br>
                            <h5>Высшая: цена услуги <span class="text-primary">* 1,25</span></h5>
                            <br>
                            <h5>Наивысшая: цена услуги <span class="text-primary">* 1,5</span></h5></div>
                        </div>
                    <div class="mb-5">
                        <a href="#" class="btn btn-lg btn-block btn-primary mt-5 mb-2" @click.prevent="showClue">{{message}}</a>
                        <router-link v-if="isAdmin" :to="{name: 'notaries-create'}" class="btn btn-lg btn-block action-button mt-2" >Создать нотариуса</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";
import {eventBus} from "../../app";

export default {

    data() {
        let qualifications = [ ];
        let notaries = [];
        let filter = {
            fio: '',
            qualification_id: ''
        }
        return {
            qualifications,
            show: false,
            message: 'Показать подсказку',
            visible: false,
            notaries,
            select_qualif: 'all',
            search_query: '',
            loading: true,
            filter,
            updateNav: null,
            isAdmin: false,
            isAuthorized: false
        }
    },
    methods: {
        scrollUp() {
            window.scrollTo(0, 0)
        },
        showByQuery(){
            if (this.$route.query.fio) {
                this.filter.fio = this.$route.query.fio
            }
            if (this.$route.query.qualification_id) {
                this.filter.qualification_id = this.$route.query.qualification_id
            }
            axios.get('/api/v1/notaries', {
                params: {
                    "search-fio": this.filter.fio,
                    "qualification-id": this.filter.qualification_id
                }
            })
            .then(response => {
                this.notaries = response.data.notaries;
                this.loading = false;
            })
            .catch(error => {
                return error
            })
        },
        searchNotary: function () {
                if (this.select_qualif !== 'all') {
                    this.filter.qualification_id = this.select_qualif
                } else {
                    this.filter.qualification_id = null
                }
                if (this.filter.fio && !this.filter.qualification_id) {
                    this.$router.replace({query: {'fio': this.filter.fio}})
                }
                else if (this.filter.qualification_id && !this.filter.fio) {
                    this.$router.replace({query: {'qualification_id': this.filter.qualification_id}})
                }
                else if (this.filter.fio && this.filter.qualification_id) {
                    this.$router.replace({query: {'fio': this.filter.fio ,'qualification_id': this.filter.qualification_id}})
                }
                else this.$router.replace({'query': null});

        },
        showClue() {
            this.show = !this.show;
            if (this.show) {
                this.message = 'Скрыть подсказку';
            }
            else {
                this.message = 'Показать подсказку';
            }
        },sweetAlert(index) {
            Swal.fire({
                title: 'Вы уверены?',
                text: 'Вы не сможете восстановить нотариуса после удаления',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Да!',
                cancelButtonText: 'Нет, пусть живет',
                showCloseButton: true,
                showLoaderOnConfirm: true
            }).then((result) => {
                if(result.value) {
                    axios.delete('/api/v1/notaries/' + index).then(response => {
                        axios.get('/api/v1/notaries').then(response => {
                            this.notaries = response.data.notaries;
                            Swal.fire('Удалено!', 'Ух-ты! Вы успешно удалили нотариуса', 'success')
                        });
                    }).catch(function (error) {
                        if (error.response) {
                            Swal.fire({
                                title: 'Ошибка',
                                text: 'Невозможно удалить нотариуса по техническим причинам',
                                icon: 'error',
                                confirmButtonText: 'Ок'
                            });
                        }
                    });
                } else {
                    Swal.fire('Хммм...', 'Вы не стали удалять нотариуса, он благодарен Вам', 'info')
                }
            })
        },
        edit(index) {
            this.$router.push({name: 'notaries-item', params: { id: index }})
        }
    },
    created() {
        axios.get(`/api/v1/qualifications/select`).then(response => {
            this.qualifications = response.data.qualifications;
        }).catch(function (error) {
            if (error.response) {
                Swal.fire({
                    title: 'Ошибка',
                    text: 'Невозможно загрузить квалификации',
                    icon: 'error',
                    confirmButtonText: 'Ок'
                });
            }
        });
        this.showByQuery();

        if (this.$cookies.get('role') === 'admin') {
            this.isAuthorized = true;
            this.isAdmin = true;
        }
        else if (this.$cookies.get('role') === 'user') {
            this.isAuthorized = true;
        }
        eventBus.$on('logout', data => {
            this.isAuthorized = false;
            this.isAdmin = false;
        })
    },

    mounted() {
        window.scrollTo(0, 0)
    },
    watch: {
        '$route.query.fio'(newVal, oldVal) {
            if (newVal !== oldVal) {
                this.filter.fio = this.$route.query.fio
                this.showByQuery()
            }
        },
        '$route.query.qualification_id'(newVal, oldVal) {
            if (newVal !== oldVal) {
                this.filter.qualification_id = this.$route.query.qualification_id
                this.showByQuery()
            }
        }
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

.text-span {
    font-size: 15px;
    font-weight: 300;
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

.action-button {
    background-color: #71bff3;
    color: #317aa4;
    border: 2px solid #ffffff;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: 700;
    padding: 5px 10px;
    border-radius: 30px;
    display: inline-block;
    transition: all 0.3s;
}

.action-button:hover {
    background-color: #71bff3;
    color: #317aa4;
    border: 2px solid #317aa4;

}

.padding-fix {
    padding-top: 30px
}

</style>
