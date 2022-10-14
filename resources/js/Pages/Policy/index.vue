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

    <div class="p-2">
            <div class="text-center text-black font-bold text-2xl sm:text-2xl md:text-3xl xl:text-3xl">Seleccione el seguro de su preferencia</div>
        </div>

   <div class="bg-white max-w-lg mx-auto p-3 my-3 rounded-lg shadow-2xl" v-for="seller in sellers" :key="seller.id">
    <div class="w-full p-2">
        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-1 md:flex flex-col">
                        <div class="relative pb-15 overflow-hidden">
                            <img class="inline h-12 w-25" :src="seller.logo">
                        </div> 
                        <div class="p-1">
                            <span class="inline-block px-2 py-1 leading-none text-blue-800 rounded-full font-semibold uppercase tracking-wide text-xs">{{seller.insurace}}</span>
                        </div>
                                    <input type="hidden" id="servicios" :value="seller.servicios" >
                                    <a class="mx-4 block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:border-gray-700 ">
                                    <input type="radio" value="tresmeses" name="poliza" v-model="form.policyTime">
                                    <label class="mb-1 text-sm font-semibold tracking-tight text-gray-900 "> 3 Meses -> RD$ {{new Intl.NumberFormat('en-IN').format(seller.tresmeses)}}.00</label><br>
                                    <input type="radio" value="seismeses" name="poliza" v-model="form.policyTime">
                                    <label class="mb-1 text-sm font-semibold tracking-tight text-gray-900"> 6 Meses -> RD$ {{new Intl.NumberFormat('en-IN').format(seller.seismeses)}}.00</label><br>
                                    <input type="radio" value="docemeses" name="poliza" v-model="form.policyTime">
                                    <label class="text-sm font-semibold tracking-tight text-gray-900 "> 12 Meses -> RD$ {{new Intl.NumberFormat('en-IN').format(seller.docemeses)}}.00</label>
                                    </a>
                                <div class="" style='text-align: center'> 
                                    <button @click="procesar(seller.insurances_id, seller.vehicle_type_id)" class="bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 mt-1 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50" >Continuar</button>
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
        //   console.log(insurances_id + ' - ' + vehicle_type_id)
           this.$inertia.post(this.route('services',[insurances_id, vehicle_type_id]), this.form)
        } 
    },

}
</script>
