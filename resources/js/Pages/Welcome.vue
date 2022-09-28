<template>
     <div class="w-full mb-2 rounded  overflow-x-hidden border-t flex flex-col bg-black shadow-lg shadow-black-500/50">
        <div class="p-2"> 
           <img class="inline h-12 w-25"  src="/ima/sc2_ic.png" alt="">
        </div>
    </div>

    <div class="mx-3 mt-8 mb-4 sm:mx-20 lg:mx-20 xl:mx-20">
        <div class=" bg-gray-200 rounded-full">
            <div class="bg-blue-500 text-xs font-medium text-blue-100 text-center p-1 leading-none rounded-l-full" style="width: 100%"></div>
        </div>
    </div>

    <div class="p-3">
            <div class="text-black font-bold text-center text-2xl sm:text-2xl md:text-3xl xl:text-3xl">Cuales servicios deseas agregarle a tu seguro </div>
    </div>
   
    <form @submit.prevent="submit">
          <div class="mx-4 block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <table class="table-auto">
                    <tbody>
                        <tr >
                            <tr>
                                <td>
                                    <input type="checkbox" name="poliza" >
                                </td>
                                <td>
                                    <label class="" >- Casa del Conductor</label>
                                </td>
                            </tr>
                            <tr>
                                    <label class="" > -> RD$ 795.00</label>
                            </tr>
                        </tr>
                        <tr >
                            <tr>
                                <td>
                                    <input type="checkbox" name="poliza" >
                                </td>
                                <td>
                                    <label class="" >- Aumento Fianza Hasta RD$1,000,000 (Veh. Livianos)</label>
                                </td>
                            </tr>
                            <tr>
                                    <label class="" > -> RD$ 425.00</label>
                            </tr>
                        </tr>
                        <tr >
                            <tr>
                                <td>
                                    <input type="checkbox" name="poliza" >
                                </td>
                                <td>
                                    <label class="" >- Accidentes Personales RD$100,000</label>
                                </td>
                            </tr>
                            <tr>
                                    <label class="" > -> RD$ 175.00</label>
                            </tr>
                        </tr>
                        <tr >
                            <tr>
                                <td>
                                    <input type="checkbox" name="poliza" >
                                </td>
                                <td>
                                    <label class="" >- Casa del Conductor</label>
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <label class="" > -> RD$ 795.00</label>
                                </td>
                            </tr>
                        </tr>
                    </tbody>
                </table>
          </div>
    </form>
   
     <form @submit.prevent="submit">
          <div class="mx-4 block p-2 px-1 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-1">
                    <input type="checkbox" name="poliza" >
                </div>
                <div class="col-span-3">
                    - Aumento Fianza Hasta RD$1,000,000 (Veh. Livianos)
                </div>
                <div class="col-span-2">
                    -> RD$ 425.00
                </div>
                <hr class="col-span-6">              
            </div>
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
      
    }

}
</script>

