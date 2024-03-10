<template>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 px-4">
        <!-- Hero section -->
        <div class="flex flex-col lg:flex-row items-center bg-white p-6 lg:p-12 shadow rounded-lg">
            <!-- Contenido textual -->
            <div class="flex-1 space-y-6">
                <h2 class="text-4xl font-bold text-gray-700">The best VIN code validator in the history of the internet !!!</h2>
                <p v-if="!isLoggedIn" class="text-gray-600">We can validate all the codes you need</p>
                <br>
                <router-link v-if="!isLoggedIn" to="/login" class="bg-red-600 text-white py-2 px-4 rounded transition-colors duration-150 hover:bg-red-700 focus:outline-none">Sign In</router-link>
                <vin-input-component v-if="isLoggedIn"></vin-input-component>
            </div>

            <!-- Imagen -->
            <img
                src="../../assets/landing.png"
                alt="Landing Illustration"
                class="flex-1"
            />
        </div>
    </div>
</template>

<script>

import VinInputComponent from "./VinInputComponent.vue";

export default {
    name: 'LandingComponent',
    components : { VinInputComponent },
    computed: {
        isLoggedIn() {
            return this.$store.state.user !== null && this.$store.state.token !== null;
        }
    },
}
</script>

<style scoped>
/* No additional styles needed */
</style>
