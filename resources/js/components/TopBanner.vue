<template>
    <div class="bg-white px-4 py-3 shadow-md">
        <nav class="container mx-auto flex justify-between items-center">
            <router-link to="/" class="text-lg font-semibold">VIN <span class="text-red-500">Validate</span></router-link>
            <div class="space-x-4">
                <button v-if="isLoggedIn" @click="logout" class="text-gray-600 hover:text-red-500">Logout</button>
                <router-link v-if="!isLoggedIn && $route.name === 'register'" to="/login" class="text-gray-600 hover:text-red-500">Sign In</router-link>
                <router-link v-if="!isLoggedIn && $route.name !== 'register'" to="/register" class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600">Sign Up</router-link>
            </div>
            <!-- Mobile Menu Button -->
            <button @click="toggle" class="md:hidden flex items-center px-3 py-2 border rounded text-gray-600 border-gray-600">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </button>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'TopBanner',
    data() {
        return {
            isOpen: false,
        };
    },
    computed: {
        isLoggedIn() {
            return this.$store.state.user !== null && this.$store.state.token !== null;
        }
    },
    methods: {
        async logout() {
            try {
                await this.$store.dispatch('logout');
                // Si el logout es exitoso, redirige a la página de login
                this.$router.push('/login');
            } catch (error) {
                console.error('Error logging out:', error);
            }
        },
        toggle() {
            this.isOpen = !this.isOpen;
        },
    },
};
</script>
