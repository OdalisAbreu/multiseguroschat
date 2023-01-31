<template>
    <div class="w-full mb-2 rounded  overflow-x-hidden border-t flex flex-col bg-black shadow-lg shadow-black-500/50">
        <div class="p-2"> 
           <img class="inline h-12 w-25"  src="/ima/sc2_ic.png" alt="">
        </div>
    </div>
    
     <div class="p-4 w-full text-center bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-100 dark:border-gray-700">
       
        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-black">DATOS DEL SEGURO </h5>
               <div class="relative pb-15 overflow-hidden">
                  <img class="inline h-12 w-25" :src="insurre.logo">
                </div> 
        <div class="">
            <div class="col-span-1">
                <div  class="w-full rounded  overflow-x-hidden border-t flex flex-col">
                    <div class="w-full rounded  overflow-x-hidden border-t flex flex-col bg-blue-500">
                        <p class="text-center text-white font-semibold text-xl">Datos del Asegurado</p>
                    </div>
            </div>
                <div class="w-full font-bold rounded  overflow-x-hidden border-t flex flex-col bg-gray-200">
                    Asegurado: {{cliente.name}} {{cliente.lastname}} <br>
                    Cédula: {{cliente.cardnumber}} <br>
                    Dirección: {{cliente.adrress}} <br>
                    Teléfono: {{cliente.phonenumber}} <br>
                </div>
            </div>
        
            <div class="col-span-1">
                <div  class="w-full rounded  overflow-x-hidden border-t flex flex-col">
                    <div class="w-full rounded  overflow-x-hidden border-t flex flex-col bg-blue-500">
                        <p class="text-center text-white font-semibold text-xl">Datos del Vehículo</p>
                    </div>
                </div>
                    <div class="w-full font-bold rounded  overflow-x-hidden border-t flex flex-col bg-gray-200">
                        Tipo: {{tipo}} <br>
                        Marca: {{marca}} <br>
                        Modelo: {{modelo}} <br>
                        Año: {{car.year}} <br>
                        Chassis: <label style="text-transform: uppercase">{{car.chasis}} </label>
                        Registro: <label style="text-transform: uppercase"> {{car.placa}} </label>
                    </div>
            </div>

            <div class="col-span-1">
                <div  class="w-full rounded overflow-x-hidden border-t flex flex-col">
                    <div class="w-full rounded  overflow-x-hidden border-t flex flex-col bg-blue-500">
                        <p class="text-center text-white font-semibold text-xl">Servicios</p>
                    </div>
                </div>
                <div >
                    <div class="w-full mb-8 font-bold rounded  overflow-x-hidden border-t flex flex-col bg-gray-200">
                      <div v-for="servicio in services" :key="servicio.id">
                      {{servicio.serviceName}} <br>
                      RD$ {{new Intl.NumberFormat('en-IN').format(servicio.servicePrice)}}<br>
                    </div>
                </div>
                </div>
            </div>
            <div class="pb-5">
                    <label>¿Tienes código de descuento? Digítalo acá</label>
                    <input class="rounded-lg w-full mt-4 mb-4 sm:m-3 sm:w-30 md:m-3 md:w-50 xl:m-3 xl:w-80" type="text" id="codigo" placeholder="Códigos de descuento" v-model="form.descuento">
                    <a @click="descuento()" class="bg-blue-600 hover:bg-blue-700 shadow-lg shadow-lime-500/50 text-white font-bold rounded-lg w-full py-3 px-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50"> 
                    Aplicar Descuento 
                    </a>
            </div>
 
            <div class="col-span-1">
                <div class="w-full font-bold rounded  overflow-x-hidden border-t flex flex-col bg-gray-200"> 
                    Sub Total: {{new Intl.NumberFormat('en-IN').format(totalGeneral)}}<br>
                    Descuento: {{new Intl.NumberFormat('en-IN').format(form.descontar)}}<br>
                    Total a pagar:  {{new Intl.NumberFormat('en-IN').format(form.totalGeneral)}}<br>
                </div>
                    <form @submit.prevent="submit">
                        <div class="mt-5">
                            <button class="bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50">
                                Comprar
                            </button>
                        </div>
                    </form>
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
       tarifa: Array,
       sellers: Array,
       services: Array,
       policyTime: String,
       marca: String,
       tipo: String,
       modelo: String,
       cliente: Array,
       totalGeneral: String,
       insurre: Array,
    },
    mounted(){
       console.log(this.insurre)
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
                descuento: '',
                descontar: 0,
                insurre: this.insurre

            }
        }
    },
    methods:{
        submit(){
            this.$inertia.post(this.route('generatepolicy'), this.form)
        },
        descuento(){
            var codigoIngresado = document.getElementById('codigo').value
            var count = 0
            var percentage = 0 
           this.codigosDescuento.forEach(function(codigo) {
                if(codigoIngresado == codigo.code){
                    count++
                    percentage = codigo.discount_amount
                }
            });
            console.log(percentage)
            this.form.descontar = this.totalGeneral * percentage / 100
            var aplicado =  this.totalGeneral - this.form.descontar
            console.log(aplicado)
            if(count > 0){
                this.form.totalGeneral = aplicado
            }else{
                alert('Código vencido o invalido, favor de verificar su código e introducirlo nuevamente')
                document.getElementById('codigo').value = ''
            }
        }
    },
    watch: {
        suma: function(){
            console.log('Entro')
        }
    }

}
</script>
