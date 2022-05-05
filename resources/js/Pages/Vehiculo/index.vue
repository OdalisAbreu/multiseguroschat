<template>
    <div class="w-full mb-4 rounded  overflow-x-hidden border-t flex flex-col bg-blue-600 shadow-lg shadow-blue-500/50">
        <div class="p-3">
            <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Multiseguros</a>
        </div>
    </div>
    <h1>Registra los datos de tu vehículo</h1>

    <form class="px-5" @submit.prevent="submit">
        <select v-model="form.tipo">
            <option v-for="tipo in tipos" :value="tipo.id" :key="tipo.id">{{tipo.vehicleTypeName}} </option>
        </select>
        <br> <br>
        <select v-model="marca">
            <option v-for="marca in marcas" :value="marca.id" :key="marca.id">{{marca.makeName}} </option>
        </select>
        <br> <br>
        <select v-model="form.modelo">
            <option value="0" selected></option>
            <option v-for="modelo in models" :value="modelo.id" :key="modelo.id">{{modelo.modelName}} </option>
        </select>
        <br> <br>
        <input type="text" placeholder="Placa" v-model="form.placa">
        <br> <br>
        <input type="text" placeholder="Chasis" v-model="form.chasis">
        <br> <br>
        <button class="bg-blue-500 py-2 px-4" >Continuar</button>
    </form>
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
       clien_id: String,
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
                placa: '',
                chasis: '',
                token: this.token,
                clien_id: this.clien_id,
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
