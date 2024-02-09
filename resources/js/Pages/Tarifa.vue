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
                <div class="flex">
                    <CustomDropodown
                        class="w-1/3"
                        v-model="typeVehicleSearch"
                        :label="'Tipo de Vehiculo'"
                        :options="fillDropTypeVehicle"
                    />
                    <CustomDropodown
                        class="w-1/3"
                        v-model="insurerSearch"
                        :label="'Aseguradora'"
                        :options="fillDropInsurers"
                    />
                    <div class="w-1/3">

                    </div>
                    <CustomButton 
                    class="float-rigth" 
                    :Text="'Buscar'" 
                    @submitButton="filterTarifa"
                    />
                </div>
                <CustomTable
                    :data="filteredTarifas"
                    :isVisible="filteredTarifas.length"
                />
            </div>
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
import axios from "axios";

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
        CustomDropodown,
    },
    data() {
        return {
            prices: [],
            typeVehicleSearch: "",
            insurerSearch:"",
            filteredTarifas: [],
        };
    },
    mounted() {
        this.getPrices();
    },
    methods: {
        async getPrices() {
            try {
                const response = await axios.get("/api/V1/prices");
                this.prices = response.data;
            } catch (error) {
                console.error("Error al obtener los precios:", error);
            }
        },
        filterTarifa() {
            this.filteredTarifas = this.prices.filter((price) =>
                price?.tipoDeVehiculo?.toLowerCase().includes(this.typeVehicleSearch?.toLowerCase()) &&
                price.aseguradora?.toLowerCase().includes(this.insurerSearch?.toLowerCase())
            );
        },
    },
    computed: {
        fillDropTypeVehicle() {
            const typesVehicles = this.prices.filter((obj, index, self) =>
            self.findIndex(o => o.tipoDeVehiculo === obj.tipoDeVehiculo) === index)
                .map((obj) => ({ value: obj.tipoDeVehiculo }));
            return typesVehicles;
        },
        fillDropInsurers() {
            const insurers = this.prices.filter((obj, index, self) => 
            self.findIndex(o => o.aseguradora === obj.aseguradora) === index)
                .map((obj) => ({ value: obj.aseguradora }));
            return insurers;
        },
    },
};
</script>

<style></style>
