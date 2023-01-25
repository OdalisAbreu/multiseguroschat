<template>
    <div class="bg-gray-200 pb-6">
        <section class="bg-blue-700">

            <Header :width="50" />
        </section>

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
                class="flex flex-col p-3 px-5 sm:px-5 md:px-5 xl:px-5 bg-slate-100 rounded-xl border-2 border-gray-300 mb-2">
                <div class="mt-2 py-2">
                    <div class="text-left text-2xl font-bold sm:text-2xl md:text-3xl xl:text-3xl">Datos del Vehículo
                    </div>
                </div>

                <form @submit.prevent="submit" class="flex flex-col">
                    <label class="p-2 font-bold">Tipo de Vehículo
                    </label>
                    <select class="rounded-lg w-full mb-2 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80"
                        v-model="form.tipo" required>
                        <option value="" disabled selected hidden>TIPO DE VEHÍCULO</option>
                        <option v-for="tipo in tipos" :value="tipo.id" :key="tipo.id">{{ tipo.nombre }} </option>
                    </select>
                    <label class="p-2 font-bold">Marca </label>
                    <select class="rounded-lg w-full mb-2 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" v-model="marca"
                        required>
                        <option value="" disabled selected hidden>MARCA</option>
                        <option v-for="marca in marcas" :value="marca.ID" :key="marca.ID">{{ marca.DESCRIPCION }}
                        </option>
                    </select>
                    <label class="p-2 font-bold">Modelo </label>
                    <select class="rounded-lg w-full bt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80"
                        v-model="form.modelo" required>
                        <option value="" disabled selected hidden>MODELO</option>
                        <option v-for="modelo in models" :value="modelo.ID" :key="modelo.ID">{{
                            modelo.descripcion
                        }}
                        </option>
                    </select>
                    <label class="p-2 font-bold">Año </label>
                    <select class="rounded-lg w-full mb-2 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80"
                        v-model="form.year" required>
                        <option value="" disabled selected hidden>AÑO</option>
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
                    </select>
                    <label class="p-2 font-bold">No. de Placa </label>
                    <input class="rounded-lg w-full mb-2 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80"
                        style="text-transform:uppercase;" type="text" placeholder="PLACA" v-model="form.placa" required>
                    <label class="p-2 font-bold">No. de Chassis
                    </label>
                    <input class="rounded-lg w-full sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80"
                        style="text-transform:uppercase;" type="text" placeholder="CHASSIS" v-model="form.chasis"
                        required>

                    <div class="w-full mt-5 mx-5 my-4 justify-self-center self-center">
                        <button
                            class="w-full justify-center bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-4 mt-5 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full">
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
        tipos: Array,
        marcas: Array,
        modelos: Array,
        clien_id: String,
        years: [2022, 2021, 2020]
    },
    data() {
        return {
            models: '',
            marca: '',
            form: {
                tipo: '',
                modelo: '',
                year: '',
                placa: '',
                chasis: '',
                clien_id: this.clien_id,
            }
        }
    },
    mounted() {

    },
    methods: {
        submit() {
            this.$inertia.post(this.route('policy', this.marca), this.form)
        }
    },
    watch: {
        marca: function (value) {
            this.models = this.modelos.filter(model => model.IDMARCA == value)
            console.log('Entro')
        }

    }
}
</script>
