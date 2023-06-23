<template>
    <section class="bg-gray-200 pb-6" :class="{ 'animate-pulse': Loading, 'opacity-50': Loading }">
        <Header :width="65" />
        <section class="p-3 relative rounded-xl bg-white mx-3 z-50 mt-4">

            <div v-if="Loading" class="fixed inset-0 flex items-center justify-center z-50">
                <svg aria-hidden="true" role="status" class="inline w-12 h-12 text-gray-200 animate-spin dark:text-gray-600"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="#E5E7EB" />
                </svg>
            </div>

            <div
                class="flex h-28 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3 max-w-4xl mx-auto">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Asegurado</h3>
                    <p>{{ client.name }} {{ client.lastname }} </p>
                </div>

                <div class="flex flex-col justify-end gap-1 items-center cursor-pointer">
                    <a @click="clientReturn()" class="p-2 min-h-48 min-w-48 rounded-full bg-blue-800">
                        <img src="../../../../public/ima/edit.png" alt="Editar">

                    </a>
                    <p class="text-blue-800 bottom-2 font-bold text-sm">Editar</p>
                </div>
            </div>

            <div
                class="flex h-28 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3 max-w-4xl mx-auto">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Vehículo</h3>
                    <p> {{ car.marcaName }} {{ car.modeloName }}, {{ car.year }}</p>
                </div>
                <div class="flex flex-col justify-end gap-1 items-center cursor-pointer">
                    <a @click="cartReturn()" class="p-2 min-h-48 min-w-48 rounded-full bg-blue-800">
                        <img src="../../../../public/ima/edit.png" alt="Editar">
                    </a>
                    <p class="text-blue-800 bottom-2 font-bold text-sm">Editar</p>
                </div>
            </div>

            <div
                class="relative flex h-28 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3 max-w-4xl mx-auto">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Aseguradora</h3>
                    <p class="mr-14">{{ insurres.nombre }} | {{ services[0].time }} | RD$ {{
                        Intl.NumberFormat('en-IN').format(polizaValor) }}
                    </p>
                </div>
                <div class="absolute right-5 mt-2 flex flex-col justify-end gap-1 items-center cursor-pointer">
                    <a @click="caseguradoraReturn()" class="p-2 min-h-48 min-w-48 rounded-full bg-blue-800">
                        <img src="../../../../public/ima/edit.png" alt="Editar">
                    </a>
                    <p class="text-blue-800 bottom-2 font-bold text-sm">Editar</p>
                </div>

            </div>

            <section
                class="flex flex-col justify-center items-center bg-slate-100 rounded-xl border-2 border-gray-300 mb-2 max-w-4xl mx-auto">

                <div class="p-3">
                    <div class="text-black font-bold text-center text-2xl sm:text-2xl md:text-3xl xl:text-3xl">Servicios
                        Opcionales </div>
                </div>

                <form @submit.prevent="submit">
                    <div class="mx-4 flex flex-col max-w-sm rounded-lg gap-2">
                        <div class="relative flex justify-between items-center p-2 bg-white border border-gray-300 rounded-xl"
                            v-for="service in services" :key="service.id">
                            <div class="flex justify-start items-center">
                                <div>
                                    <input type="checkbox" class=" checked:bg-blue-800 p-1 mx-3 rounded-full" :checked="suma"
                                        :value="service.id" v-model="form.servicios" name="poliza">
                                </div>
                                <div class="flex h-28 flex-col justify-center items-start">
                                    <label class="text-start">{{ service.serviceName }}</label>
    
                                    <label class="font-bold">RD$ {{
                                        new
                                            Intl.NumberFormat('en-IN').format(service.servicePrice)
                                    }}.00
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Imagenes para automoviles -->
                            <img v-if="service.serviceName == 'Casa del Conductor'" src="../../../../public/ima/conductor.png" alt="Conductor">
                            <img v-if="service.serviceName == 'Asistencia Vial (Grua)'" src="../../../../public/ima/grua.png" alt="Grua">
                            <img class="mr-1" v-if="service.serviceName == 'Aumento Fianza Hasta RD$1,000,000 (Veh. Livianos)'" src="../../../../public/ima/plus.png" alt="mas">
                            <img v-if="service.serviceName == 'Accidentes Personales RD$100,000'" src="../../../../public/ima/accidente.png" alt="mas">
                            <img v-if="service.serviceName == 'Ultimos Gastos RD$50,000'" src="../../../../public/ima/gastos.png" alt="mas">
                            <img v-if="service.serviceName == 'Plan Premium Automoviles(500/500/1,000,000 y 1 Millón FJ)'" alt="premium">

                        </div>
                        <div class="w-full mx-5 my-2 justify-self-center self-center text-center">

                            <button v-on:click="submit"
                                class="w-full max-w-xl justify-center bg-blue-800 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-4 mt-5 mx-auto">
                                Continuar
                            </button>
                        </div>
                    </div>
                    <br>
                </form>
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
import { ref, onUnmounted } from 'vue';

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
        provinces: Array,
        clientProvince: Array,
        clientepais: Array,
        paises: Object,
        date: String
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
                insurre: this.insurres,
                client: this.client,
                tipos: this.tipos,
                marcas: this.marcas,
                modelos: this.modelos,
                cities: this.cities,
                provinces: this.provinces,
                clientProvince: this.clientProvince,
                polizaValor: this.polizaValor,
                clientepais: this.clientepais,
                paises: this.paises,
                date: this.date

            }, form2: {
                cities: this.cities,
                provinces: this.provinces,
                clientProvince: this.clientProvince,
                client: this.client,
                car: this.car,
                tipos: this.tipos,
                marcas: this.marcas,
                modelos: this.modelos,
                sellers: this.sellers,
                clien_id: this.clien_id,
                clientepais: this.clientepais,
                paises: this.paises,
            }
        }
    },
    mounted(){
               //Validar si la seccion esta activa
       axios.get("/api/V1/validarCesion/" + this.client.id).then((response) => {
                if(!response.data.status){
                    alert('Su cesión se encuentra inactiva')
                    window.location.href = "https://api.whatsapp.com/send?phone=18494722428&text=Hola";
                }
            })
            .catch((error) => {
                console.log(error.response);
            });

        console.log(this.client)
        //------------------ Guardar Vista por el cliente -------------------------------------
        axios.get(
                "/api/V1/validarVista/"+this.client.id+"/Servicios Opcionales"
           );
        const cuentaRegresiva = () => {
                axios.get(
                "/api/V1/confirmarNegativo/"+this.client.phonenumber
               )
            };

            const timeoutId = setTimeout(cuentaRegresiva, 900000);

            onUnmounted(() => {
                clearTimeout(timeoutId);
            });
    },
    methods: {
        submit() {
            this.Loading = true
            this.$inertia.post(this.route('servicespolicy'), this.form)
        },
        clientReturn() {
            this.Loading = true
            this.$inertia.post(this.route('clientReturn'), this.form2)
        },
        cartReturn() {
            this.Loading = true
            this.$inertia.post(this.route('carReturn'), this.form2)
        },
        caseguradoraReturn() {
            this.Loading = true
            this.$inertia.post(this.route('caseguradoraReturn'), this.form2)
        }
    },
    watch: {
        suma: function () {
            //    console.log('Entro')
        }
    }

}
</script>
