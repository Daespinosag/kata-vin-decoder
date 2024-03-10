<template>
    <div id="app" class="font-sans">
        <top-banner></top-banner>
        <router-view></router-view>
        <landing-component v-if="$route.path === '/'" ></landing-component>
    </div>
</template>

<script>
import TopBanner from './TopBanner.vue';
import LandingComponent from "./LandingComponent.vue";

export default {
    name: 'App',
    components: {
        TopBanner,
        LandingComponent
    }
};
</script>

<style>
    .link-container {
        display: flex;
        justify-content: flex-end;
    }
</style>
