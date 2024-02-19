<template>

<div v-if="isVisible" class="relative overflow-x-auto shadow-md sm:rounded-lg my-8">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ligth:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ligth:bg-gray-700 ligth:text-gray-400">
            <tr>
                <th v-for="head in headers" :key="head" scope="col" class="px-3 py-3">
                    {{head}}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in data" :key="item.id" class="odd:bg-white odd:ligth:bg-gray-900 even:bg-gray-50 even:ligth:bg-gray-800 border-b ligth:border-gray-700">
                <td v-for="value in item" :key="value.id" scope="col" class="px-3 py-4">
                    {{ value }}
                </td>
                <td v-if="withOption" class="px-3 py-4">
                    <div>
                        <a class="font-medium text-green-600 ligth:text-blue-500 hover:underline" @click="$emit('edit-item', item.id)"> Editar</a>
                        <a class="font-medium text-red-600 ligth:text-blue-500 hover:underline"> Eliminar</a>
                    </div>
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
        headers: Array,
        data:Object,
        isVisible: Boolean,
        withOption: Boolean
    },
}
</script>

<style>

</style>