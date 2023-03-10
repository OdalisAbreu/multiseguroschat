<template>
    <section class="bg-gray-200 pb-6 min-h-screen">

        <Header :width="58" />

        <section class="p-3 relative rounded-xl bg-white mx-6 z-50 mt-4">

            <div class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Asegurado</h3>
                    <p>{{ client.name }} {{ client.lastname }} </p>
                </div>
                <div class="flex flex-col justify-end gap-1 items-center">
                    <a @click="clientReturn()" class="p-2 rounded-full bg-blue-800">
                        <img src="../../../../public/ima/edit.png" alt="Editar">
                    </a>
                    <p class="text-blue-800 bottom-2 font-bold text-sm">Editar</p>
                </div>
            </div>

            <div class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Vehículo</h3>
                    <p> {{ car.marcaName }} {{ car.modeloName }}, {{ car.year }}</p>
                </div>
                <div class="flex flex-col justify-end gap-1 items-center">
                    <a @click="cartReturn()" class="p-2 rounded-full bg-blue-800">
                        <img src="../../../../public/ima/edit.png" alt="Editar">
                    </a>
                    <p class="text-blue-800 bottom-2 text-center font-bold text-sm">Editar</p>
                </div>
            </div>

            <section class="flex flex-col bg-slate-100 rounded-xl border-2 border-gray-300 mb-2 px-4 p-3">
                <div class="p-2">
                    <div class="text-left text-black font-bold text-xl sm:text-2xl md:text-3xl xl:text-3xl">
                        Selecciona tu aseguradora</div>
                </div>

                <div class="w-full" v-for="seller, index in sellers" :key="index">
                    <div class="w-full p-2">
                        <div class="container mx-auto">
                            <div>

                                <div class="relative w-full flex justify-start items-start overflow-hidden mb-1">
                                    <img class="bg-cover bg-no-repeat bg-center h-10" :src="seller.logo">
                                </div>

                                <div class="flex flex-col justify-center items-center">

                                    <input type="hidden" id="servicios" :value="seller.servicios">
                                    <div class="w-full flex justify-around items-center gap-1 mb-1">
                                        <!-- <input type="radio" :value="tresmeses" name="poliza"
                                                v-model="form.policyTime"> -->
                                        <div class="relative w-2/5 flex flex-col justify-around items-center">

                                            <!-- <span v-if="isFocused == index + 1 && index == 0 && seller.insurances_id == 6"
                                                style="top: -6px;" class="absolute right-0 h-3 w-3">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-700 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-800"></span>
                                            </span>

                                            <span v-if="isFocused == index + 1 && index == 1 && seller.insurances_id == 5"
                                                style="top: -6px;" class="absolute right-0 h-3 w-3">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-700 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-800"></span>
                                            </span>

                                            <span v-if="isFocused == index + 1 && index == 2 && seller.insurances_id == 4"
                                                style="top: -6px;" class="absolute right-0 h-3 w-3">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-700 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-800"></span>
                                            </span> -->

                                            <button
                                                v-on:click="insurances_id = seller.insurances_id, time = 'tresmeses', isFocused = index + 1"
                                                class="flex focus:bg-blue-600 focus:border-blue-600 hover:border-blue-600 focus:text-white hover:text-white hover:bg-blue-600 hover:cursor-pointer flex-col items-center justify-center mb-1 text-sm font-semibold text-gray-900 border border-gray-300 bg-white text-center rounded-lg w-full h-16 px-2">
                                                <p>3 Meses</p>
                                                <p>RD$ {{
                                                    new
                                                        Intl.NumberFormat('en-IN').format(seller.tresmeses)
                                                }}.00</p>
                                            </button>
                                        </div>

                                        <!--<input type="button" value="seismeses" name="poliza" v-model="form.policyTime">-->
                                        <div class="relative w-2/5 flex flex-col justify-around items-stretch">

                                            <!-- <span v-show="isFocused1 == index + 1 && index == 0 && seller.insurances_id == 6"
                                                style="top: -6px;" class="absolute right-0 h-3 w-3">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-700 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-800"></span>
                                            </span>

                                            <span
                                                v-show="isFocused1 == index + 1 && index == 1 && seller.insurances_id == 5"
                                                style="top: -6px;" class="absolute right-0 h-3 w-3">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-700 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-800"></span>
                                            </span>

                                            <span
                                                v-show="isFocused1 == index + 1 && index == 2 && seller.insurances_id == 4"
                                                style="top: -6px;" class="absolute right-0 h-3 w-3">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-700 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-800"></span>
                                            </span> -->

                                            <button
                                                v-on:click="insurances_id = seller.insurances_id, time = 'seismeses', isFocused1 = index + 1"
                                                class="flex focus:bg-blue-600 focus:border-blue-600 hover:border-blue-600 focus:text-white hover:text-white hover:bg-blue-600 hover:cursor-pointer flex-col items-center justify-center mb-1 text-sm font-semibold text-gray-900 border border-gray-300 bg-white text-center rounded-lg w-full h-16 px-2">
                                                <p>6 Meses</p>
                                                <p>RD$ {{
                                                    new
                                                        Intl.NumberFormat('en-IN').format(seller.seismeses)
                                                }}.00</p>
                                            </button>
                                        </div>

                                        <div class="relative w-2/5 flex flex-col justify-around items-stretch">

                                            <!-- <span
                                                v-show="isFocused2 == index + 1 && index == 0 && index != 1 && index != 2 && seller.insurances_id == 6 && seller.insurances_id != 5 && seller.insurances_id != 4"
                                                style="top: -6px;" class="absolute right-0 h-3 w-3">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-700 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-800"></span>
                                            </span>

                                            <span
                                                v-show="isFocused2 == index + 1 && index == 1 && index != 0 && index != 2 && seller.insurances_id == 5 && seller.insurances_id != 6 && seller.insurances_id != 4"
                                                style="top: -6px;" class="absolute right-0 h-3 w-3">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-700 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-800"></span>
                                            </span>

                                            <span
                                                v-show="isFocused2 == index + 1 && index == 2 && index != 1 && index != 0 && seller.insurances_id == 4 && seller.insurances_id != 5 && seller.insurances_id != 6"
                                                style="top: -6px;" class="absolute right-0 h-3 w-3">
                                                <span
                                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-700 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-800"></span>
                                            </span> -->

                                            <button
                                                v-on:click="insurances_id = seller.insurances_id, time = 'docemeses', isFocused2 = index + 1"
                                                class="flex focus:bg-blue-600 focus:border-blue-600 hover:border-blue-600 focus:text-white hover:text-white hover:bg-blue-600 hover:cursor-pointer flex-col items-center justify-center mb-1 text-sm font-semibold text-gray-900 border border-gray-300 bg-white text-center rounded-lg w-full h-16 px-2">
                                                <p>Anual</p>
                                                <p>RD$ {{
                                                    new
                                                        Intl.NumberFormat('en-IN').format(seller.docemeses)
                                                }}.00</p>
                                            </button>
                                        </div>
                                    </div>

                                    <button v-show="index == 0" v-on:click="(coberturaMultiS = !coberturaMultiS)"
                                        class="flex items-center text-xs text-blue-700 font-bold mb-1 text-center gap-x-1">Ver
                                        cobertura <img v-if="coberturaMultiS && index == 0" class="w-3"
                                            src="../../../../public/images/Up.png" alt="Up"> <img
                                            v-if="!coberturaMultiS && index == 0 && index != 1 && index != 2" class="w-3"
                                            src="../../../../public/images/down.png" alt="Down">
                                    </button>

                                    <div v-show="coberturaMultiS && index == 0"
                                        class="transition-all duration-500 flex justify-center items-center mb-2">
                                        <p class="font-bold text-base text-blue-700" v-if="sellers[0].DanosPropiedadAjena > 0" >Daños Propiedad Ajena: {{sellers[0].DanosPropiedadAjena }}</p>
                                        <p class="font-bold text-base text-blue-700" v-if="sellers[0].ResponsabilidadCivil > 0">Respon sabilidad Civil: {{sellers[0].ResponsabilidadCivil }}</p>
                                        <p class="font-bold text-base text-blue-700" v-if="sellers[0].ResponsabilidadCivil2 > 0">Respon sabilidad Civil 2: {{sellers[0].ResponsabilidadCivil2 }}</p>
                                        <p class="font-bold text-base text-blue-700" v-if="sellers[0].UnaPersona > 0">Una Persona: {{sellers[0].UnaPersona }}</p>
                                        <p class="font-bold text-base text-blue-700" v-if="sellers[0].FianzaJudicial > 0">Fianza Judicial: {{sellers[0].FianzaJudicial}}</p>
                                    </div>

                                    <button v-show="index == 1" v-on:click="(coberturaSura = !coberturaSura)"
                                        class="transition flex items-center text-xs text-blue-700 font-bold mb-1 text-center gap-x-1">Ver
                                        cobertura <img v-if="coberturaSura && index == 1" class="w-3"
                                            src="../../../../public/images/Up.png" alt="Up"> <img
                                            v-if="!coberturaSura && index == 1 && index != 0 && index != 2" class="w-3"
                                            src="../../../../public/images/down.png" alt="Down">
                                    </button>
                                    <div v-if="coberturaSura && index == 1" class="flex justify-center items-center mb-2">
                                        <p class="font-bold text-base text-blue-700" v-if="sellers[1].DanosPropiedadAjena > 0" >Daños Propiedad Ajena: {{sellers[0].DanosPropiedadAjena }}</p>
                                        <p class="font-bold text-base text-blue-700" v-if="sellers[1].ResponsabilidadCivil > 0">Respon sabilidad Civil: {{sellers[0].ResponsabilidadCivil }}</p>
                                        <p class="font-bold text-base text-blue-700" v-if="sellers[1].ResponsabilidadCivil2 > 0">Respon sabilidad Civil 2: {{sellers[0].ResponsabilidadCivil2 }}</p>
                                        <p class="font-bold text-base text-blue-700" v-if="sellers[1].UnaPersona > 0">Una Persona: {{sellers[0].UnaPersona }}</p>
                                        <p class="font-bold text-base text-blue-700" v-if="sellers[1].FianzaJudicial > 0">Fianza Judicial: {{sellers[0].FianzaJudicial}}</p>
                                    </div>

                                    <button v-if="index == 2" v-on:click="(coberturaAtrio = !coberturaAtrio)"
                                        class="flex items-center text-xs text-blue-700 font-bold mb-1 text-center gap-x-1">Ver
                                        cobertura <img v-if="coberturaAtrio && index == 2" class="w-3"
                                            src="../../../../public/images/Up.png" alt="Up"> <img
                                            v-if="!coberturaAtrio && index == 2 && index != 0 && index != 1" class="w-3"
                                            src="../../../../public/images/down.png" alt="Down">
                                    </button>
                                    <div v-if="coberturaAtrio && index == 2"
                                        class="transform transition-all duration-700 flex justify-center items-center mb-2">
                                        <p class="font-bold text-base text-blue-700" v-if="sellers[2].DanosPropiedadAjena > 0" >Daños Propiedad Ajena: {{sellers[0].DanosPropiedadAjena }}</p>
                                        <p class="font-bold text-base text-blue-700" v-if="sellers[2].ResponsabilidadCivil > 0">Respon sabilidad Civil: {{sellers[0].ResponsabilidadCivil }}</p>
                                        <p class="font-bold text-base text-blue-700" v-if="sellers[2].ResponsabilidadCivil2 > 0">Respon sabilidad Civil 2: {{sellers[0].ResponsabilidadCivil2 }}</p>
                                        <p class="font-bold text-base text-blue-700" v-if="sellers[2].UnaPersona > 0">Una Persona: {{sellers[0].UnaPersona }}</p>
                                        <p class="font-bold text-base text-blue-700" v-if="sellers[2].FianzaJudicial > 0">Fianza Judicial: {{sellers[0].FianzaJudicial}}</p>
                                    </div>

                                </div>
                                <div class="w-full border-t-2 border-gray-700 border-dashed pt-4"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 my-4">
                    <button v-if="!Loading" v-on:click="procesar(insurances_id, time)"
                        class="bg-blue-800 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50">
                        Continuar
                    </button>
                    <button v-else disabled
                        class="bg-blue-800 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50">
                        <svg aria-hidden="true" role="status"
                            class="inline w-7 h-7 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="#E5E7EB" />
                        </svg>
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
        clien_id: String,
        cities: Object,
        provinces: Object,
        clientProvince: Array,
        client: Array,
        tipos: Array,
        marcas: Array,
        modelos: Array,
        coberturaMultiS: false,
        coberturaSura: false,
        coberturaAtrio: false,
    },
    mounted() {
        this.form.servicios = document.getElementById('servicios').value
        console.log(this.sellers)
    },
    data() {
        return {
            Loading: false,
            isFocused: Number,
            isFocused1: Number,
            isFocused2: Number,
            form: {
                car: this.car,
                client: this.client,
                tipos: this.tipos,
                marcas: this.marcas,
                modelos: this.modelos,
                cities: this.cities,
                car: this.car,
                provinces: this.provinces,
                clientProvince: this.clientProvince,
                seller: this.sellers,
                clien_id: this.clien_id,
                servicios: '',
                insurances_id: String,
                time: String,
            },
            form2: {
                cities: this.cities,
                provinces: this.provinces,
                clientProvince: this.clientProvince,
                client: this.client,
                car: this.car,
                tipos: this.tipos,
                marcas: this.marcas,
                modelos: this.modelos
            }
        }
    },
    methods: {
        procesar: function (insurances_id, time) {
            this.Loading = true
            this.$inertia.post(this.route('services', [insurances_id, time]), this.form)
        },
        clientReturn() {
            this.$inertia.post(this.route('clientReturn'), this.form2)
        },
        cartReturn() {
            this.$inertia.post(this.route('carReturn'), this.form2)
        }
    },

}
</script>
