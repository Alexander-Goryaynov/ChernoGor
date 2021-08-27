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
                                    <h2 class="float-left">Изменение категории</h2>
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
                                        <div class="col-lg-12">
                                            <fieldset>
                                                <button type="submit" id="form-submit" :disabled="check" @click.prevent="changeCategory()"
                                                        class="border-button">Изменить категорию
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
        let category = {
            id: '',
            name: ''
        };
        return {
            category,
            new_name: '',
        }
    },
    methods: {
        changeCategory() {
            // change category //
            this.show = false;
            this.$router.push('/categories')
        }
    },
    created() {
        const catId = this.$route.params.id;
        this.category = {
            id: this.$route.params.id,
            name: 'Удостоверение сделок'
        }
        this.new_name = this.category.name;
        /*
       axios.get(`/api/v1/categories/${catId}`).then(response => {
           // if (response.data.status === 200)
           this.category = response.data;
           console.log(response);
           // if (response.data.status === 404)
           router.push('/404')
           //
       }); на будущее */
    },
    name: "ServiceItemComponent",
    computed: {
        check() {
            return (this.category.name === this.new_name) || (this.new_name === '');
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
