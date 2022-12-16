<template>
    <div class="bg-gray-200 pb-6">
        <div class="flex flex-col justify-center bg-blue-700 pb-4">
            <div
                class="justify-self-center self-center mb-2 overflow-x-hidden border-t flex flex-col bg-blue"
            >
                <div class="p-2">
                    <img class="h-12 w-25" src="/ima/sc2_ic.png" alt="" />
                </div>
            </div>

            <div class="mx-3 mt-8 mb-4 sm:mx-20 lg:mx-20 xl:mx-20">
                <div class="bg-gray-200 rounded-full">
                    <div
                        class="bg-blue-500 text-xs font-medium text-blue-100 text-center p-1 leading-none rounded-l-full"
                        style="width: 25%"
                    ></div>
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute z-0">
              
            <path
                fill="rgb(29 78 216)"
                fill-opacity="1"
                d="M0,224L120,202.7C240,181,480,139,720,138.7C960,139,1200,181,1320,202.7L1440,224L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z"
            ></path>
        </svg>
        <div class="p-6 relative rounded-xl bg-white mx-6 z-50">
            <div>
                <div
                    class="text-black font-bold text-2xl sm:text-2xl md:text-3xl xl:text-3xl m-2"
                >
                    Mi Cuenta
                </div>
                <div
                    class="text-center text-black font-semibold text-md sm:text-1xl md:text-2xl xl:text-2xl mb-4"
                >
                    Confirma tu información y pulsa continuar
                </div>
            </div>
            <div
                class="p-3 px-5 sm:px-5 md:px-5 xl:px-5 bg-slate-100 rounded-xl border-2 border-gray-300 mb-4"
            >
                <form @submit.prevent="submit" class="flex flex-col">
                    <label class="p-2 justify-start font-bold"
                        >Nombres <label class="text-red-500">*</label>
                    </label>
                    <input
                        class="rounded-md h-14 mb-4 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        style="text-transform: uppercase"
                        type="text"
                        placeholder="Nombre"
                        v-model="form.name"
                        required
                    />
                    <label class="p-2 font-bold"
                        >Apellidos <label class="text-red-500">*</label>
                    </label>
                    <input
                        class="rounded-md h-14 mb-4 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        style="text-transform: uppercase"
                        type="text"
                        placeholder="Apellido"
                        v-model="form.lastname"
                        required
                    />
                    <label class="p-2 font-bold"
                        >No. de Cédula <label class="text-red-500">*</label>
                    </label>
                    <input
                        class="rounded-md h-14 mb-4 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        style="text-transform: uppercase"
                        type="text"
                        placeholder="Cédula"
                        v-model="form.cardnumber"
                        required
                    />
                    <label class="p-2 font-bold"
                        >Celular <label class="text-red-500">*</label></label
                    >
                    <input
                        class="rounded-md h-14 mb-4 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        style="text-transform: uppercase"
                        type="text"
                        placeholder="Telefono"
                        v-model="form.phonenumber"
                        required
                    />
                    <label class="p-2 font-bold"
                        >Correo Electrónico
                        <label class="text-red-500">*</label></label
                    >
                    <input
                        class="rounded-md h-14 mb-4 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        type="text"
                        placeholder="Email"
                        v-model="form.email"
                        required
                    />
                    <label class="p-2 font-bold"
                        >Provincia<label class="text-red-500">*</label></label
                    >
                    <select
                        class="rounded-md h-14 mb-4 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        v-model="province"
                        required
                    >
                        <option :value="clientProvince.id" selected>
                            {{ clientProvince.descrip }}
                        </option>
                        <option
                            v-for="province in provinces"
                            :value="province.id"
                            :key="province.id"
                        >
                            {{ province.descrip }}
                        </option>
                    </select>
                    <label class="p-2 font-bold"
                        >Ciudad <label class="text-red-500 font-bold">*</label></label
                    >
                    <select
                        class="rounded-md h-12 mb-4 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        v-model="form.city"
                        required
                    >
                        <option :value="form.city" selected>
                            {{ form.city }}
                        </option>
                        <option
                            v-for="city in ciudades"
                            :value="city.descrip"
                            :key="city.id"
                        >
                            {{ city.descrip }}
                        </option>
                    </select>
                    <label class="p-2 font-bold"
                        >Dirección <label class="text-red-500">*</label></label
                    >
                    <input
                        class="rounded-md h-14 mb-4 sm:m-3 sm:w-full md:m-3 md:w-full lg:w-11/12 xl:w-11/12  xl:m-3 shadow-sm border-gray-300"
                        type="text"
                        placeholder="Dirección"
                        v-model="form.adrress"
                        required
                    />
                    <div class="mt-5 mx-5 my-4 justify-self-center self-center">
                        <button
                            class="bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 px-2 mt-5 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full"
                        >
                            Continuar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
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
<style scoped></style>
