<template>
    <div class="w-full mb-2 rounded  overflow-x-hidden border-t flex flex-col bg-black shadow-lg shadow-black-500/50">
        <div class="p-2"> 
           <img class="inline h-12 w-25"  src="/ima/sc2_ic.png" alt="">
        </div>
    </div>
      
    

    <div class="mx-3 mt-8 mb-4 sm:mx-20 lg:mx-20 xl:mx-20">
        <div class=" bg-gray-200 rounded-full">
            <div class="bg-blue-500 text-xs font-medium text-blue-100 text-center p-1 leading-none rounded-l-full" style="width: 50%"></div>
        </div>
    </div>
    
    <div class="text-center mt-5 p-3">
        <div class="text-2xl font-bold sm:text-2xl md:text-3xl xl:text-3xl">Registra los datos de tu vehículo</div>
    </div>

    <div class="p-3 px-5 sm:px-5 md:px-5 xl:px-5">
        <form @submit.prevent="submit">
            <select class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" v-model="form.tipo" required>
                <option value="" disabled selected hidden>TIPO DE VEHEHÍCULO</option>
                <option v-for="tipo in tipos" :value="tipo.id" :key="tipo.id">{{tipo.nombre}} </option>
            </select>
            <select class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" v-model="marca" required>
                <option value="" disabled selected hidden>MARCA</option>
                <option v-for="marca in marcas" :value="marca.ID" :key="marca.ID">{{marca.DESCRIPCION}} </option>
            </select>
            <select class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" v-model="form.modelo" required>
                <option value="" disabled selected hidden>MODELO</option>
                <option v-for="modelo in models" :value="modelo.ID" :key="modelo.ID">{{modelo.descripcion}} </option >
            </select>
             <select class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" v-model="form.year" required>
                <option value="" disabled selected hidden>AÑO</option>
                <option value="2022" >2023</option>
                <option value="2022" >2022</option>
                <option value="2021" >2021</option>
                <option value="2020" >2020</option>
                <option value="2019" >2019</option>
                <option value="2018" >2018</option>
                <option value="2017" >2017</option>
                <option value="2016" >2016</option>
                <option value="2015" >2015</option>
                <option value="2014" >2014</option>
                <option value="2013" >2013</option>
                <option value="2012" >2012</option>
                <option value="2011" >2011</option>
                <option value="2010" >2010</option>
                <option value="2009" >2009</option>
                <option value="2008" >2008</option>
                <option value="2007" >2007</option>
                <option value="2006" >2006</option>
                <option value="2005" >2005</option>
                <option value="2004" >2004</option>
                <option value="2003" >2003</option>
                <option value="2002" >2002</option>
                <option value="2001" >2001</option>
                <option value="2000" >2000</option>
                <option value="1999" >1999</option>
                <option value="1998" >1998</option>
                <option value="1997" >1997</option>
                <option value="1996" >1996</option>

            </select>
            <input class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" style="text-transform:uppercase;" type="text" placeholder="PLACA" v-model="form.placa" required>
            <input class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" style="text-transform:uppercase;" type="text" placeholder="CHASSIS" v-model="form.chasis" required>

                <div class="mt-5 mx-5 my-4">
                    <button class="bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50" >Continuar</button>
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
       clien_id: String,
       years: [2022, 2021, 2020]
    },
    methods: {

         modelosMarca: function(){
             this.models = this.modelos.filter(model => model.IDMARCA == 1)
         },

    },
    data(){
        return {
            models: '',
            marca: '',
            form: {
                tipo:'',
                modelo: '',
                year: '',
                placa: '',
                chasis: '',
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
             this.models = this.modelos.filter(model => model.IDMARCA == value)
         }

    }
}
</script>
