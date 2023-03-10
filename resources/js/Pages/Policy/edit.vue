<template>
    <section class="bg-gray-200 pb-6 h-full">
        <Header :width="75" />
        <section class="p-3 relative rounded-xl bg-white mx-3 z-50 mt-4 ">
            <div
                class="flex min-h-90 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Asegurado</h3>
                    <p>{{ client.name }} {{ client.lastname }} </p>
                </div>

                <div class="flex flex-col justify-end gap-1 items-center">
                    <a @click="clientReturn()" class="p-2 min-h-48 min-w-48 rounded-full bg-blue-800">
                        <img src="../../../../public/ima/edit.png" alt="Editar">
                    </a>
                    <p class="text-blue-800 bottom-2 font-bold text-sm">Editar</p>
                </div>
            </div>

            <div
                class="flex min-h-90 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Vehículo</h3>
                    <p> {{ car.marcaName }} {{ car.modeloName }}, {{ car.year }}</p>
                </div>
                <div class="flex flex-col justify-end gap-1 items-center">
                    <a @click="cartReturn()" class="p-2 min-h-48 min-w-48 rounded-full bg-blue-800">
                        <img src="../../../../public/ima/edit.png" alt="Editar">
                    </a>
                    <p class="text-blue-800 bottom-2 font-bold text-sm">Editar</p>
                </div>
            </div>

            <div
                class="flex min-h-90 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Aseguradora</h3>
                    <p class="mr-14">{{ insurre.nombre }} | {{ policyTime }} | RD$ {{
                        Intl.NumberFormat('en-IN').format(polizaValor) }}
                    </p>
                </div>

                <div class="absolute right-8 mt-2 flex flex-col justify-end gap-1 items-center">
                    <a @click="caseguradoraReturn()" class="p-2 min-h-48 min-w-48 rounded-full bg-blue-800">
                        <img src="../../../../public/ima/edit.png" alt="Editar">
                    </a>
                    <p class="text-blue-800 bottom-2 font-bold text-sm">Editar</p>
                </div>
            </div>

            <div
                class="flex min-h-90 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3 pb-6">
                <div class="flex flex-col w-full justify-end">
                    <div class="flex justify-between items-center gap-x-2 ">
                        <h3 class="font-bold text-lg col-10 mb-1">Servicios Opcionales</h3>

                        <div class="absolute right-8 mt-7">
                            <a @click="serviciosReturn()"
                                class="col-2 p-2 min-h-48 min-w-48 flex justify-center items-center rounded-full bg-blue-800">
                                <img src="../../../../public/ima/edit.png" alt="Editar">
                            </a>
                            <p class="text-blue-800 text-center bottom-2 font-bold text-sm">Editar</p>
                        </div>
                    </div>

                    <p v-for="servicio in service" :key="servicio.id">{{ servicio.serviceName }}: RD$ {{
                        servicio.servicePrice }}.00
                        <br />
                        ------------------------------------------------
                    </p>
                    <p v-if="service.length == 0" class="mt-8 text-center w-full">No hay servivios seleccionados</p>
                    <div class="w-full mx-5 my-2 justify-self-center self-center">
                        <button v-if="!Loading" v-on:click="submit"
                            class="w-full justify-center bg-blue-800 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-4 mt-5 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full">
                            Realizar Compra
                        </button>
                        <button v-else disabled
                            class=" animate-pulse w-full flex justify-center bg-blue-800 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-4 mt-5 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full">
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
                </div>

            </div>
        </section>
        <div class="w-full font-bold text-center pt-8 pb-2 text-lg">
            <h3>Realizara el pago en la plataforma de CardNet</h3>
        </div>
        <div class="w-full font-bold overflow-x-hidden border-t flex gap-2 text-base justify-center pb-8">
            <p>Total a pagar: RD${{ new Intl.NumberFormat('en-IN').format(form.totalGeneral) }}.00</p>
        </div>
        <!-- <Footer class="absolute bottom-0 w-full"></Footer> -->
    </section>
</template>
<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
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
        tarifa: Array,
        sellers: Array,
        seller: Array,
        services: Array,
        service: Array,
        policyTime: String,
        clien_id: String,
        servicios: Object,
        insurre: Array,
        totalGeneral: String,
        marca: String,
        tipo: String,
        modelo: String,
        client: Array,
        tipos: Array,
        marcas: Array,
        modelos: Array,
        cities: Array,
        polizaValor: String,
        clientProvince: Array,
        provinces: Array,
        cities: Array,
    },
    mounted() {
        console.log(this.insurre)
    },
    data() {
        return {
            total: 50,
            Loading: false,
            form: {
                car: this.car,
                tarifa: this.tarifa,
                sellers: this.sellers,
                services: this.services,
                policyTime: this.policyTime,
                clien_id: this.clien_id,
                servicios: [],
                totalGeneral: this.totalGeneral,
                marca: this.marca,
                tipo: this.tipo,
                modelo: this.modelo,
                client: this.client,
                tipos: this.tipos,
                marcas: this.marcas,
                modelos: this.modelos,
                insurre: this.insurre,
            }, form2: {
                car: this.car,
                tarifa: this.tarifa,
                sellers: this.sellers,
                services: this.services,
                policyTime: this.policyTime,
                clien_id: this.clien_id,
                servicios: this.servicios,
                insurre: this.insurre,
                client: this.client,
                tipos: this.tipos,
                marcas: this.marcas,
                modelos: this.modelos,
                polizaValor: this.polizaValor,
                cities: this.cities,
                provinces: this.provinces,
                clientProvince: this.clientProvince,
            }
        }
    },
    methods: {
        submit() {
            this.Loading = true
            this.$inertia.post(this.route('servicesapprove'), this.form)
        },
        clientReturn() {
            this.$inertia.post(this.route('clientReturn'), this.form2)
        },
        cartReturn() {
            this.$inertia.post(this.route('carReturn'), this.form2)
        },
        caseguradoraReturn() {
            this.$inertia.post(this.route('caseguradoraReturn'), this.form2)
        },
        serviciosReturn() {
            this.$inertia.post(this.route('serviciosReturn'), this.form2)
        }
    },
    watch: {

    }
}
</script>
