<template>
    <section class="bg-gray-200">
        <Header :width="90" />

        <section class="p-3 relative rounded-xl bg-white mx-3 z-50 mt-4"
            :class="{ 'animate-pulse': Loading, 'opacity-50': Loading }">

            <h2 class="px-2 pb-6 text-center font-bold text-2xl">Verifica tu informacion antes de realizar el pago</h2>
            <div class="flex items-center justify-between bg-slate-100 rounded-t-xl border-2 border-gray-100 p-3 px-5 mb-3">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Datos del Asegurado</h3>
                </div>
            </div>

            <div class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-100 p-3 px-5 mb-7">
                <div class="flex flex-col justify-start">
                    <div> <b>Asegurado:</b>
                        <p>{{ cliente.name }} {{ cliente.lastname }}</p>
                    </div>
                    <div> <b>Cédula:</b>
                        <p>{{ cliente.cardnumber }}</p>
                    </div>
                    <div><b>Dirección:</b>
                        <p>{{ cliente.adrress }}</p>
                    </div>
                    <div> <b>Teléfono:</b>
                        <p>{{ cliente.phonenumber }}</p>
                    </div>
                </div>
            </div>

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

            <div class="flex items-center justify-between bg-slate-100 rounded-t-xl border-2 border-gray-100 p-3 px-5 mb-3">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Datos del Vehículo</h3>
                </div>
            </div>

            <div class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-100 p-3 px-5 mb-7">
                <div class="flex flex-col justify-start">
                    <div> <b> Tipo:</b>
                        <p>{{ tipo }}</p>
                    </div>
                    <div> <b> Marca:</b>
                        <p>{{ marca }}</p>
                    </div>
                    <div><b>Modelo:</b>
                        <p> {{ modelo }}</p>
                    </div>
                    <div> <b> Año:</b>
                        <p>{{ car.year }}</p>
                    </div>
                    <div> <b> Chassis:</b>
                        <p><label style="text-transform: uppercase">{{ car.chasis }} </label></p>
                    </div>
                    <div> <b> Registro:</b>
                        <p> <label style="text-transform: uppercase"> {{ car.placa }} </label></p>
                    </div>
                </div>
            </div>
            <div
                class="w-full font-bold rounded  overflow-x-hidden border-t flex flex-col gap-2 text-lg justify-between pt-4">
                <p>Sub Total: ${{ new Intl.NumberFormat('en-IN').format(totalGeneral) }}.00</p>
                <p>Descuento: ${{ new Intl.NumberFormat('en-IN').format(form.descontar) }}.00</p>
                <p>Total a pagar: ${{ new Intl.NumberFormat('en-IN').format(form.totalGeneral) }}.00</p>
            </div>

            <div v-if="!Descuento" class="w-full flex justify-center items-center mt-4">
                <button v-on:click="Descuento = true" href="#" class="text-center text-cyan-400 text-sm font-bold">Tengo
                    código de descuento
                </button>
            </div>

            <div v-if="Descuento" class="p-2 flex flex-col justify-center items-center mt-4">
                <input type="text" placeholder="CÓDIGO DE DESCUENTO" name="codigo" id="codigo">
                <button v-on:click="descuento()" class="text-center text-cyan-400 text-lg font-bold">Aplicar</button>
            </div>

            <div class="w-full flex justify-center mt-5 mx-5 my-4 justify-self-center self-center text-center">
                <button v-if="!Loading" v-on:click="submit"
                    class="w-full max-w-xl justify-center bg-blue-800 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-4 mt-5 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full">
                    Realizar pago
                </button>
            </div>

        </section>
        <Footer class="mt-4" />
    </section>
</template>
<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { watch } from '@vue/runtime-core';
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';

export default {
    components: {
        Head,
        Link,
        Header,
        Footer,
    },
    props: {
        car: Array,
        tarifa: Array,
        sellers: Array,
        services: Array,
        service: Array,
        policyTime: String,
        marca: String,
        tipo: String,
        modelo: String,
        cliente: Array,
        totalGeneral: String,
        insurre: Array,
        codigosDescuento: Array,
        Descuento: false,
    },
    data() {
        return {
            form: {
                car: this.car,
                cliente: this.cliente,
                services: this.services,
                totalGeneral: this.totalGeneral,
                policyTime: this.policyTime,
                sellers: this.sellers,
                descuento: '',
                descontar: 0,
                insurre: this.insurre,
                service: this.service

            },
            Loading: false,
        }
    },
    methods: {
        submit() {
            this.Loading = true
            this.$inertia.post(this.route('generatepolicy'), this.form)
        },
        descuento() {
            console.log(document.getElementById('codigo').value)
            var codigoIngresado = document.getElementById('codigo').value
            var count = 0
            var percentage = 0
            this.codigosDescuento.forEach(function (codigo) {
                if (codigoIngresado == codigo.code) {
                    count++
                    percentage = codigo.discount_amount
                }
            });
            console.log(percentage)
            this.form.descontar = this.totalGeneral * percentage / 100
            var aplicado = this.totalGeneral - this.form.descontar
            console.log(aplicado)
            if (count > 0) {
                this.form.totalGeneral = aplicado
            } else {
                alert('Código vencido o invalido, favor de verificar su código e introducirlo nuevamente')
                document.getElementById('codigo').value = ''
            }
        }
    },
    watch: {
        suma: function () {
            console.log('Entro')
        }
    }

}
</script>
