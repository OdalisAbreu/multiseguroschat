<template>

<!-- Main modal -->
<div id="crud-modal" tabindex="10" aria-hidden="true" class=" overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ligth:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ligth:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 ligth:text-white">
                    Editar Servicio
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center ligth:hover:bg-gray-600 ligth:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-3">
                    <div class="col-span-3">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ligth:text-white">Nombre</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ligth:bg-gray-600 ligth:border-gray-500 ligth:placeholder-gray-400 ligth:text-white ligth:focus:ring-primary-500 ligth:focus:border-primary-500" placeholder="Type product name" required="">
                    </div>
                    <div class="col-span-3 ">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ligth:text-white">Codigo de la General de Seguros</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ligth:bg-gray-600 ligth:border-gray-500 ligth:placeholder-gray-400 ligth:text-white ligth:focus:ring-primary-500 ligth:focus:border-primary-500" placeholder="Type product name" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ligth:text-white">Precio (3 meses)</label>
                        <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ligth:bg-gray-600 ligth:border-gray-500 ligth:placeholder-gray-400 ligth:text-white ligth:focus:ring-primary-500 ligth:focus:border-primary-500" placeholder="$2999" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ligth:text-white">precio (6 meses)</label>
                        <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ligth:bg-gray-600 ligth:border-gray-500 ligth:placeholder-gray-400 ligth:text-white ligth:focus:ring-primary-500 ligth:focus:border-primary-500" placeholder="$2999" required="">
                    </div> 
                    <div class="col-span-2 sm:col-span-1">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ligth:text-white">precio (12 meses)</label>
                        <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ligth:bg-gray-600 ligth:border-gray-500 ligth:placeholder-gray-400 ligth:text-white ligth:focus:ring-primary-500 ligth:focus:border-primary-500" placeholder="$2999" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ligth:text-white">DPA</label>
                        <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ligth:bg-gray-600 ligth:border-gray-500 ligth:placeholder-gray-400 ligth:text-white ligth:focus:ring-primary-500 ligth:focus:border-primary-500" placeholder="$2999" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ligth:text-white">RC</label>
                        <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ligth:bg-gray-600 ligth:border-gray-500 ligth:placeholder-gray-400 ligth:text-white ligth:focus:ring-primary-500 ligth:focus:border-primary-500" placeholder="$2999" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ligth:text-white">RC2</label>
                        <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ligth:bg-gray-600 ligth:border-gray-500 ligth:placeholder-gray-400 ligth:text-white ligth:focus:ring-primary-500 ligth:focus:border-primary-500" placeholder="$2999" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ligth:text-white">FJ</label>
                        <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ligth:bg-gray-600 ligth:border-gray-500 ligth:placeholder-gray-400 ligth:text-white ligth:focus:ring-primary-500 ligth:focus:border-primary-500" placeholder="$2999" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 ligth:text-white">AP</label>
                        <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ligth:bg-gray-600 ligth:border-gray-500 ligth:placeholder-gray-400 ligth:text-white ligth:focus:ring-primary-500 ligth:focus:border-primary-500" placeholder="$2999" required="">
                    </div>
                    <div class="col-span-3">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ligth:text-white">Identificador de placas</label>
                        <input id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 ligth:bg-gray-600 ligth:border-gray-500 ligth:placeholder-gray-400 ligth:text-white ligth:focus:ring-blue-500 ligth:focus:border-blue-500">                   
                    </div>
                </div>
                <button type="button" class="mx-2 px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cerrar</button>
                <button type="button" class="mx-2 px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Editar</button>
            </form>
        </div>
    </div>
</div> 

</template>

<script>
export default {
    name:"EditTarifa"

}
</script>

<style>

</style>