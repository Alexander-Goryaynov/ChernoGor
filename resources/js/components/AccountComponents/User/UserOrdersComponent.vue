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
                                                @change="sortByOption(selected)"
                                                v-model="selected">
                                            <option v-for="item in select_options" :key="item.value" :value="item.value"
                                                    :selected="item.value === 'по дате'">{{ item.value }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <a v-if="sortState" @click.prevent="sortUp()" href="#" >
                                            <i class="fas fa-angle-double-up fa-lg up"></i> (по возр)
                                        </a>

                                        <a v-else href="#" class="down" @click.prevent="sortDown()">
                                            <i class="fas fa-angle-double-down fa-lg down"></i> (по убыв)
                                        </a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr class="table-info">
                            <th>#</th>
                            <th>Дата создания заказа</th>
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
                        <tr v-for="order in orders">
                            <td>{{ order.id }}</td>
                            <td>{{ order.created_at }}</td>
                            <td>{{ order.subcategory_name }}</td>
                            <td>{{ order.notary_fio }}</td>
                            <td>{{ order.address }}</td>
                            <td>{{ order.consultation_datetime }}</td>
                            <td>{{ order.price }}</td>
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
                value: 'по дате'
            },
            {
                value: 'по статусу'
            },
            {
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

        const orders = [
            {
                id: 1,
                user_email: "somebody@once.toldme", // для админа
                created_at: "12 июн 2020 5:35", // для админа
                subcategory_name: "Брачный договор",
                notary_fio: "Колесников Варлаам Кириллович",
                address: "ул. Неоновая, 34 Б",
                consultation_datetime: "14 июн 2020 10:00",
                price: 5200,
                status: "processing"  // enum
            },
            {
                id: 2,
                user_email: "somebody@once.toldme", // для админа
                created_at: "16 июн 2020 5:35", // для админа
                subcategory_name: "Договор о купле-продаже непдвижимости",
                notary_fio: "Субботин Валерий Степанович",
                address: "ул. Трамвайная, 36 Б",
                consultation_datetime: "18 июн 2020 10:00",
                price: 7200,
                status: "canceled"  // enum
            },
            {
                id: 3,
                user_email: "somebody@once.toldme", // для админа
                created_at: "17 июн 2020 5:35", // для админа
                subcategory_name: "Выдача общей доверенности",
                notary_fio: "Булкин Даниил Викторович",
                address: "ул. Унылова, 25 Б ",
                consultation_datetime: "19 июн 2020 10:00",
                price: 8200,
                status: "finished"  // enum
            },
            // ...
        ]

        return {
            select_options,
            selected: 'по дате',
            orders,
            statuses,
            sortState: true
        }
    },
    methods: {
        sortByOption(index) {
            if (index === 'по дате') {
                //sortByDate
                console.log(index)
            } else if (index === 'по статусу') {
                //sortByStatus
                console.log(index)

            } else if (index === 'по цене') {
                //sortByPrice
                console.log(index)

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
            this.sortState = ! this.sortState
            console.log('up')
        },
        sortDown() {
            this.sortState = ! this.sortState
            console.log('down')
        },
        cancel(id) {
            this.orders.find(x => x.id === id).status = 'canceled';
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
