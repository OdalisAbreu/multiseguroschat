<template>
    <section class="bg-gray-200">
        <Header :width="90" />

        <section class="p-6 relative rounded-xl bg-white mx-6 z-50 mt-4 ">
            <h2 class="px-2 pb-6 text-center font-bold text-2xl">Verifica tu informacion antes de realizar el pago</h2>
            <div
                class="flex items-center justify-between bg-slate-100 rounded-t-xl border-2 border-gray-100 p-3 px-5 mb-3">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Datos del Asegurado</h3>
                </div>
            </div>

            <div
                class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-100 p-3 px-5 mb-7">
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

            <div
                class="flex items-center justify-between bg-slate-100 rounded-t-xl border-2 border-gray-100 p-3 px-5 mb-3">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Datos del Vehículo</h3>
                </div>
            </div>

            <div
                class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-100 p-3 px-5 mb-7">
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
                <p>Sub Total: {{ new Intl.NumberFormat('en-IN').format(totalGeneral) }}</p>
                <p>Descuento: {{ new Intl.NumberFormat('en-IN').format(form.descontar) }}</p>
                <p>Total a pagar: {{ new Intl.NumberFormat('en-IN').format(form.totalGeneral) }}</p>
            </div>

            <div v-if="!Descuento" class="w-full flex justify-center items-center mt-4">
                <button v-on:click="Descuento = true" href="#" class="text-center text-cyan-400 text-sm font-bold">Tengo
                    código de descuento</button>
            </div>

            <div v-if="Descuento" class="p-2 flex flex-col justify-center items-center mt-4">
                <input type="text" placeholder="CÓDIGO DE DESCUENTO">
                <button v-on:click="Descuento = false"
                    class="text-center text-cyan-400 text-lg font-bold">Enviar</button>
            </div>

            <div class="mt-2 mx-5 my-4">
                <button v-on:click="submit"
                    class="bg-blue-800 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50">
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
        policyTime: String,
        marca: String,
        tipo: String,
        modelo: String,
        cliente: Array,
        totalGeneral: String,
        insurre: Array,
        Descuento: false,
    },
    mounted() {
        console.log(this.insurre)
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
                insurre: this.insurre

            }
        }
    },
    methods: {
        submit() {
            this.$inertia.post(this.route('generatepolicy'), this.form)
        },
        descuento() {
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
