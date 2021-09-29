<template>
    <div>
        <div class="page-heading" id="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-style">Заказы пользователя</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="table-responsive-sm table-responsive-md">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8"><h2>Список <b>заказов</b></h2></div>
                            <div class="col-sm-4">
                                <div class="row mb-3">
                                    <div class="col-lg-3 pt-1">Сортировка:</div>
                                    <div class="col-lg-5">
                                        <select class="form-control rounded-select"
                                                name="sortOrders"
                                                id="sortOrders"
                                                @change="sortByOption(sortType)"
                                                v-model="sortType">
                                            <option v-for="item in select_options" :key="item.name" :value="item.value"
                                                    :selected="item.value === sortType">{{ item.value }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <a v-if="sortState === 'asc'" @click.prevent="sortUp()" href="#" >
                                            <i class="fas fa-angle-double-up fa-lg up"></i> (по возр)
                                        </a>

                                        <a v-else href="#" class="down" @click.prevent="sortUp()">
                                            <i class="fas fa-angle-double-down fa-lg down"></i> (по убыв)
                                        </a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table v-if="orders" class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr class="table-info">
                            <th>#</th>
                            <th>Подкатегория</th>
                            <th>Нотариус</th>
                            <th>Адрес</th>
                            <th>Дата приёма</th>
                            <th>Цена</th>
                            <th>Статус заявки</th>
                            <th style="width: 8.33%">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="order in orders" :key="order.id">
                            <td>{{ order.id }}</td>
                            <td>{{ order.subcategory_name }}</td>
                            <td>{{ order.notary_fio }}</td>
                            <td>{{ order.address }}</td>
                            <td>{{ order.consultation_datetime }}</td>
                            <td>{{ order.price }} рублей</td>
                            <td :style="{ color: isActive(order.status) }" class="font-weight-bold">
                                {{ statusValue(order.status) }}
                            </td>
                            <td>
                                <a v-if="order.status === 'processing'" href="#" class="delete" title="" @click.prevent="cancel(order.id)" data-original-title="Delete">
                                    <i style="color: Tomato;" class="far fa-times-circle fa-lg"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div v-else>
                        <h1>Упс... заказов пока нет</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        const select_options = [
            {
                name: 'consultation_datetime',
                value: 'по дате'
            },
            {   name: 'status',
                value: 'по статусу'
            },
            {
                name: 'price',
                value: 'по цене'
            }
        ];

        const statuses = [
            {
                name: 'processing',
                value: 'Выполняется'
            },
            {
                name: 'canceled',
                value: 'Отменён'
            },
            {
                name: 'finished',
                value: 'Выполнен'
            }
        ]

        const orders = []

        return {
            select_options,
            orders,
            statuses,
            sortType: 'по статусу',          
            sortState: 'asc'
        }
    },
    methods: {
        sortByOption() {
            if (this.sortType === 'по дате') {
                this.$router.replace({query: {'sort': 'consultation_datetime'}})
            } else if (this.sortType === 'по статусу') {
                this.$router.replace({query: {'sort': 'status'}})
            } else if (this.sortType === 'по цене') {
                this.$router.replace({query: {'sort': 'price'}})
            }
        },
        isActive(status) {
            if (status === 'processing') {
                return 'orange'
            } else if (status === 'canceled') {
                return 'crimson'
            }
            return 'yellowgreen'
        },
        statusValue(value) {
            return this.statuses.find(x => x.name === value).value;
        },
        sortUp() {
            if (this.sortState === 'asc') {
                 this.sortState = 'desc';
            }
            else {
                this.sortState = 'asc'
            }
            this.getOrders();
        },
        cancel(id) {
           axios.post('/api/v1/orders/' + id + '/cancel').then(response => {
               this.getOrders();
           })
        },
        showByQuery() {
            if (this.$route.query.sort) {
                let routeName = this.select_options.find((x) => x.name === this.$route.query.sort)
                this.sortType = routeName.value
                this.getOrders(routeName.name);
            }
            else this.getOrders();
        },
        getOrders(sortType = 'status') {
            axios.get(`/api/v1/orders?sort=${sortType}:${this.sortState}`).then(response => {
                this.orders = response.data.orders;
            }).catch(error => {
                console.log(this.error)
            })
        }
    },
    created() {
        this.showByQuery();
    }, 
    watch: {
        '$route.query.sort'(newVal, oldVal) {
            if (newVal !== oldVal) {
                this.sortType = this.select_options.find((x) => x.name === this.$route.query.sort).value
                this.showByQuery()
            }
        }
    }
}
</script>

<style scoped>
.text-style {
    text-transform: none !important;
}

.table-style {
    overflow-x: hidden !important;
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

.up {
    padding-top: 10px !important;
    margin-right: 5px !important;
}

.down {
    padding-top: 10px !important;
    margin-right: 5px !important;
}
</style>
