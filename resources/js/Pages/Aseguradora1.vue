<template>
    <section class="bg-gray-200 pb-6">

        <Header :width="70" />

        <section class="p-6 relative rounded-xl bg-white mx-6 z-50 mt-4">

            <div
                class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-7">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Asegurado</h3>
                    <p>RAFAEL DE LA CRUZ</p>
                </div>
                <div class="p-4 rounded-full bg-blue-700">
                    <img src="" alt="Editar">
                </div>
            </div>

            <div
                class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-7">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Poliza</h3>
                    <p>BMW Serie 430, 2012</p>
                </div>
                <div class="p-4 rounded-full bg-blue-700">
                    <img src="" alt="Editar">
                </div>
            </div>

            <div
                class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-7">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Aseguradora</h3>
                    <p>MultiSeguros | Anual | RD$ 10,000</p>
                </div>
                <div class="p-4 rounded-full bg-blue-700">
                    <img src="" alt="Editar">
                </div>
            </div>

            <section class="w-full flex flex-col bg-slate-100 rounded-xl border-2 border-gray-300 mb-2">
                <h2 class="text-left">
                    Servicios Opcionales
                </h2>
                <section class="flex flex-col">
                    <div class="w-5/6 flex justify-start bg-white">
                        <div><input type="radio"></div>
                        <div class="flex flex-col items-center justify-center">
                            <p>Casa del Conductor</p>
                            <p>RD$ 225</p>
                        </div>
                    </div>
                </section>
                <div class="text-center w-full mb-4">
                    <Link href="Aseguradora1"
                        class="w-10/12 justify-center bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-4 mt-5 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full">
                    Continuar
                    </Link>
                </div>
            </section>
        </section>
    </section>
</template>
<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { watch } from '@vue/runtime-core';
import Header from '../components/Header.vue';

export default {
    components: {
        Header,
        Head,
        Link
    },

}
</script>
