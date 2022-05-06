<template>
    <div class="w-full mb-4 rounded  overflow-x-hidden border-t flex flex-col bg-blue-600 shadow-lg shadow-blue-500/50">
        <div class="p-3">
            <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Multiseguros</a>
        </div>
    </div>
    <h1>DATOS DEL SEGURO </h1>
    <br><br>
    <h2>Datos del asegurado</h2>
    <br>
    Asegurado: {{cliente.name}} {{cliente.lastname}} <br>
    Cédula: {{cliente.cardnumber}} <br>
    Dirección: {{cliente.adrress}} <br>
    Teléfono: {{cliente.phonenumber}} <br>
    Aseguradora: {{sellers.insuranceCarrierName}}<br><br><br>

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
    <form @submit.prevent="submit">
        <div class="mt-5">
            <button class="bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50">
                Generar Poliza
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
                token: this.token

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
