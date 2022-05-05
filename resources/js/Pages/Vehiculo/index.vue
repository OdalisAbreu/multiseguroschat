<template>
    <div class="w-full mb-4 rounded  overflow-x-hidden border-t flex flex-col bg-blue-600 shadow-lg shadow-blue-500/50">
        <div class="p-3">
            <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Multiseguros</a>
        </div>
    </div>
        <div class="mt-5 p-3">
            <div class="text-2xl font-bold sm:text-2xl md:text-3xl xl:text-3xl">Registra los datos de tu vehículo</div>
        </div>

    <div class="p-3 px-5 sm:px-5 md:px-5 xl:px-5">
        <form @submit.prevent="submit">
            <select class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" v-model="form.tipo">
                <option v-for="tipo in tipos" :value="tipo.id" :key="tipo.id">{{tipo.vehicleTypeName}} </option>
            </select>
            <select class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" v-model="marca">
                <option v-for="marca in marcas" :value="marca.id" :key="marca.id">{{marca.makeName}} </option>
            </select>
            <select class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" v-model="form.modelo">
                <option value="0" selected></option>
                <option v-for="modelo in models" :value="modelo.id" :key="modelo.id">{{modelo.modelName}} </option>
            </select>

            <input class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" type="text" placeholder="Año" v-model="form.Año">
            <input class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" type="text" placeholder="Placa" v-model="form.placa">
            <input class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" type="text" placeholder="Chasis" v-model="form.chasis">
                
                <div class="mt-5">
                    <button class="bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50">Continuar</button>
                </div>

        </form>
    </div> 
</template>
<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
import { watch } from '@vue/runtime-core';
export default {
    components:{
        Head,
        Link
    },
    props:{
       tipos: Array,
       marcas: Array,
       modelos: Array,
       token: String,
    },
    methods: {

         modelosMarca: function(){
             this.models = this.modelos.filter(model => model.makeId == 1)
         },

    },
    data(){
        return {
            models: '', 
            marca: '',
            form: {
                tipo:'',
                modelo: '',
                Año: '',
                placa: '',
                chasis: '',
                token: this.token
            }
        }
    },
     mounted(){

    },
    methods:{
        submit(){
            this.$inertia.post(this.route('policy', this.marca), this.form)
        }
    },
    watch: {
             marca: function (value){
             this.models = this.modelos.filter(model => model.makeId == value)
         }

    }
}
</script>
