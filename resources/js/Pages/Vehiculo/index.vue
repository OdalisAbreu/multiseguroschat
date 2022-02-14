<template>
<div id="app">
    <div class="flex flex-auto bg-blue-500 rounded-b-lg drop-shadow-xl">
            <a class="py-3 p-3 text-xl text-white font-bold md:text-3xl">Multiseguros</a>
        </div>

    <div class="px-12 py-8 ml-4 mr-4 mt-10  flex-auto rounded bg-gray-300"> 
        
        <h2 class="text-2xl md:text-3xl text-gray-700 font-bold">Seleccionar:</h2>

            <form class="mt-5 container  flex-auto">
                <select name="selecciona" class="w-72 p-2 mt-4 md:mx-2 bg-white border-2 border-gray-600 box-content rounded-lg">
                        <option default>- Tipo -</option>
                        <option v-for="tipo in tipos" :key="tipo.vehicleTypeName">{{tipo.vehicleTypeName}}</option>
                    </select>

                <select name="selecciona" class="w-72 p-2 mt-4 md:mx-2 bg-white border-2 border-gray-600 box-content rounded-lg" v-model="q">
                        <option default>- Marca -</option>
                        <option  v-for="marca in marcas" :key="marca.makeName" v-bind:value="marca.id">{{marca.makeName}}</option>
                    </select>

                <select name="selecciona" class="w-72 p-2 mt-4 md:mx-2 bg-white border-2 border-gray-600 box-content rounded-lg">
                        <option default>- Modelo -</option>
                        <option v-for="modelo in modelos"  :key="modelo.id" v-bind:value="modelo.id" >{{modelo.modelName}}</option>
                    </select>

                <input class="w-72 p-2 mt-4 md:mx-2 bg-white border-2 border-gray-600 box-content rounded-lg" type="text" placeholder="Matricula">

                <input class="w-72 p-2 mt-4 md:mx-2 bg-white border-2 border-gray-600 box-content rounded-lg" type="text" placeholder="Placa">

                <input class="w-72 p-2 mt-4 md:mx-2 bg-white border-2 border-gray-600 box-content rounded-lg" type="number" placeholder="Año">
            </form>
                <button class="h-10 py-3 px-5 mt-2 text-white font-bold bg-blue-600 rounded-lg hover:bg-blue-700">Siguiente</button>
    </div>
</div>     
</template>
<script>

import { Head, Link } from '@inertiajs/inertia-vue3';
import { watch } from '@vue/runtime-core';
import Input from '../../Jetstream/Input.vue';


export default {
    name:'app',
    components:{
        Head,
        Link,
       
        
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
