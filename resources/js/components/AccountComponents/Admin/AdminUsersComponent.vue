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
                                                @change="sortByOption(sortType)"
                                                v-model="sortType">
                                            <option v-for="item in select_options" :key="item.value" :value="item.value"
                                                    :selected="item.value === sortType">{{ item.value }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
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
                        <tr v-for="account in accounts" :key="account.id">
                            <td>{{ account.email }}</td>
                            <td>{{ account.name }}</td>
                            <td>{{ account.created_at }}</td>
                            <td>{{ account.orders_count }}</td>
                            <td>{{ account.average_sum }} рублей</td>
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
                name: 'last_ordered_at',
                value: 'по дате посл. заказа'
            },
            {
                name: 'orders_count',
                value: 'по количеству заказов'
            },
            {
                name: 'average_sum',
                value: 'по ср. стоимости'
            }
        ];

        const accounts = []


        return {
            select_options,
            sortType: 'по количеству заказов',
            accounts,
            sortState: 'asc'
        }
    },
    methods: {
        sortByOption() {
            if (this.sortType === 'по дате посл. заказа') {
                this.$router.replace({query: {'sort': 'last_ordered_at'}})
            } else if (this.sortType === 'по количеству заказов') {
                this.$router.replace({query: {'sort': 'orders_count'}})
            } else if (this.sortType === 'по ср. стоимости') {
                this.$router.replace({query: {'sort': 'average_sum'}})
            }
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
            this.getUsers();
        },
        showByQuery() {
            if (this.$route.query.sort) {
                let routeName = this.select_options.find((x) => x.name === this.$route.query.sort)
                this.sortType = routeName.value
                this.getUsers(routeName.name);
            }
            else this.getUsers();
        },
        getUsers(sortType = 'orders_count') {
            axios.get(`/api/v1/accounts?sort=${sortType}:${this.sortState}`).then(response => {
                this.accounts = response.data.accounts;
                console.log(response.data);
            }).catch(error => {
                console.log(this.error)
            })
        },
    }, 
    watch: {
        '$route.query.sort'(newVal, oldVal) {
            if (newVal !== oldVal) {
                this.sortType = this.select_options.find((x) => x.name === this.$route.query.sort).value
                this.showByQuery()
            }
        }
    },
    created() {
            this.showByQuery();
    }, 
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
