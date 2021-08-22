<template>
    <div>
        Hello
        <br>
        <div>
            {{ data_did }}
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            loading: false,
            data_did: ''
        }
    },
    created() {
        axios.defaults.withCredentials = true;
        axios.post('http://localhost:8000/register', {
            name: 'bezumniydid',
            email: 'gor2011@yandex.ru',
            password: '1234ab!555',
            'password_confirmation': '1234ab!555'
        }).then(response2 => {
            this.data_did = response2;
        }, function (error) {
            console.log(error.response.data);
        });
    },
    methods: {},
    components: {}
}
</script>

<style scoped>

</style>
