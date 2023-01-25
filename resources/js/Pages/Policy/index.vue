<template>
    <section class="bg-gray-200 pb-6">

        <Header :width="65" />

        <section class="p-6 relative rounded-xl bg-white mx-6 z-50 mt-4">

            <div
                class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-7">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Asegurado</h3>
                    <p>RAFAEL DE LA CRUZ</p>
                </div>
                <div class="p-4 rounded-full bg-blue-700">
                    <img src="../../../../public/ima/edit.png" alt="Editar">
                </div>
            </div>

            <div
                class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-7">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Poliza</h3>
                    <p>BMW Serie 430, 2012</p>
                </div>
                <div class="p-4 rounded-full bg-blue-700">
                    <img src="../../../../public/ima/edit.png" alt="Editar">
                </div>
            </div>

            <section class="flex flex-col bg-slate-100 rounded-xl border-2 border-gray-300 mb-2">
                <div class="p-2">
                    <div class="text-left text-black font-bold text-xl sm:text-2xl md:text-3xl xl:text-3xl">
                        Selecciona tu aseguradora</div>
                </div>

                <div class="w-full" v-for="seller in sellers" :key="seller.id">
                    <div class="w-full p-2">
                        <div class="container mx-auto">
                            <div>

                                <div class="relative w-full flex justify-start items-start overflow-hidden mb-1">
                                    <img class="bg-cover bg-no-repeat bg-center h-10 w-40" :src="seller.logo">
                                </div>

                                <div class="flex flex-col justify-center items-center">

                                    <input type="hidden" id="servicios" :value="seller.servicios">
                                    <div class="w-full flex justify-center items-center gap-1 mb-4">
                                        <!-- <input type="radio" :value="tresmeses" name="poliza"
                                        v-model="form.policyTime"> -->
                                        <button
                                            class="flex focus:bg-blue-600 focus:border-blue-600 hover:border-blue-600 focus:text-white hover:text-white hover:bg-blue-600 hover:cursor-pointer flex-col items-center justify-center mb-1 text-sm font-semibold text-gray-900 border border-gray-300 bg-white text-center rounded-lg w-full h-16">
                                            <p>3 Meses</p>
                                            <p>RD$ {{
                                                new
                                                                                            Intl.NumberFormat('en-IN').format(seller.tresmeses)
                                            }}.00</p>
                                        </button>
                                        <!--<input type="button" value="seismeses" name="poliza" v-model="form.policyTime">-->
                                        <button
                                            class="flex focus:bg-blue-600 focus:border-blue-600 hover:border-blue-600 focus:text-white hover:text-white hover:bg-blue-600 hover:cursor-pointer flex-col items-center justify-center mb-1 text-sm font-semibold text-gray-900 border border-gray-300 bg-white text-center rounded-lg w-full h-16">
                                            <p>6 Meses</p>
                                            <p>RD$ {{
                                                new
                                                                                            Intl.NumberFormat('en-IN').format(seller.seismeses)
                                            }}.00</p>
                                        </button>
                                        <!-- <input type="button" value="docemeses" name="poliza" v-model="form.policyTime"> -->
                                        <button
                                            class="flex focus:bg-blue-600 focus:border-blue-600 hover:border-blue-600 focus:text-white hover:text-white hover:bg-blue-600 hover:cursor-pointer flex-col items-center justify-center mb-1 text-sm font-semibold text-gray-900 border border-gray-300 bg-white text-center rounded-lg w-full h-16">
                                            <p>Anual</p>
                                            <p>RD$ {{
                                                new
                                                                                            Intl.NumberFormat('en-IN').format(seller.docemeses)
                                            }}.00</p>
                                        </button>
                                    </div>
                                </div>
                                <div class="w-full border-t-2 border-gray-700 border-dashed pt-4"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center w-full mb-4">
                    <button v-on:click="procesar(1, 1)"
                        class="w-10/12 justify-center bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-4 mt-5 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full">
                        Continuar
                    </button>
                </div>
            </section>
        </section>
    </section>
    <Footer />


</template>
<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { watch } from '@vue/runtime-core';
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';

export default {
    components: {
        Footer,
        Header,
        Head,
        Link
    },
    props: {
        car: Array,
        sellers: Array,
        token: String,
        clien_id: String,
    },
    mounted() {
        this.form.servicios = document.getElementById('servicios').value
    },
    data() {
        return {
            form: {
                car: this.car,
                seller: this.sellers,
                token: this.token,
                policyTime: '',
                clien_id: this.clien_id,
                servicios: ''
            }
        }
    },
    methods: {
        procesar: function (insurances_id, vehicle_type_id) {
            //   console.log(insurances_id + ' - ' + vehicle_type_id)
            this.$inertia.post(this.route('services', [insurances_id, vehicle_type_id]), this.form)
        }
    },

}
</script>
