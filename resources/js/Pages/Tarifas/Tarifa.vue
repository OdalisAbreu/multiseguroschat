<template>
    <section class="w-full h-full pb-8">
        <div>
            <Nav :routeName="'Administrador'" class="fixed" />
        </div>
        <Sider />
    </section>
    <div class="bg-gray-200 pb-6">
        <div class="w-screen flex flex-col justify-center items-center pt-20">
            <div>
                <div class="text-black text-left font-bold text-2xl sm:text-2xl md:text-3xl xl:text-3xl my-6">
                    Busqueda de Tarifas de Seguros
                </div>
            </div>
            <div class="p-3 px-5 sm:px-5 md:px-5 xl:px-5 bg-slate-100 rounded-xl border-2 border-gray-300 mb-4 max-w-4xl mx-auto">
                <div class="flex">
                   <CAutoComplete class="w-1/3" 
                        v-model="typeVehicleSearch" 
                        :label="'Tipo de Vehiculo'" 
                        :options="fillDropTypeVehicle" 
                    />
                   <CAutoComplete class="w-1/3" 
                        v-model="insurerSearch" 
                        :label="'Aseguradora'" 
                        :options="fillDropInsurers" 
                    />
                    <div class="w-1/3">
                        <CustomButton class="float-rigth" :Text="'Buscar'" @submitButton="filterTarifa" />
                    </div>

                </div>
                <CustomTable :headers="tableHeaders" :data="paginatedData" :isVisible="filteredTarifas.length != 0"
                    :withOption="true" @edit-item="handleEditItem">
                </CustomTable>
                <Pagination :data="tableCells" @starIndex="onStarIndex" @endIndex="onEndIndex" />
            </div>
            <CustomModal v-if="showModal" :headerTitle="'Editar Servicio'" @closed-modal="showModal = false">
                <ActionMessage v-if="editSuccess" on>
                    Se edito Correctamente
                </ActionMessage>
                <template v-slot:body>
                    <EditFormTarifa :data="itemToEdit[0]"/>
                </template>
                <template v-slot:footer>
                    <CustomButton :Text="'Editar'" @click="editForm" />
                    <CustomButton :Text="'Cerrar'" @click="showModal = false" />
                </template>
            </CustomModal>
        </div>
    </div>
    <Footer/>
</template>

<script>
import CustomButton from "../../components/CustomButton.vue";
import CustomHeader from "../../components/CustomHeader.vue";
import CustomTable from "../../components/CustomTable.vue";
import Footer from "../../components/Footer.vue";
import Pagination from '../../components/Pagination.vue';
import CustomModal from "../../components/CustomModal.vue";
import EditFormTarifa from "./EditFormTarifa.vue";
import CAutoComplete from "../../components/shared/CAutoComplete.vue";
import swal from 'sweetalert';
import axios from "axios";
import Nav from "../../components/Nav.vue";
import Sider from "../../Components/Sider.vue";

export default {
    name: "Tarifa",
    components: {
        CustomButton,
        CustomHeader,
        CustomTable,
        Footer,
        Pagination,
        CustomModal,
        EditFormTarifa,
        CAutoComplete,
        CustomButton,
        Nav,
        Sider
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
            itemIdToEdit: "",
            editSuccess:false
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
                this.filteredTarifas = this.prices;
            } catch (error) {
                console.error("Error al obtener los precios:", error);
            }
        },
        async editForm() {

            console.log(this.itemToEdit[0])
            try {
                const {data} = await axios.put(`/api/V1/prices/${this.itemIdToEdit}`, this.itemToEdit[0])
                if(data.success){
                    swal("Exelente","Se editó correctamente", "success");
                }
                this.showModal = false
            } catch (error) {
                console.log(error.response)
                swal('Error',"No se puedo editar el registro", "error");
            }
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
        logout() {
            this.$inertia.post(route('logout'));
        },
    },
    computed: {
        fillDropTypeVehicle() {
            const typesVehicles = this.prices.filter((obj, index, self) =>
                self.findIndex(o => o.tipoDeVehiculo === obj.tipoDeVehiculo) === index)
                .map((obj) => ({value:obj.tipoDeVehiculo , text:obj.tipoDeVehiculo}));
            return typesVehicles;
        },
        fillDropInsurers() {
            const insurers = this.prices.filter((obj, index, self) =>
                self.findIndex(o => o.aseguradora === obj.aseguradora) === index)
                .map((obj) => ({value:obj.aseguradora, text:obj.aseguradora}));
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
                state: item.state == 'si'? 'activo' : 'inactivo'
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
