<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 p-4">
        <div class="w-full max-w-md mx-auto bg-white p-8 rounded-lg shadow">
            <div class="link-container">
                <router-link to="/send-phone-code" class="text-sm text-red-500 hover:text-red-400">Send phone validation code</router-link>
            </div>
            <h2 class="text-2xl text-center font-bold mb-8">Register to your account</h2>
            <form @submit.prevent="submitRegistration" class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input id="name" type="text" v-model="registrationData.name" placeholder="Your Name" required class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-red-500 focus:ring focus:ring-red-200" />
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" type="email" v-model="registrationData.email" placeholder="Email" required class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-red-500 focus:ring focus:ring-red-200" />
                </div>
                <div class="flex space-x-4">
                    <div class="flex-1">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" type="password" v-model="registrationData.password" placeholder="Password" required class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-red-500 focus:ring focus:ring-red-200" />
                    </div>
                    <div class="flex-1">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input id="password_confirmation" type="password" v-model="registrationData.password_confirmation" placeholder="Confirm Password" required class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-red-500 focus:ring focus:ring-red-200" />
                    </div>
                </div>
                <div class="flex space-x-4">
                    <div class="flex-1">
                        <label for="phone_code" class="block text-sm font-medium text-gray-700">Phone Code</label>
                        <select id="phone_code" v-model="registrationData.phone_code" required class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-red-500 focus:ring focus:ring-red-200">
                            <option value="+57">+57 Colombia</option>
                            <option value="+1">+1 USA</option>
                            <!-- Add more options here -->
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input id="phone" type="text" v-model="registrationData.phone" placeholder="Phone Number" required class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-red-500 focus:ring focus:ring-red-200" />
                    </div>
                </div>
                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition-colors duration-300">Register</button>
                <div class="link-container">
                    <router-link to="/validate-phone-code" class="text-sm text-red-500 hover:text-red-400">Validate phone code</router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: 'RegisterComponent',
    data() {
        return {
            registrationData: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                phone: '',
                phone_code: '',
            },
            error: null,
        };
    },
    methods: {
        ...mapActions(['registerUser']),
        async submitRegistration() {
            try {
                await this.registerUser(this.registrationData);
                // Si el registro es exitoso, navegar al componente de validación de código
                await this.$router.push({ name: 'validate-phone-code' });
            } catch (error) {
                console.error('Error registering user:', error);
                this.error = error.message || 'Failed to register user';
            }
        },
    },
};
</script>

<style>
/* Estilos personalizados si es necesario */
</style>
