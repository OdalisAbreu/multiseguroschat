<template>
    <div class="bg-gray-200 pb-6" :class="{ 'animate-pulse': Loading, 'opacity-50': Loading }">
        <section class="bg-blue-700">

            <Header :width="50" />
        </section>

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
                class="flex min-h-90 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3">
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
                class="flex flex-col p-3 px-5 sm:px-5 md:px-3 xl:px-3 bg-slate-100 rounded-xl border-2 border-gray-300 mb-2">
                <div class="mt-2 py-2">
                    <div class="text-left text-2xl font-bold sm:text-2xl md:text-3xl xl:text-3xl">Datos del Vehículo
                    </div>
                </div>

                <form @submit.prevent="submit" class="flex flex-col">
                    <label class="pt-1 justify-start font-bold">Tipo de Vehículo <span
                            class="text-red-400 inl">*</span></label>

                    <!-- <select class="rounded-lg w-full mb-2 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80 border-gray-300"
                        v-model="form.tipo" required>
                        <option :value="car.tipoName" disabled selected hidden v-if="car.tipoName != ''">{{ car.tipoName }}
                        </option>
                        <option value="" disabled selected hidden v-else>TIPO DE VEHÍCULO</option>
                        <option v-for="tipo in tipos" :value="tipo.id" :key="tipo.id">{{ tipo.nombre }} </option>
                    </select> -->

                     <model-list-select class="selectSearch" v-model="form.tipo"  :value="tipos.id"
                        :list="tipos" :key="tipos.id" option-value="id" option-text="nombre"
                        placeholder="VEHICULO" required>
                    </model-list-select>

                    <label class="pt-1 font-bold">Marca <span class="text-red-400 inl">*</span></label>
                 <!--    <select class="rounded-lg w-full mb-2 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80 border-gray-300"
                        v-model="marca" required>
                        <option :value="car.marcaName" disabled selected hidden v-if="car.marcaName != ''">{{ car.marcaName
                        }}
                        </option>
                        <option value="" disabled selected hidden v-else>MARCA</option>
                        <option v-for="marca in marcas" :value="marca.ID" :key="marca.ID">{{ marca.DESCRIPCION }}
                        </option>
                    </select> -->

                    <model-list-select class="selectSearch" v-model="marca"  :value="marcas.ID" :list="marcas" :key="marcas.ID" option-value="ID" option-text="DESCRIPCION"
                        placeholder="MARCA" required>
                    </model-list-select>


                    <label class="pt-1 font-bold">Modelo <span class="text-red-400 inl">*</span></label>
                    <!-- <select class="rounded-lg w-full mb-2 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80 border-gray-300"
                        v-model="form.modelo" required>
                        <option :value="car.modeloName" disabled selected hidden v-if="car.modeloName != ''">
                            {{ car.modeloName }}
                        </option>
                        <option value="" disabled selected hidden v-else>MODELO</option>
                        <option v-for="modelo in models" :value="modelo.ID" :key="modelo.ID">{{
                            modelo.descripcion
                        }}
                        </option>
                    </select> -->


                    <model-list-select class="selectSearch" v-model="form.modelo" required :value="car.modeloName" :list="!models ? [{}] : models" :key="car.modeloName" option-value="ID" option-text="descripcion"
                        placeholder="MODELO">
                    </model-list-select>

                    <label class="pt-1 font-bold">Año <span class="text-red-400 inl">*</span></label>
                    <select class="rounded-lg w-full mb-2 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80 border-gray-300"
                        v-model="form.year" required>
                        <option :value="car.year" disabled selected hidden v-if="car.year != ''">{{ car.year }}</option>
                        <option value="" disabled selected hidden v-else>AÑO</option>
                        <option value="2022">2024</option>
                        <option value="2022">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                        <option value="2014">2014</option>
                        <option value="2013">2013</option>
                        <option value="2012">2012</option>
                        <option value="2011">2011</option>
                        <option value="2010">2010</option>
                        <option value="2009">2009</option>
                        <option value="2008">2008</option>
                        <option value="2007">2007</option>
                        <option value="2006">2006</option>
                        <option value="2005">2005</option>
                        <option value="2004">2004</option>
                        <option value="2003">2003</option>
                        <option value="2002">2002</option>
                        <option value="2001">2001</option>
                        <option value="2000">2000</option>
                        <option value="1999">1999</option>
                        <option value="1998">1998</option>
                        <option value="1997">1997</option>
                        <option value="1996">1996</option>
                        <option value="1996">1995</option>
                        <option value="1996">1994</option>
                        <option value="1996">1993</option>
                        <option value="1996">1992</option>
                        <option value="1996">1991</option>
                        <option value="1996">1990</option>
                        <option value="1996">1989</option>
                        <option value="1996">1987</option>
                        <option value="1996">1986</option>
                        <option value="1996">1985</option>
                        <option value="1996">1984</option>
                        <option value="1996">1983</option>
                        <option value="1996">1982</option>
                        <option value="1996">1981</option>
                        <option value="1996">1980</option>
                        <option value="1996">1979</option>
                        <option value="1996">1978</option>
                        <option value="1996">1977</option>
                        <option value="1996">1976</option>
                        <option value="1996">1975</option>
                        <option value="1996">1974</option>
                    </select>




                    <label class="pt-1 font-bold">No. de Placa <span class="text-red-400 inl">*</span></label>
                    <input class="rounded-lg w-full mb-2 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80 border-gray-300"
                        style="text-transform:uppercase;" type="text" maxlength="10" placeholder="PLACA"
                        v-model="form.placa" required>
                    <label class="pt-1 font-bold">No. de Chasis <span class="text-red-400 inl">*</span>
                    </label>
                    <input class="rounded-lg w-full mb-2 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80 border-gray-300"
                        style="text-transform:uppercase;" type="text" maxlength="17" placeholder="CHASIS"
                        v-model="form.chasis" required>

                    <div class="w-full mt-5 mx-5 my-4 justify-self-center self-center text-center">
                        <button
                            class="w-full max-w-xl justify-center bg-blue-800 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-4 mt-5 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full">
                            Continuar
                        </button>
                    </div>
                </form>

            </div>
        </section>
    </div>
    <Footer />
