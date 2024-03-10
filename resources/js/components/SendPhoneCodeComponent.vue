<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 p-4">
        <div class="w-full max-w-md mx-auto bg-white p-8 rounded-lg shadow">
            <div class="link-container">
                <router-link to="/validate-phone-code" class="text-sm text-red-500 hover:text-red-400">Validate phone code</router-link>
            </div>
            <h2 class="text-2xl text-center font-bold mb-6">Send Phone Code</h2>
            <form @submit.prevent="sendCode" class="space-y-4">
                <div class="flex space-x-4">
                    <div class="flex-1">
                        <label for="phone_code" class="block text-sm font-medium text-gray-700">Phone Code</label>
                        <select id="phone_code" v-model="phoneData.phone_code" required class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-red-500 focus:ring focus:ring-red-200">
                            <option value="+57">+57 Colombia</option>
                            <option value="+1">+1 USA</option>
                            <!-- Add more options here -->
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input id="phone" type="text" v-model="phoneData.phone" placeholder="Phone Number" required class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-red-500 focus:ring focus:ring-red-200" />
                    </div>
                </div>
                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition-colors duration-300">Send Code</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SendPhoneCodeComponent',
    data() {
        return {
            phoneData: {
                phone: '',
                phone_code: ''
            }
        };
    },
    methods: {
        async sendCode() {
            try {
                await this.$store.dispatch('sendPhoneCode', this.phoneData);
                this.$router.push('/validate-phone-code');
            } catch (error) {
                console.error('Error sending code:', error);
            }
        }
    }
};
</script>
