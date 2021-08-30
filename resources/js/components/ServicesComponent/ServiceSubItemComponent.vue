<template>
    <div>
        <!-- Page Content -->
        <div class="page-mini-heading header-text">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>

        <div class="callback-form mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-heading">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <button type="button" @click="$router.push('/categories')"
                                            class="action-button">
                                        <i class="fas fa-backward"></i> Назад
                                    </button>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <h2 class="float-left">Изменение подкатегории</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 offset-md-2">
                            <div class="contact-form">
                                <form id="contact" action="" method="post">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <fieldset>
                                                <input name="name" type="text" v-model="new_name" class="form-control"
                                                       id="name">
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <fieldset>
                                                <input name="price" type="number" v-model="new_price" class="form-control"
                                                       id="price">
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12">
                                            <fieldset>
                                                <button type="submit" id="form-submit" :disabled="check"
                                                        @click.prevent="changeSubCategory()"
                                                        class="border-button">Изменить подкатегорию
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
    </div>
</template>

<script>

export default {
    data() {
        let subcategory = {
            id: '',
            name: '',
            price: ''
        };
        return {
            subcategory,
            new_name: '',
            new_price: '',
        }
    },
    methods: {
        changeSubCategory() {
            // change category //
            this.show = false;
            this.$router.push('/categories')
        }
    },
    created() {
        const subCatId = this.$route.params.id;
        this.subcategory = {
            id: this.$route.params.id,
            name: 'Брачный договор',
            price: 5000
        }
        this.new_name = this.subcategory.name;
        this.new_price = this.subcategory.price;
        /*
       axios.get(`/api/v1/subcategories/${subCatId}`).then(response => {
           // if (response.data.status === 200)
           this.subcategory = response.data;
           console.log(response);
           // if (response.data.status === 404)
           router.push('/404')
           //
       }); на будущее */
    },
    name: "ServiceItemComponent",
    computed: {
        check() {
            const sub_name = (this.subcategory.name === this.new_name) || (this.new_name === '');
            console.log('sub_name ' + sub_name + '\n');
            const sub_price = (this.subcategory.price === this.new_price) || (this.new_price === null) || (this.new_price < 1000);
            console.log('sub_price ' + sub_price + '\n');
            console.log(sub_name && sub_price);
            return (sub_name && sub_price);
        }
    },
    mounted() {
        window.scrollTo(0, 0)
    }
}
</script>

<style scoped>

.action-button {
    background-color: transparent;
    color: #75b3dc;
    border: 2px solid #75b3dc;
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
}

</style>
