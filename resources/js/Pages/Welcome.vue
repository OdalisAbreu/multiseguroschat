<template>
    <div class="w-full mb-2 rounded  overflow-x-hidden border-t flex flex-col bg-black shadow-lg shadow-black-500/50">
        <div class="p-2"> 
           <img class="inline h-12 w-25"  src="/ima/seguros_icon.png" alt="">
        </div>
    </div>
    
    <div class="p-4 w-full text-center bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-100 dark:border-gray-700">
        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-black">DATOS DEL SEGURO </h5>
  
        <div class="grid grid-rows-4 grid-flow-col gap-4">
            <div class="col-span-1">
                <div  class="w-full mb-4 rounded  overflow-x-hidden border-t flex flex-col">
                    <div class="p1">
                        <p class="text-center text-black font-semibold text-xl">Datos del asegurado</p>
                    </div>
                </div>
                Asegurado: Dariel Abreu <br>
                Cédula: 22400274092 <br>
                Dirección: Las Cobas <br>
                Teléfono: 8294428902 <br>
                Aseguradora: Sura<br><br>
            </div>
        
            <div class="col-span-1">
                <div  class="w-full mb-4 rounded  overflow-x-hidden border-t flex flex-col">
                    <div class="p1">
                        <p class="text-center text-black font-semibold text-xl">Datos del vehículo</p>
                    </div>
                </div>
                Tipo: Automovil <br>
                Marca: ACURA <br>
                Modelo: ACURA <br>
                Año: 2022 <br>
                Chassis: A48949849 <br>
                Registro: A6566 <br><br><br>
            </div>

            <div class="col-span-1">
                <div  class="w-full mb-4 rounded  overflow-x-hidden border-t flex flex-col">
                    <div class="p1">
                        <p class="text-center text-black font-semibold text-xl">Servicios</p>
                    </div>
                </div>
                <div >
                    Casa del Conductor<br>
                    Asistencia Vial (Grua) <br>
                </div>
            </div>

            <div class="col-span-1">
                Total a pagar: 2085<br>
                <form @submit.prevent="submit">
                    <input class="rounded-lg w-full mt-4 sm:m-3 sm:w-30 md:m-3 md:w-50 xl:m-3 xl:w-80" type="text" placeholder="Códigos de descuento" >
                    <div class="mt-5">
                        <button class="bg-lime-600 hover:bg-lime-700 shadow-lg shadow-lime-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50">
                            Confirmar
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
}
</script>
