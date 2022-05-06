<template>
    <div class="w-full mb-4 rounded  overflow-x-hidden border-t flex flex-col bg-blue-600 shadow-lg shadow-blue-500/50">
        <div class="p-3">
            <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Seguros Chat</a>
        </div>
    </div>

    <div class="mx-3 mt-8 mb-4 sm:mx-20 lg:mx-20 xl:mx-20">
        <div class=" bg-gray-200 rounded-full">
            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-l-full" style="width: 75%"> 75%</div>
        </div>
    </div>


    <div class="antialiased text-gray-900 font-sans p-6" v-for="seller in sellers" :key="seller.id">
    <div class="container mx-auto">
        <div class="flex flex-wrap -mx-1 md:flex flex-col">
            <div class="w-full p-4 sm:w-1/4 md:w-1/2 xl:w-1/3">
                <a @click.prevent="sentDate(seller.id)" class="c-card block bg-white shadow-md  hover:shadow-xl rounded-lg overflow-hidden">
                    <div class="relative pb-48 overflow-hidden">
                        <img class="absolute  inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1605152276897-4f618f831968?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80">
                    </div>
                    <div class="p-4">
                        <span class="inline-block px-2 py-1 leading-none bg-orange-200 text-orange-800 rounded-full font-semibold uppercase tracking-wide text-xs">{{seller.id}} -
                            {{seller.insuranceCarrierName}}</span>
                        <h2 class="mt-2 mb-2  font-bold">Compañía De Seguros en Santo Domingo</h2>
                        <p class="text-sm">Calle Doctor Jacinto Ignacio Mañón 15 Santo Domingo República Dominicana.</p>
                            <div class="mt-3 flex items-center">
                            <!--<span class="font-bold text-xl">Click Aqui</span>-->
                            </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    </div>

    <div class="mt-5 p-3">
        <div class="text-2xl font-bold sm:text-2xl md:text-3xl xl:text-3xl">Selecciona El tiempo para tu poliza de {{tarifa.tariffName}}</div>
    </div>

    <div class="p-3 px-5 sm:px-5 md:px-5 xl:px-5">
     <form class="px-5" @submit.prevent="submit">
         <input class="text-lg font-semibold sm:text-xl md:text-xl xl:text-xl" type="radio" value="threeMonths" name="poliza" v-model="form.policyTime">
         <label class="text-lg font-semibold sm:text-xl md:text-xl xl:text-xl">  3 Meses -> {{tarifa.threeMonths}}</label><br><br>
         <input type="radio" value="sixMonths" name="poliza" v-model="form.policyTime">
         <label>  6 Meses -> {{tarifa.sixMonths}}</label><br><br>
         <input type="radio" value="twelveMonths" name="poliza" v-model="form.policyTime">
         <label>  12 Meses -> {{tarifa.twelveMonths}}</label><br><br>

        <button class="bg-blue-500 py-2 px-4" >Continuar</button>
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
       car: Array,
       tarifa: Array,
       sellers: Array,
       token: String,
       clien_id: String,
    },
    mounted(){

    },
    data(){
        return{
            form:{
                car: this.car,
                tarifa:this.tarifa,
                seller: this.sellers,
                token: this.token,
                policyTime: '',
                clien_id: this.clien_id

            }
        }
    },
    methods:{
        submit(){
            this.$inertia.post(this.route('services'), this.form)
        }
    },

}
</script>
