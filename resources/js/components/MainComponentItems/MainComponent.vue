<template>
    <div>
        <main-banner-component></main-banner-component>
        <main-content-component></main-content-component>
        <main-awards-component></main-awards-component>
        <main-stats-component></main-stats-component>
    </div>
</template>

<script>
import MainBannerComponent from "./MainBannerComponent";
import MainContentComponent from "./MainContentComponent";
import MainAwardsComponent from "./MainAwardsComponent";
import MainStatsComponent from "./MainStatsComponent";

export default {
    name: "MainComponent",
    components: {MainBannerComponent, MainContentComponent, MainAwardsComponent, MainStatsComponent},
    mounted() {
        window.scrollTo(0, 0)
    }
}
</script>

<style scoped>

</style>
