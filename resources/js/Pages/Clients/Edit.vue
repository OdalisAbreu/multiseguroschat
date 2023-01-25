<template>
    <!-- Pantalla de Carga -->
    <div class="w-screen h-screen imagenFondo flex flex-col items-center justify-center gap-8 text-white p-4"
        v-if="loading">
        <div>
            <h1 class="text-5xl text-center">
                <p class="italic">Seguros<b>Chat</b>
                </p>
            </h1>
        </div>
        <p class="text-center text-lg">La plataforma digital mas segura para comprar el seguro de tu vehiculo</p>
    </div>

    <div class="bg-gray-200 pb-6" v-if="!loading">

        <Header :width="25" />

        <div class="p-6 relative rounded-xl bg-white mx-6 z-50">
            <div class="p-3 px-5 sm:px-5 md:px-5 xl:px-5 bg-slate-100 rounded-xl border-2 border-gray-300 mb-4">
                <div>
                    <div class="text-black text-left font-bold text-2xl sm:text-2xl md:text-3xl xl:text-3xl my-1">
                        Mi Perfil
                    </div>
                    <div class="text-left text-black font-semibold text-md sm:text-1xl md:text-2xl xl:text-2xl mb-4">
                        Confirma tu información
                    </div>
                </div>

                <form @submit.prevent="submit" class="flex flex-col">
                    <label class="pt-2 justify-start font-bold">Nombres
                    </label>
                    <input
                        class="rounded-md h-12 mb-4 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        style="text-transform: uppercase" type="text" placeholder="Nombre" v-model="form.name"
                        required />
                    <label class="pt-2 font-bold">Apellidos
                    </label>
                    <input
                        class="rounded-md h-12 mb-4 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        style="text-transform: uppercase" type="text" placeholder="Apellido" v-model="form.lastname"
                        required />
                    <label class="pt-2 font-bold">Cédula o Pasaporte
                    </label>
                    <input
                        class="rounded-md h-12 mb-4 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        style="text-transform: uppercase" type="text" placeholder="Cédula" v-model="form.cardnumber"
                        required />
                    <label class="pt-2 font-bold">Celular</label>
                    <input
                        class="rounded-md h-12 mb-4 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        style="text-transform: uppercase" type="text" placeholder="Telefono" v-model="form.phonenumber"
                        required />
                    <label class="pt-2 font-bold">Correo Electrónico
                    </label>
                    <input
                        class="rounded-md h-12 mb-4 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        type="text" placeholder="Email" v-model="form.email" required />

                    <label class="pt-2 font-bold">Dirección</label>
                    <input
                        class="rounded-md h-20 mb-4 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        type="text" placeholder="Dirección" v-model="form.adrress" required />
                    <label class="pt-2 font-bold">Provincia</label>
                    <select
                        class="rounded-md h-12 mb-4 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        v-model="province" required>
                        <option :value="clientProvince.id" selected>
                            {{ clientProvince.descrip }}
                        </option>
                        <option v-for="province in provinces" :value="province.id" :key="province.id">
                            {{ province.descrip }}
                        </option>
                    </select>
                    <label class="pt-2 font-bold">Ciudad</label>
                    <select
                        class="rounded-md h-12 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        v-model="form.city" required>
                        <option :value="form.city" selected>
                            {{ form.city }}
                        </option>
                        <option v-for="city in ciudades" :value="city.descrip" :key="city.id">
                            {{ city.descrip }}
                        </option>
                    </select>
                    <div class="w-full mt-5 mx-5 my-4 justify-self-center self-center">
                        <div class="text-red-700 text-sm mb-4">
                            *Todos los campos son obligatorios
                        </div>
                        <button
                            class="w-full justify-center bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-4 mt-5 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full">
                            Continuar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <Footer v-if="!loading" />

</template>
<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Header from "../../components/Header.vue";
import Footer from "../../components/Footer.vue";

export default {
    components: {
        Footer,
        Header,
        Head,
        Link,
    },
    props: {
        client: Object,
        cities: Object,
        provinces: Object,
        clientProvince: Array,
    },
    data() {
        return {
            ciudades: "",
            province: this.client.province,
            loading: true,
            form: {
                name: this.client.name,
                lastname: this.client.lastname,
                adrress: this.client.adrress,
                email: this.client.email,
                cardnumber: this.client.cardnumber,
                city: this.client.city,
                phonenumber: this.client.phonenumber,
                provincia: this.client.province,
            },
        };
    },
    methods: {
        submit() {
            this.$inertia.put(
                this.route("client.update", this.client.id),
                this.form
            );
        },
    },
    mounted() {
        setTimeout(() => {
            this.loading = false
        }, 5000)
    },
    watch: {
        province: function (key) {
            this.ciudades = this.cities.filter(
                (ciudad) => ciudad.id_prov == key
            );
            this.form.city = "";
            this.form.provincia = key;
            console.log(this.ciudades);
        },
    },
};

</script>
<!--Este bloque sirve para crear clases personalizadas-->
<style scoped>

</style>
