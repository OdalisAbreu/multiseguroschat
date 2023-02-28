<template>
    <section class="bg-gray-200 pb-6 h-screen">
        <Header :width="65" />
        <section class="p-3 relative rounded-xl bg-white mx-3 z-50 mt-4 ">
            <div
                class="flex min-h-90 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-7">
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
                class="flex min-h-90 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-7">
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
                class="flex min-h-90 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-7">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Aseguradora</h3>
                    <p>{{ insurre.nombre }} | {{ policyTime }} | RD$ {{ Intl.NumberFormat('en-IN').format(polizaValor) }}
                    </p>
                </div>

                <div class="flex flex-col justify-end gap-1 items-center">
                    <a @click="caseguradoraReturn()" class="p-2 min-h-48 min-w-48 rounded-full bg-blue-800">
                        <img src="../../../../public/ima/edit.png" alt="Editar">
                    </a>
                    <p class="text-blue-800 bottom-2 font-bold text-sm">Editar</p>
                </div>
            </div>

            <div
                class="flex min-h-90 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-7 pb-10">
                <div class="flex flex-col justify-end">
                    <div class="flex justify-between items-center gap-x-2 ">
                        <h3 class="font-bold text-lg col-10">Servicios Opcionales</h3>

                        <div class="absolute right-8 mt-7 m-x-2">
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
                        ---------------------------
                    </p>
                </div>

            </div>

            <div class="mt-2 mx-5 my-4">
                <button v-on:click="submit"
                    class="bg-blue-800 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50">
                    Continuar
                </button>
            </div>

        </section>
        <!--  <Footer class="absolute bottom-0 w-full"></Footer>-->
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
            console.log('hola')
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
