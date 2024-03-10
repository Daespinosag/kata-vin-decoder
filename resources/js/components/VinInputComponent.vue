<template>
    <div class="flex flex-col items-center justify-center p-3">
        <div class="flex space-x-4">
            <input
                v-model="vin"
                type="text"
                placeholder="Enter VIN"
                class="p-2 border border-gray-300 rounded"
            >
            <button
                @click="validateVin"
                class="p-2 bg-red-500 text-white rounded hover:bg-red-600"
            >
                Validate VIN
            </button>
        </div>
        <div class="mt-4">
            View Sample Report:
            <span
                class="text-blue-500 cursor-pointer"
                @click="loadSampleVin"
            >
        JNKCA31A3YT124016
      </span>
        </div>
    </div>
</template>

<script>
export default {
    name: 'VinInputComponent',
    data() {
        return {
            vin: '',
        };
    },
    methods: {
        async validateVin() {
            try {
                await this.$store.dispatch('validateVin', {vin_code: this.vin});
                await this.$router.push('/vehicle-information');
            } catch (error) {
                console.error('Validation failed:', error);
            }
        },
        loadSampleVin() {
            this.vin = 'JNKCA31A3YT124016';
            this.validateVin();
        }
    }
}
</script>

<style scoped>
/* Estilos adicionales si se necesitan */
</style>
