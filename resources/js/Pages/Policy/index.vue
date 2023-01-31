<template>
    <section class="bg-gray-200 pb-6">

        <Header :width="65" />

        <section class="p-6 relative rounded-xl bg-white mx-6 z-50 mt-4">

            <div
                class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-7">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Asegurado</h3>
                    <p>{{ client.name }} {{ client.lastname }} </p>
                </div>
                <a @click="clientReturn()" class="p-4 rounded-full bg-blue-700">
                    <img src="../../../../public/ima/edit.png" alt="Editar">
                </a>
            </div>

            <div
                class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-7">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Poliza</h3>
                    <p> {{ car.marcaName }} {{ car.modeloName }}, {{ car.year }}</p>
                </div>
                <a @click="cartReturn()" class="p-2 rounded-full bg-blue-800">
                    <img src="../../../../public/ima/edit.png" alt="Editar">
                </a>
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
                                        <button v-on:click="procesar(seller.insurances_id, 'tresmeses')" 
                                            class="flex focus:bg-blue-600 focus:border-blue-600 hover:border-blue-600 focus:text-white hover:text-white hover:bg-blue-600 hover:cursor-pointer flex-col items-center justify-center mb-1 text-sm font-semibold text-gray-900 border border-gray-300 bg-white text-center rounded-lg w-full h-16">
                                            <p>3 Meses</p>
                                            <p>RD$ {{
                                                new
                                                                                            Intl.NumberFormat('en-IN').format(seller.tresmeses)
                                            }}.00</p>
                                        </button>
                                        <!--<input type="button" value="seismeses" name="poliza" v-model="form.policyTime">-->
                                        <button v-on:click="procesar(seller.insurances_id, 'seismeses')"
                                            class="flex focus:bg-blue-600 focus:border-blue-600 hover:border-blue-600 focus:text-white hover:text-white hover:bg-blue-600 hover:cursor-pointer flex-col items-center justify-center mb-1 text-sm font-semibold text-gray-900 border border-gray-300 bg-white text-center rounded-lg w-full h-16">
                                            <p>6 Meses</p>
                                            <p>RD$ {{
                                                new
                                                                                            Intl.NumberFormat('en-IN').format(seller.seismeses)
                                            }}.00</p>
                                        </button>
                                        <!-- <input type="button" value="docemeses" name="poliza" v-model="form.policyTime"> -->
                                        <button v-on:click="procesar(seller.insurances_id, 'docemeses')"
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
        cities: Object,
        provinces: Object,
        clientProvince: Array,
        client: Array,
        tipos: Array,
        marcas: Array,
        modelos: Array
    },
    mounted() {
        this.form.servicios = document.getElementById('servicios').value
        console.log(this.sellers)
    },
    data() {
        return {
            form: {
                car: this.car,
                seller: this.sellers,
                token: this.token,
                clien_id: this.clien_id,
                servicios: '',
                client: this.client,
                tipos: this.tipos,
                marcas: this.marcas,
                modelos:this.modelos,
                car: this.car
            },
            form2: {
                cities: this.cities,
                provinces: this.provinces,
                clientProvince: this.clientProvince,
                client: this.client,
                car: this.car,
                tipos: this.tipos,
                marcas: this.marcas,
                modelos:this.modelos
            }
        }
    },
    methods: {
        procesar: function (insurances_id, time) {
            //   console.log(insurances_id + ' - ' + vehicle_type_id)
            this.$inertia.post(this.route('services', [insurances_id, time]), this.form)
        },
        clientReturn(){
            this.$inertia.post(this.route('clientReturn'), this.form2)
        },
        cartReturn(){
            this.$inertia.post(this.route('carReturn'), this.form2)
        }
    },

}
</script>
