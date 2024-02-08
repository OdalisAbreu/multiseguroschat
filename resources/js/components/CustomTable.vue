<template>

<div v-if="isVisible" class="relative overflow-x-auto shadow-md sm:rounded-lg my-8">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ligth:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ligth:bg-gray-700 ligth:text-gray-400">
            <tr>
                <th scope="col" class="px-3 py-3">
                    #
                </th>
                <th scope="col" class="px-3 py-3">
                    Nombre
                </th>
                <th scope="col" class="px-3 py-3">
                    Aseguradora
                </th>
                <th scope="col" class="px-3 py-3">
                    3 Meses
                </th>
                <th scope="col" class="px-3 py-3">
                    6 Meses
                </th>
                <th scope="col" class="px-3 py-3">
                    12 Meses
                </th>
                <th scope="col" class="px-3 py-3">
                    Estado
                </th>
                <th scope="col" class="px-3 py-3">
                    Opciones
                </th>
            </tr>
        </thead>
        <tbody v-for="item in data" :key="item.id">
            <tr class="odd:bg-white odd:ligth:bg-gray-900 even:bg-gray-50 even:ligth:bg-gray-800 border-b ligth:border-gray-700">
                <td class="px-3 py-4">
                    {{ item.id }}
                </td>
                <th scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap ligth:text-white">
                    {{item.tipoDeVehiculo}}
                </th>
                <th class="px-3 py-4">
                    {{item.aseguradora}}
                </th>
                <td class="px-3 py-4">
                    {{item.priceThreeMonths}}
                </td>
                <td class="px-3 py-4">
                    {{item.priceSixMonths}}
                </td>
                <td class="px-3 py-4">
                    {{item.priceTwelveMonths}}
                </td>
                <td class="px-3 py-4">
                    si
                </td>
                <td class="px-3 py-4">
                    <a href="#" class="font-medium text-green-600 ligth:text-blue-500 hover:underline"> Editar</a>
                    <a href="#" class="font-medium text-red-600 ligth:text-blue-500 hover:underline"> Eliminar</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div v-else class="text-xl text-gray-700 flex justify-center my-8">
    No Hay Resultados
</div>

</template>

<script>
export default {
    name:"CustomTable",
    props:{
        data:Object,
        isVisible: Boolean
    },
}
</script>

<style>

</style>