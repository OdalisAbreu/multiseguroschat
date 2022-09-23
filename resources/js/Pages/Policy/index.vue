<template>
     <div class="w-full mb-2 rounded  overflow-x-hidden border-t flex flex-col bg-black shadow-lg shadow-black-500/50">
        <div class="p-2"> 
           <img class="inline h-12 w-25"  src="/ima/sc2_ic.png" alt="">
        </div>
    </div>

    <div class="mx-3 mt-8 mb-4 sm:mx-20 lg:mx-20 xl:mx-20">
        <div class=" bg-gray-200 rounded-full">
            <div class="bg-blue-500 text-xs font-medium text-blue-100 text-center p-1 leading-none rounded-l-full" style="width: 75%"></div>
        </div>
    </div>

    <div class="p-3">
            <div class="text-center text-black font-bold text-2xl sm:text-2xl md:text-3xl xl:text-3xl">Seleccione el seguro de su preferencia</div>
        </div>


 <!-- <div class="antialiased text-gray-900 font-sans p-6" v-for="seller in sellers" :key="seller.id">
    <div class="container mx-auto">
        <div class="flex flex-wrap -mx-1 md:flex flex-col">
            <div class="w-full p-4 sm:w-1/4 md:w-1/2 xl:w-1/3">
                <a @click.prevent="sentDate(seller.id)" class="c-card block bg-white shadow-md  hover:shadow-xl rounded-lg overflow-hidden">
                    <div class="relative pb-48 overflow-hidden">
                        <img class="absolute  inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1605152276897-4f618f831968?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80">
            </div>
                    <div class="p-4">
                        <span class="inline-block px-2 py-1 leading-none bg-orange-200 text-orange-800 rounded-full font-semibold uppercase tracking-wide text-xs">{{seller.id}} -
                            {{seller.insurace}}</span>
                        <h2 class="mt-2 mb-2  font-bold">Compañía De Seguros en Santo Domingo</h2>
                        <p class="text-sm">Calle Doctor Jacinto Ignacio Mañón 15 Santo Domingo República Dominicana.</p>
                            <div class="mt-3 flex items-center">
                            <span class="font-bold text-xl">Click Aqui</span>
                            </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </div>-->

   <div class="bg-white max-w-lg mx-auto p-8 my-10 rounded-lg shadow-2xl" v-for="seller in sellers" :key="seller.id">
    <div class="w-full p-2">
        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-1 md:flex flex-col">
                        <div class="relative pb-15 overflow-hidden">
                            <img class="inline h-12 w-25" :src="seller.logo">
                        </div>
                        <div class="p-1">
                            <span class="inline-block px-2 py-1 leading-none bg-blue-200 text-blue-800 rounded-full font-semibold uppercase tracking-wide text-xs">{{seller.insurace}}</span>
                            <h2 class="mt-2 mb-2  font-bold">Compañía De Seguros en Santo Domingo</h2>
                        </div>
                                    <input type="hidden" id="servicios" :value="seller.servicios" >
                                    <a class="mx-4 block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                    <input type="radio" value="tresmeses" name="poliza" v-model="form.policyTime">
                                    <label class="mb-1 text-xl font-semibold tracking-tight text-gray-900 dark:text-white"> 3 Meses -> {{seller.tresmeses}}</label><br><br>
                                    <input type="radio" value="seismeses" name="poliza" v-model="form.policyTime">
                                    <label class="mb-1 text-xl font-semibold tracking-tight text-gray-900 dark:text-white"> 6 Meses -> {{seller.seismeses}}</label><br><br>
                                    <input type="radio" value="docemeses" name="poliza" v-model="form.policyTime">
                                    <label class="mb-1 text-xl font-semibold tracking-tight text-gray-900 dark:text-white"> 12 Meses -> {{seller.docemeses}}</label><br><br>

                                    </a>
                                <div class="mt-5 mb-5 mx-5 my-4" style='text-align: center'>
                                    <button @click="procesar(seller.insurances_id, seller.vehicle_type_id)" class="bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50" >Continuar</button>
                                </div>
            </div>
        </div>
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
       car: Array,
       sellers: Array,
       token: String,
       clien_id: String,
    },
    mounted(){
        this.form.servicios = document.getElementById('servicios').value

    },
    data(){
        return{
            form:{
                car: this.car,
                seller: this.sellers,
                token: this.token,
                policyTime: '',
                clien_id: this.clien_id,
                servicios: ''
            }
        }
    },
    methods:{
         procesar: function (insurances_id, vehicle_type_id) {
            this.$inertia.post(this.route('services',insurances_id), this.form)
        } 
    },

}
</script>
