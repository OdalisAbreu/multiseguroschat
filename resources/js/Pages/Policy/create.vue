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
                <a @click="clientReturn()" class="p-2 rounded-full bg-blue-800">
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
                    <p>{{insurres.nombre}} | {{ services[0].time }} | RD$ {{Intl.NumberFormat('en-IN').format(polizaValor)}}</p>
                </div>
                <div class="p-2 rounded-full bg-blue-800">
                    <img src="../../../../public/ima/edit.png" alt="Editar">
                </div>
            </div>

            <section class="flex flex-col bg-slate-100 rounded-xl border-2 border-gray-300 mb-2">

                <div class="p-3">
                    <div class="text-black font-bold text-center text-2xl sm:text-2xl md:text-3xl xl:text-3xl">Servicios
                        Opcionales </div>
                </div>

                <form @submit.prevent="submit">
                    <div class="mx-4 flex flex-col max-w-sm rounded-lg gap-2">
                        <div class="flex justify-start items-center p-2 bg-white border border-gray-300 rounded-xl"
                            v-for="service in services" :key="service.id">
                            <div>
                                <input type="checkbox" class=" checked:bg-lime-500 p-2 mx-3 rounded-sm" :checked="suma" :value="service.id" v-model="form.servicios"
                                    name="poliza">
                            </div>
                            <div class="flex flex-col justify-center items-start">
                                <label class="">{{ service.serviceName }}</label>

                                <label class="font-bold">RD$ {{
                                    new
                                Intl.NumberFormat('en-IN').format(service.servicePrice)
                                }}.00
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="mt-2 mx-5 my-4">
                        <button
                            class="bg-blue-800 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50">Continuar</button>
                    </div>
                </form>
            </section>
        </section>
    </section>
    <Footer></Footer>

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
        tarifa: Array,
        sellers: Array,
        services: Array,
        policyTime: String,
        clien_id: String,
        insurres: Array,
        client: Array,
        tipos: Array,
        marcas: Array,
        modelos: Array,
        polizaValor: String,
        cities: Array,
    },
    mounted() {
        console.log(this.sellers.indexOf(1))
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
                insurre: this.insurres,
                client: this.client,
                tipos: this.tipos,
                marcas: this.marcas,
                modelos:this.modelos,
                cities: this.cities,
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
            this.$inertia.post(this.route('servicespolicy'), this.form)
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
        //    console.log('Entro')
        }
    }

}
</script>
