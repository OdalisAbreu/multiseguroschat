<template>
    <CustomHeader :width="25" />
    <div class="bg-gray-200 pb-6">
        <div class="p-3 relative rounded-xl bg-white mx-3 z-40 min-h-screen ">
            <div class="w-36 float-right mr-10">
                <CustomButton :Text="'Cerrar Sesión'" @click="logout" />
            </div>
            <div>
                <div
                    class="text-black text-left font-bold text-2xl sm:text-2xl md:text-3xl xl:text-3xl my-6"
                >
                    Vehiculos
                </div>
            </div>
            <div
                class="p-3 px-5 sm:px-5 md:px-5 xl:px-5 bg-slate-100 rounded-xl border-2 border-gray-300 mb-4 max-w-4xl mx-auto"
            >
                <div class="flex">
                    <CAutoComplete
                        class="w-1/3"
                        v-model="brandSearchId"
                        :label="'Marca'"
                        :options="fillDropBrands"
                    />
                    <div class="w-1/3 flex mt-3 px-10">
                        <CustomButton
                            :Text="'Buscar'"
                            @submitButton="filterVehicle"
                        />
                    </div>
                    <div class="w-1/3 flex mt-3 px-10 float-right">
                        <CustomButton
                            :Text="'Crear'"
                            @submitButton="showCreateModal = true"
                        />
                    </div>
                </div>
                <CustomTable
                    :headers="tableHeaders"
                    :data="paginatedData"
                    :isVisible="filteredVehicles.length != 0"
                    :withOption="true"
                    @edit-item="handleEditItem"
                >
                </CustomTable>
                <Pagination
                    :data="tableCells"
                    @starIndex="onStarIndex"
                    @endIndex="onEndIndex"
                />
            </div>
            <CustomModal
                v-if="showModal"
                :headerTitle="'Editar Marca'"
                @closed-modal="showModal = false"
            >
                <template v-slot:body> 
                    <BrandEdit :data="modelos"></BrandEdit>
                </template>
                <template v-slot:footer>
                    <CustomButton :Text="'Guardar'" @click="editForm" />
                    <CustomButton :Text="'Cerrar'" @click="showModal = false" />
                </template>
            </CustomModal>
            <CustomModal
                v-if="showCreateModal"
                :headerTitle="'Crear Marca'"
                @closed-modal="showCreateModal = false"
            >
                <template v-slot:body> 
                    <BrandCreate/>
                </template>
                <template v-slot:footer>
                    <CustomButton :Text="'Guardar'" @click="editForm" />
                    <CustomButton :Text="'Cerrar'" @click="showCreateModal = false" />
                </template>
            </CustomModal>
        </div>
    </div>
    <Footer />
</template>

<script>
import CustomButton from "../../../components/CustomButton.vue";
import CustomHeader from "../../../components/CustomHeader.vue";
import CustomTable from "../../../components/CustomTable.vue";
import Footer from "../../../components/Footer.vue";
import Pagination from "../../../components/Pagination.vue";
import CustomModal from "../../../components/CustomModal.vue";
import CAutoComplete from "../../../components/shared/CAutoComplete.vue";
import BrandEdit from "./BrandEdit.vue"
import BrandCreate from "./BrandCreate.vue"
import axios from "axios";

