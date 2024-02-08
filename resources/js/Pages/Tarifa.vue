<template>
    <CustomHeader :width="25" />
    <div class="bg-gray-200 pb-6">
        <div class="p-3 relative rounded-xl bg-white mx-3 z-40 min-h-screen">
            <div>
                <div
                    class="text-black text-left font-bold text-2xl sm:text-2xl md:text-3xl xl:text-3xl my-6"
                >
                    Busqueda de Tarifas de Seguros
                </div>
            </div>
            <div
                class="p-3 px-5 sm:px-5 md:px-5 xl:px-5 bg-slate-100 rounded-xl border-2 border-gray-300 mb-4 max-w-4xl mx-auto"
            >
                <div class="flex-1 flex-col lg:items-center">
                    <SearchInput 
                        v-model="typeTarifa"
                        @SubmitEvent="submit"
                    />
                </div>
                <CustomTable 
                :data="filteredTarifas"
                :isVisible="filteredTarifas.length"    
                />
            </div>
            <CustomDropodown/>
        </div>
    </div>
    <Footer class="fixed inset-y-0" />
</template>

<script>
import SearchInput from "../components/SearchInput.vue";
import CustomButton from "../components/CustomButton.vue";
import CustomHeader from "../components/CustomHeader.vue";
import CustomTable from "../components/CustomTable.vue";
import CustomDropodown from "../components/CustomDropodown.vue";
import Footer from "../components/Footer.vue";
import SquareButton from "../components/squareButton.vue";
import EditTarifa from "./EditTarifa.vue";
import axios from 'axios';

export default {
    name: "Tarifa",
    components: {
        CustomButton,
        SearchInput,
        CustomHeader,
        CustomTable,
        Footer,
        SquareButton,
        EditTarifa,
        CustomDropodown
    },
    data() {
        return{
            prices:[],
            typeTarifa:"",
            filteredTarifas:[],
        }
    },
    mounted() {
        this.getPrices();
    },
    methods: {
        async submit() {
            if(!this.typeTarifa)
                return
            this.filterTarifa()
        },
        async getPrices() {
            try {
                const response =  await axios.get('/api/V1/prices');
                this.prices = response.data;
            } catch (error) {
                console.error('Error al obtener los precios:', error);
            }
        },
        filterTarifa() {
            const searchText = this.typeTarifa?.toLowerCase();
            this.filteredTarifas =  this.prices.filter(price =>
                price?.tipoDeVehiculo?.toLowerCase().includes(searchText)
            );
        },
        
    },
    computed:{
    },
};
</script>

<style></style>
