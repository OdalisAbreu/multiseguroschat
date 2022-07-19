<template>
    <div class="w-full mb-2 rounded  overflow-x-hidden border-t flex flex-col bg-black shadow-lg shadow-black-500/50">
        <div class="p-2"> 
           <img class="inline h-12 w-25"  src="/ima/seguros_icon.png" alt="">
        </div>
    </div>
    
    <div class="p-4 w-full text-center bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-100 dark:border-gray-700">
    <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-black">DATOS DEL SEGURO </h5>
    <div  class="w-full mb-4 rounded  overflow-x-hidden border-t flex flex-col">
        <div class="p1">
            <p class="text-center text-black font-semibold text-xl">Datos del asegurado</p>
        </div>
    </div>
    <br>
    Asegurado: {{cliente.name}} {{cliente.lastname}} <br>
    Cédula: {{cliente.cardnumber}} <br>
    Dirección: {{cliente.adrress}} <br>
    Teléfono: {{cliente.phonenumber}} <br>
    Aseguradora: {{sellers.nombre}}<br><br><br>

    <h2>Datos del vehículo  </h2><br>

    Tipo: {{tipo}} <br>
    Marca: {{marca}} <br>
    Modelo: {{modelo}} <br>
    Año: {{car.year}} <br>
    Chassis: {{car.chasis}} <br>
    Registro: {{car.placa}} <br><br><br>

    <h2>Servicios seleccionados </h2><br>

    <div v-for="servicio in services" :key="servicio.id">
        {{servicio.serviceName}} <br>
    </div>
    <br>
    Total a pagar: {{totalGeneral}}<br>
    </div>
    <form @submit.prevent="submit">
        <div class="mt-5">
            <button class="bg-lime-600 hover:bg-lime-700 shadow-lg shadow-lime-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50">
                Confirmar
            </button>
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
       marca: String,
       tipo: String,
       modelo: String,
       cliente: Array,
       services: Array,
       totalGeneral: String,
    },
    mounted(){
    },
    data(){
        return{
            form:{
                car: this.car,
                cliente: this.cliente,
                services: this.services,
                totalGeneral: this.totalGeneral,
                policyTime: this.policyTime,
                sellers: this.sellers,

            }
        }
    },
    methods:{
        submit(){
            this.$inertia.post(this.route('generatepolicy'), this.form)
        }
    },
    watch: {
        suma: function(){
            console.log('Entro')
        }
    }

}
</script>
