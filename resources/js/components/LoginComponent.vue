<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 p-4">
        <div class="w-full max-w-md mx-auto bg-white p-8 rounded-lg shadow">
            <div class="link-container">
                <router-link to="/send-phone-code" class="text-sm text-red-500 hover:text-red-400">Send phone validation code</router-link>
            </div>
            <br>
            <h2 class="text-2xl text-center font-bold mb-1">Login to your account</h2>
            <br>
            <form @submit.prevent="login" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input
                        id="email"
                        type="email"
                        v-model="credentials.email"
                        placeholder="Email"
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring focus:ring-red-200"
                        required
                    />
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input
                        id="password"
                        type="password"
                        v-model="credentials.password"
                        placeholder="Password"
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:border-red-500 focus:ring focus:ring-red-200"
                        required
                    />
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition-colors duration-300">Login</button>
                    <router-link to="/validate-phone-code" class="text-sm text-red-500 hover:text-red-400">Validate phone code</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: 'LoginComponent',
    data() {
        return {
            credentials: {
                email: '',
                password: ''
            }
        };
    },
    methods: {
        async login() {
            try {
                await this.$store.dispatch('loginUser', this.credentials);
                // Redirigir a la ruta de inicio después del inicio de sesión exitoso
                this.$router.push('/');
            } catch (error) {
                console.error('Error logging in:', error);
            }
        }
    }
};
</script>

<style>

</style>
