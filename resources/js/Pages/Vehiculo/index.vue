<template>
    

    <div class="px-12 py-8 ml-4 mr-4 mt-10  flex-auto rounded bg-gray-300"> 
        
        <h2 class="text-2xl md:text-3xl text-gray-700 font-bold">Seleccionar:</h2>

        <div class="mt-5 container  flex-auto">
        <select name="selecciona" class="w-72 p-2 mt-4 md:mx-2 bg-white border-2 border-gray-600 box-content rounded-lg">
                <option default>- Tipo -</option>
                <option v-for="tipo in tipos" :key="tipo.vehicleTypeName">{{tipo.vehicleTypeName}}</option>
            </select>

        <select name="selecciona" class="w-72 p-2 mt-4 md:mx-2 bg-white border-2 border-gray-600 box-content rounded-lg" v-model="q">
                <option  v-for="marca in marcas" :key="marca.makeName" v-bind:value="marca.id" >{{marca.makeName}}</option>
            </select>

        <select name="selecciona" class="w-72 p-2 mt-4 md:mx-2 bg-white border-2 border-gray-600 box-content rounded-lg">
                <option default>- Modelo-</option>
                 <option v-for="modelo in modelos"  :key="modelo.id" v-bind:value="modelo.id" >{{modelo.modelName}}</option>
            </select>

        </div>
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

    data(){
        return {q:''
        } 
    },

    watch:{
        q:function(value){
            console.log(value)
        }
    }

}
</script>
