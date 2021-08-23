<template>
    <div class="show">
        <the-navbar></the-navbar>
        <div>
            <router-view></router-view>  <!-- Отображение вставленного компонента через роутер-->
        </div>
        <the-footer></the-footer>
    </div>
</template>

<script>

import TheNavbar from "./components/TheNavbar";
import TheFooter from "./components/TheFooter";

export default {
    data() {
        return {
        }
    },
    created() {
    },
    methods: {},
    components: { TheNavbar, TheFooter }
}
</script>

<style scoped>
    .show {
    }
</style>