export default {
    name: "Vehicles",
    components: {
        CustomButton,
        CustomHeader,
        CustomTable,
        Footer,
        Pagination,
        CustomModal,
        CAutoComplete,
        CustomButton,
        BrandEdit,
        BrandCreate
    },
    data() {
        return {
            prices: [],
            vehicles: [],
            brandSearchId: "",
            modelSearchId: "",
            filteredVehicles: [],
            tableHeaders: ["id", "Marca", "Opciones"],
            paginatedItems: [],
            starIndex: 0,
            endIndex: 10,
            showModal: false,
            showCreateModal: false,
            itemIdToEdit: "",
            marcas: [
                { id: 1, nombre: "Toyota" },
                { id: 2, nombre: "Honda" },
                { id: 3, nombre: "Ford" },
                { id: 4, nombre: "Chevrolet" },
                { id: 5, nombre: "Nissan" },
                { id: 6, nombre: "Volkswagen" },
                { id: 7, nombre: "BMW" },
                { id: 8, nombre: "Mercedes-Benz" },
                { id: 9, nombre: "Audi" },
                { id: 10, nombre: "Hyundai" },
                { id: 11, nombre: "Kia" },
                { id: 12, nombre: "Subaru" },
                { id: 13, nombre: "Mazda" },
                { id: 14, nombre: "Lexus" },
                { id: 15, nombre: "Jeep" },
            ],
            modelos: [
                { id: 1, nombre: "Corolla", idMarca: 1 }, // Toyota
                { id: 2, nombre: "Civic", idMarca: 2 }, // Honda
                { id: 3, nombre: "Focus", idMarca: 3 }, // Ford
                { id: 4, nombre: "Cruze", idMarca: 4 }, // Chevrolet
                { id: 5, nombre: "Sentra", idMarca: 5 }, // Nissan
                { id: 6, nombre: "Golf", idMarca: 6 }, // Volkswagen
                { id: 7, nombre: "Serie 3", idMarca: 7 }, // BMW
                { id: 8, nombre: "Clase C", idMarca: 8 }, // Mercedes-Benz
                { id: 9, nombre: "A3", idMarca: 9 }, // Audi
                { id: 10, nombre: "Elantra", idMarca: 10 }, // Hyundai
                { id: 11, nombre: "Sportage", idMarca: 11 }, // Kia
                { id: 12, nombre: "Outback", idMarca: 12 }, // Subaru
                { id: 13, nombre: "CX-5", idMarca: 13 }, // Mazda
                { id: 14, nombre: "NX", idMarca: 14 }, // Lexus
                { id: 15, nombre: "Wrangler", idMarca: 15 }, // Jeep
            ],
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
                const brands = this.marcas.map((brand) => {
                    const model = this.modelos.find(
                        (model) => model.id === brand.id
                    );
                    if (model) {
                        const marca = {
                            id: brand.id,
                            nombre: brand.nombre,
                            modelo: {
                                id: model.id,
                                nombre: model.nombre,
                            },
                        };
                        return marca;
                    } else {
                        const marca = {
                            id: brand.id,
                            nombre: brand.nombre,
                            modelo: null,
                        };
                        return marca;
                    }
                });
                this.vehicles = brands;
                this.filteredVehicles = brands;
            } catch (error) {
                console.error("Error al obtener los precios:", error);
            }
        },
        async editForm() {
            const { data } = await axios.put(
                `/api/V1/prices/${this.itemIdToEdit}`,
                this.itemToEdit[0]
            );
            if (data.success) {
                this.showModal = false;
            }
        },
        filterVehicle() {
            this.filteredVehicles = this.vehicles.filter(
                (v) =>
                    v?.id === this.brandSearchId ||
                    v?.modelo.id === this.modelSearchId
            );
        },
        onStarIndex(starIndex) {
            this.starIndex = starIndex;
        },
        onEndIndex(endIndex) {
            this.endIndex = endIndex;
        },
        handleEditItem(itemId) {
            this.showModal = true;
            this.itemIdToEdit = itemId;
        },
        logout() {
            this.$inertia.post(route("logout"));
        },
    },
    computed: {
        fillDropBrands() {
            const typesVehicles = this.marcas
                .filter(
                    (obj, index, self) =>
                        self.findIndex((o) => o.id === obj.id) === index
                )
                .map((obj) => ({
                    value: obj.id,
                    text: obj.nombre,
                }));
            return typesVehicles;
        },
        fillDropModels() {
            const models = this.modelos
                .filter((obj) => obj.id === this.brandSearchId)
                .map((obj) => ({
                    value: obj.id,
                    text: obj.nombre,
                }));
            return models;
        },
        tableCells() {
            return this.filteredVehicles.map((item) => ({
                id: item.id,
                marca: item.nombre,
            }));
        },
        paginatedData() {
            return this.tableCells.slice(this.starIndex, this.endIndex);
        },
        itemToEdit() {
            return this.prices.filter((item) => item.id === this.itemIdToEdit);
        },
    },
};
</script>

<style></style>
