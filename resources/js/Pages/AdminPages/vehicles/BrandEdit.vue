<template>
    <div>
        <div>
           <CustomInput
                :labelName="'Marca'"
           />
        </div>
        <div class="p-6 mt-4 rounded-md border border-slate-200">
            <div class=" bb-2 mx-12">
                <custom-button :Text="Agregar" @click=" showModal = true"/>
            </div>
            <div v-if="showModal">
                <CustomInput
                    :labelName="'Modelos'"
                />
            </div>
            <CustomTable
                :headers="tableHeaders"
                :data="paginatedData"
                :isVisible="true"
                :withOption="false"
                @edit-item="''"
            >
            </CustomTable>
            <Pagination
                :data="tableCells"
                @starIndex="onStarIndex"
                @endIndex="onEndIndex"
            />
        </div>
    </div>
</template>

<script>
import CustomTable from '../../../components/CustomTable.vue';
import Pagination from '../../../components/Pagination.vue';
import CustomInput from "../../../components/CustomInput.vue";
import CustomButton from '../../../components/CustomButton.vue';

export default {
    name: "BrandEdit",
    components: {
        CustomTable,
        Pagination,
        CustomInput,
        CustomButton
    },
    props:{
        data: Object,
        
    },
    data(){
        return{
            tableHeaders: ["id", "Modelos"],
            paginatedItems: [],
            starIndex: 0,
            endIndex: 5,
            showModal: false,
            search: " ",
        }
    },
    methods:{
        onStarIndex(starIndex) {
            this.starIndex = starIndex;
        },
        onEndIndex(endIndex) {
            this.endIndex = endIndex;
        },
    },
    computed:{
        tableCells() {
            return this.data.map((item) => ({
                id: item.id,
                marca: item.nombre,
            }));
        },
        paginatedData() {
            return this.tableCells.slice(this.starIndex, this.endIndex);
        },
    }
};
</script>

<style></style>