</template>
<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';
import { ModelListSelect } from 'vue-search-select'
import 'vue-search-select/dist/VueSearchSelect.css'
import { ref, onUnmounted } from 'vue';


export default {
    components: {
        Footer,
        Header,
        Head,
        Link,
        ModelListSelect
    },
    props: {
        tipos: Array,
        marcas: Array,
        modelos: Array,
        clien_id: String,
        years: [2022, 2021, 2020],
        cities: Object,
        provinces: Object,
        clientProvince: Array,
        client: Array,
        car: Array,
        clientepais: Array,
        paises: Object
    },
    data() {   
        return {
            newCar: [
                { id: this.car.id, name: this.car.tipoName }
            ],
            models: '',
            marca: this.car.marcaName,
            form: {
                tipo: this.car.tipoName,
                modelo: this.car.modeloName,
                year: this.car.year,
                placa: this.car.placa,
                chasis: this.car.chasis,
                clien_id: this.clien_id,
                cities: this.cities,
                provinces: this.provinces,
                clientProvince: this.clientProvince,
                client: this.client,
                tipos: this.tipos,
                marcas: this.marcas,
                modelos: this.modelos,
                clientepais: this.clientepais,
                paises: this.paises
            },
            form2: {
                cities: this.cities,
                provinces: this.provinces,
                clientProvince: this.clientProvince,
                client: this.client,
                tipos: this.tipos,
                marcas: this.marcas,
                modelos: this.modelos,
                clientepais: this.clientepais,
                paises: this.paises
            },
            Loading: false
        }
    },
    mounted() {
        //------------------ Guardar Vista por el cliente -------------------------------------
        axios.get(
                "/api/V1/validarVista/"+this.client.id+"/Datos del Vehículo"
           );
        this.models = this.modelos.filter(model => model.IDMARCA == this.car.marca)
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
            this.$inertia.post(this.route('policy', this.marca), this.form)
        },
        clientReturn() {
            this.Loading = true
            this.$inertia.post(this.route('clientReturn'), this.form2)
        }
    },
    watch: {
        marca: function (value) {
            this.form.modelo = '';
            this.models = this.modelos.filter(model => model.IDMARCA == value)
            console.log(this.models)
        }

    }
}
</script>

<style scoped>
.selectSearch {
    text-transform: uppercase;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 2.6rem;
    margin-bottom: 0.5rem;
    color: rgb(229 231 235 / var(--tw-text-opacity));
}
</style>
