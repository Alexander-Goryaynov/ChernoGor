<template>
    <div>
        <div class="page-heading" id="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-style">Пользователи</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="table-responsive-sm table-responsive-md">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6"><h2>Список <b>пользователей</b></h2></div>
                            <div class="col-sm-6">
                                <div class="row mb-3">
                                    <div class="col-lg-4 pt-1 move">Сортировка аккаунтов:</div>
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
                                    <div class="col-lg-3">
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
                            <th>E-mail клиента</th>
                            <th>ФИО</th>
                            <th>Дата регистрации</th>
                            <th>Число заказов</th>
                            <th>Средняя стоимость заказа</th>
                            <th>Дата последнего заказа</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="account in accounts">
                            <td>{{ account.email }}</td>
                            <td>{{ account.name }}</td>
                            <td>{{ account.created_at }}</td>
                            <td>{{ account.orders_count }}</td>
                            <td>{{ account.average_sum }}</td>
                            <td>{{ account.last_ordered_at }}</td>
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
                value: 'по дате посл. заказа'
            },
            {
                value: 'по количеству заказов'
            },
            {
                value: 'по ср. стоимости'
            }
        ];

        const accounts = [
            {
                email: "daenerys@mail.ru",
                name: "Таргариен Дейнерис Эйрисовна",
                created_at: "18 мар 2020 09:50",
                orders_count: 1,
                average_sum: 5000,
                last_ordered_at: "25 авг 2021 10:30 (5 дней назад)"
            },
            {
                email: "whitequeen@mail.ru",
                name: "Белая Королева Подземья",
                created_at: "10 мар 2020 09:50",
                orders_count: 5,
                average_sum: 12000,
                last_ordered_at: "30 авг 2021 13:36 (15 минут назад)"
            },
            {
                email: "dobrynya@mail.ru",
                name: "Добрыня Никитич Богатырь",
                created_at: "16 мар 2020 09:50",
                orders_count: 10,
                average_sum: 10000,
                last_ordered_at: "30 авг 2020 13:20 (30 минут назад назад)"
            },
            // ...
        ]


        return {
            select_options,
            selected: 'по дате посл. заказа',
            accounts,
            sortState: true
        }
    },
    methods: {
        sortByOption(index) {
            if (index === 'по дате посл. заказа') {
                //sortByDate
                console.log(index)
            } else if (index === 'по количеству заказов') {
                //sortByOrderCount
                console.log(index)

            } else if (index === 'по ср. стоимости') {
                //sortByPrice
                console.log(index)

            }
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

.move {
    padding-right: 0.5em;
}
</style>
