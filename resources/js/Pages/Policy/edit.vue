<template>
    <section class="bg-gray-200 pb-6 h-screen">
        <Header :width="65" />
        <section class="p-6 relative rounded-xl bg-white mx-6 z-50 mt-4 ">
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

            <div
                class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-7">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Aseguradora</h3>
                    <p>Multiseguros | Anual | RD$10000</p>
                </div>
                <div class="p-2 rounded-full bg-blue-800">
                    <img src="../../../../public/ima/edit.png" alt="Editar">
                </div>
            </div>

            <div
                class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-7">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Servicios Opcionales</h3>
                    <p>Ultimos Gastos: RD$ 155.00</p>
                </div>
                <div class="p-2 rounded-full bg-blue-800">
                    <img src="../../../../public/ima/edit.png" alt="Editar">
                </div>
            </div>

            <div class="mt-2 mx-5 my-4">
                <button v-on:click="submit"
                    class="bg-blue-800 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50">
                    Continuar
                </button>
            </div>

        </section>
        <Footer class="absolute bottom-0 w-full"></Footer>
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
        services: Array,
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
    },
    mounted() {
        console.log(this.insurres)
    },
    data() {
        return {
            total: 50,
            form: {
                car: this.car,
                tarifa: this.tarifa,
                seller: this.sellers,
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
            },form2: {
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
        submit() {
            console.log('hola')
            this.$inertia.post(this.route('servicesapprove'), this.form)
        },
        clientReturn(){
            this.$inertia.post(this.route('clientReturn'), this.form2)
        },
        cartReturn(){
            this.$inertia.post(this.route('carReturn'), this.form2)
        }
    },
    watch: {
        suma: function () {
            console.log('Entro')
        }
    }
}
</script>
