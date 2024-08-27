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
                    <div class="w-min hover:bg-gray-300 rounded cursor-pointer">
                        <a @click="$emit('edit-item', item.id)"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 16 16">
		                    <path fill="#0c09b3" d="M5 1a.5.5 0 0 1 .5.5V2h2v-.5a.5.5 0 0 1 1 0V2h2v-.5a.5.5 0 0 1 1 0V2A1.5 1.5 0 0 1 13 3.5v2.536a2.547 2.547 0 0 0-1 .406V3.5a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h1.547v.002a1.59 1.59 0 0 0 .068.998H4.5A1.5 1.5 0 0 1 3 13.5v-10A1.5 1.5 0 0 1 4.5 2v-.5A.5.5 0 0 1 5 1m5 7c.107 0 .206.034.288.091L9.378 9H6a.5.5 0 0 1 0-1zm-3.004 3.435A.5.5 0 0 0 6.5 11H6a.5.5 0 0 0 0 1h.5a.498.498 0 0 0 .157-.025c.097-.189.21-.37.339-.54M6 5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm6.338 2.455a1.56 1.56 0 0 1 2.207 2.207l-4.289 4.288a2.777 2.777 0 0 1-1.29.731l-1.211.303a.61.61 0 0 1-.74-.74l.304-1.21c.122-.489.374-.935.73-1.29z" />
	                        </svg>
                        </a>
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