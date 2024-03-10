<template>
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Vehicle Information</h1>

        <!-- Search Box -->
        <div class="mb-6">
            <input
                type="text"
                v-model="searchQuery"
                placeholder="Search for features..."
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition-shadow shadow-lg"
            />
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
                <tbody>
                <tr
                    v-for="(item, key) in filteredData"
                    :key="key"
                    v-if="item.value"
                    class="border-b"
                >
                    <td class="text-left px-4 py-2 font-medium text-gray-600">
                        {{ formatKey(key) }}
                    </td>
                    <td class="text-left px-4 py-2 font-medium text-gray-800">
                        {{ item.value }}
                        <span v-if="item.unit" class="text-gray-600">{{ item.unit }}</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: 'VehicleInfoComponent',
    data() {
        return {
            searchQuery: '', // Modelo para el input del buscador
        };
    },
    computed: {
        vinData() {
            // Acceder a los datos VIN desde el store de Vuex
            return this.$store.state.vinData;
        },
        filteredData() {
            // Filtra los datos VIN basándose en la consulta de búsqueda
            const normalizedSearchQuery = this.searchQuery.toLowerCase();
            return this.searchQuery
                ? Object.fromEntries(
                    Object.entries(this.vinData).filter(([key, value]) =>
                        key.toLowerCase().includes(normalizedSearchQuery)
                    )
                )
                : this.vinData;
        },
    },
    methods: {
        formatKey(key) {
            // Formatea la clave para mostrarla como título. Ejemplo: "ABS_Brakes" se convierte en "ABS Brakes"
            return key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
        },
    },
};
</script>

<style>
/* Puedes añadir estilos globales o específicos aquí si es necesario */
</style>
