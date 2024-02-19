<template>
    <CustomHeader :width="25" />
    <div class="bg-gray-200 pb-6">
        <div class="p-3 relative rounded-xl bg-white mx-3 z-40 min-h-screen">
            <div>
                <div class="text-black text-left font-bold text-2xl sm:text-2xl md:text-3xl xl:text-3xl my-6">
                    Busqueda de Tarifas de Seguros
                </div>
            </div>
            <div
                class="p-3 px-5 sm:px-5 md:px-5 xl:px-5 bg-slate-100 rounded-xl border-2 border-gray-300 mb-4 max-w-4xl mx-auto">
                <div class="flex">
                    <CAutoComplete class="w-1/3" v-model="typeVehicleSearch" :label="'Tipo de Vehiculo'"
                        :items="fillDropTypeVehicle" />
                    <CAutoComplete class="w-1/3" v-model="insurerSearch" :label="'Aseguradora'" :items="fillDropInsurers" />
                    <div class="w-1/3">
                        <CustomButton class="float-rigth" :Text="'Buscar'" @submitButton="filterTarifa" />
                    </div>

                </div>
                <CustomTable :headers="tableHeaders" :data="paginatedData" :isVisible="filteredTarifas.length"
                    :withOption="true" @edit-item="handleEditItem">
                </CustomTable>
                <Pagination :data="tableCells" @starIndex="onStarIndex" @endIndex="onEndIndex" />
            </div>
            <CustomModal v-if="showModal" :headerTitle="'Editar Servicio'" @closed-modal="showModal = false">
                <template v-slot:body>
                    <EditFormTarifa :data="itemToEdit[0]" />
                </template>
                <template v-slot:footer>
                    <CustomButton :Text="'Editar'" @click="editForm" />
                    <CustomButton :Text="'Cerrar'" @click="showModal = false" />
                </template>
            </CustomModal>
        </div>
    </div>
    <Footer class="fixed inset-y-0" />
</template>

<script>
import SearchInput from "../../components/SearchInput.vue";
import CustomButton from "../../components/CustomButton.vue";
import CustomHeader from "../../components/CustomHeader.vue";
import CustomTable from "../../components/CustomTable.vue";
import CustomDropodown from "../../components/CustomDropodown.vue";
import Footer from "../../components/Footer.vue";
import Pagination from '../../components/Pagination.vue';
import CustomModal from "../../components/CustomModal.vue";
import EditFormTarifa from "./EditFormTarifa.vue";
import CAutoComplete from "../../components/shared/CAutoComplete.vue";
import axios from "axios";

export default {
    name: "Tarifa",
    components: {
        CustomButton,
        SearchInput,
        CustomHeader,
        CustomTable,
        Footer,
        CustomDropodown,
        Pagination,
        CustomModal,
        EditFormTarifa,
        CAutoComplete
    },
    data() {
        return {
            prices: [],
            typeVehicleSearch: "",
            insurerSearch: "",
            filteredTarifas: [],
            tableHeaders: ["id", "Nombre", "Aseguradora", "3 Meses", "6 Meses", "12 Meses", "Estado", "Opciones"],
            paginatedItems: [],
            starIndex: 0,
            endIndex: 10,
            showModal: false,
            itemIdToEdit: ""
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
                this.filteredTarifas = this.prices
            } catch (error) {
                console.error("Error al obtener los precios:", error);
            }
        },
        async editForm() {
            const response = await axios.put(`/api/V1/prices/${this.itemIdToEdit}`, this.prices[0])
            console.log(response.data);
        },
        filterTarifa() {
            this.filteredTarifas = this.prices.filter((price) =>
                price?.tipoDeVehiculo.toLowerCase().includes(this.typeVehicleSearch.toLowerCase()) &&
                price?.aseguradora.toLowerCase().includes(this.insurerSearch.toLowerCase())
            );
        },
        onStarIndex(starIndex) {
            this.starIndex = starIndex
        },
        onEndIndex(endIndex) {
            this.endIndex = endIndex
        },
        handleEditItem(itemId) {
            this.showModal = true
            this.itemIdToEdit = itemId
        },
    },
    computed: {
        fillDropTypeVehicle() {
            const typesVehicles = this.prices.filter((obj, index, self) =>
                self.findIndex(o => o.tipoDeVehiculo === obj.tipoDeVehiculo) === index)
                .map((obj) => (obj.tipoDeVehiculo));
            return typesVehicles;
        },
        fillDropInsurers() {
            const insurers = this.prices.filter((obj, index, self) =>
                self.findIndex(o => o.aseguradora === obj.aseguradora) === index)
                .map((obj) => (obj.aseguradora));
            return insurers;
        },
        tableCells() {
            return this.filteredTarifas.map((item) => ({
                id: item.id,
                tipoDeVehiculo: item.tipoDeVehiculo,
                aseguradora: item.aseguradora,
                priceThreeMonths: item.priceThreeMonths,
                priceSixMonths: item.priceSixMonths,
                priceTwelveMonths: item.priceTwelveMonths,
                state: item.state
            }))
        },
        paginatedData() {
            return this.tableCells.slice(this.starIndex, this.endIndex)
        },
        itemToEdit() {
            return this.prices.filter(item => item.id === this.itemIdToEdit)
        }
    },
};
</script>

<style></style>
