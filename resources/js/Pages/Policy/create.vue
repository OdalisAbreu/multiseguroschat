<template>
    <div class="w-full mb-4 rounded  overflow-x-hidden border-t flex flex-col bg-blue-600 shadow-lg shadow-blue-500/50">
        <div class="p-3">
            <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Multiseguros</a>
        </div>
    </div>


    <h1>Cuales servicios deseas agregarle a tu seguro </h1><br><br>
    <form @submit.prevent="submit">
        <div v-for="service in services" :key="service.id" class="px-5">
            <input type="checkbox" :checked="suma" :value="service.id" v-model="form.servicios"  name="poliza" >
            <label> - {{ service.serviceName }} -> RD$ {{service.servicePrice}}</label><br><br>
        </div> <br><br>
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
