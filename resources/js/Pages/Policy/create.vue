<template>
     <div class="w-full mb-2 rounded  overflow-x-hidden border-t flex flex-col bg-black shadow-lg shadow-black-500/50">
        <div class="p-2"> 
           <img class="inline h-12 w-25"  src="/ima/seguros_icon.png" alt="">
        </div>
    </div>

    <div class="mx-3 mt-8 mb-4 sm:mx-20 lg:mx-20 xl:mx-20">
        <div class=" bg-gray-200 rounded-full">
            <div class="bg-lime-600 text-xs font-medium text-blue-100 text-center p-1 leading-none rounded-l-full" style="width: 100%"></div>
        </div>
    </div>

    <div class="p-3">
            <div class="text-black font-bold text-2xl sm:text-2xl md:text-3xl xl:text-3xl">Cuales servicios deseas agregarle a tu seguro </div>
    </div>
    
    
    <form @submit.prevent="submit">
        <a class="mx-4 block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        <div v-for="service in services" :key="service.id" class="px-5">
            <input type="checkbox" :checked="suma" :value="service.id" v-model="form.servicios"  name="poliza" >
            <label class="mb-1 text-xl font-semibold tracking-tight text-gray-900 dark:text-white" > - {{ service.serviceName }} -> RD$ {{service.servicePrice}}</label><br><br>
        </div>
        </a>
        <br><br>
    <div class="mt-5">
        <button class="bg-lime-600 hover:bg-lime-700 shadow-lg shadow-lime-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50">Continuar</button>
    </div>   
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
       car: Array,
       tarifa: Array,
       sellers: Array,
       token: String,
       services: Array,
       policyTime: String,
       clien_id: String,
    },
    mounted(){
    },
    data(){
        return{
            total: 50,
            form:{
                car: this.car,
                tarifa:this.tarifa,
                seller: this.sellers,
                token: this.token,
                services: this.services,
                policyTime: this.policyTime,
                clien_id: this.clien_id,
                servicios: []

            }
        }
    },
    methods:{
        submit(){
            this.$inertia.post(this.route('servicespolicy'), this.form)
        }
    },
    watch: {
        suma: function(){
            console.log('Entro')
        }
    }

}
</script>
