<template>
    <section
        class="bg-gray-200 h-full pb-4"
        :class="{ 'animate-pulse': Loading, 'opacity-50': Loading }"
    >
        <Header :width="75" />
        <section class="p-3 relative rounded-xl bg-white mx-3 z-50 mt-4">
            <div
                class="flex h-28 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3 max-w-4xl mx-auto"
            >
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Asegurado</h3>
                    <p>{{ client.name }} {{ client.lastname }}</p>
                </div>

                <div
                    class="flex flex-col justify-end gap-1 items-center cursor-pointer"
                >
                    <a
                        @click="clientReturn()"
                        class="p-2 min-h-48 min-w-48 rounded-full bg-blue-800"
                    >
                        <img
                            src="../../../../public/ima/edit.png"
                            alt="Editar"
                        />
                    </a>
                    <p class="text-blue-800 bottom-2 font-bold text-sm">
                        Editar
                    </p>
                </div>
            </div>

            <div
                v-if="Loading"
                class="fixed inset-0 flex items-center justify-center z-50"
            >
                <svg
                    aria-hidden="true"
                    role="status"
                    class="inline w-12 h-12 text-gray-200 animate-spin dark:text-gray-600"
                    viewBox="0 0 100 101"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor"
                    />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="#E5E7EB"
                    />
                </svg>
            </div>

            <div
                class="flex h-28 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3 max-w-4xl mx-auto"
            >
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Vehículo</h3>
                    <p>
                        {{ car.marcaName }} {{ car.modeloName }}, {{ car.year }}
                    </p>
                </div>
                <div
                    class="flex flex-col justify-end gap-1 items-center cursor-pointer"
                >
                    <a
                        @click="cartReturn()"
                        class="p-2 min-h-48 min-w-48 rounded-full bg-blue-800"
                    >
                        <img
                            src="../../../../public/ima/edit.png"
                            alt="Editar"
                        />
                    </a>
                    <p class="text-blue-800 bottom-2 font-bold text-sm">
                        Editar
                    </p>
                </div>
            </div>

            <div
                class="relative flex h-28 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3 max-w-4xl mx-auto"
            >
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Aseguradora</h3>
                    <p class="mr-14">
                        {{ insurre.nombre }} | {{ policyTime }} | RD$
                        {{ Intl.NumberFormat("en-IN").format(polizaValor) }}
                    </p>
                </div>

                <div
                    class="absolute right-5 mt-2 flex flex-col justify-end gap-1 items-center cursor-pointer"
                >
                    <a
                        @click="caseguradoraReturn()"
                        class="p-2 min-h-48 min-w-48 rounded-full bg-blue-800"
                    >
                        <img
                            src="../../../../public/ima/edit.png"
                            alt="Editar"
                        />
                    </a>
                    <p class="text-blue-800 bottom-2 font-bold text-sm">
                        Editar
                    </p>
                </div>
            </div>

            <div
                class="relative flex min-h-90 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3 pb-6 max-w-4xl mx-auto"
            >
                <div class="flex flex-col w-full justify-end">
                    <div
                        class="flex justify-between items-center gap-x-2 mb-10"
                    >
                        <h3 class="font-bold text-lg col-10 mb-1">
                            Servicios Opcionales
                        </h3>

                        <div class="absolute right-5 mt-7 cursor-pointer">
                            <a
                                @click="serviciosReturn()"
                                class="col-2 p-2 min-h-48 min-w-48 flex justify-center items-center rounded-full bg-blue-800"
                            >
                                <img
                                    src="../../../../public/ima/edit.png"
                                    alt="Editar"
                                />
                            </a>
                            <p
                                class="text-blue-800 text-center bottom-2 font-bold text-sm"
                            >
                                Editar
                            </p>
                        </div>
                    </div>

                    <p v-for="servicio in service" :key="servicio.id">
                        {{ servicio.serviceName }}: RD$
                        {{ servicio.servicePrice }}.00
                        <br />
                        -------------------------------------
                    </p>
                    <p v-if="service.length == 0" class="text-center w-full">
                        No hay servivios seleccionados
                    </p>
                </div>
            </div>

            <!-- Loading -->
            <div
                v-if="Loading"
                class="fixed inset-0 flex items-center justify-center z-50"
            >
                <svg
                    aria-hidden="true"
                    role="status"
                    class="inline w-12 h-12 text-gray-200 animate-spin dark:text-gray-600"
                    viewBox="0 0 100 101"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor"
                    />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="#E5E7EB"
                    />
                </svg>
            </div>

            <!--  -->
            <section
                class="flex flex-col items-start justify-center bg-slate-100 rounded-xl border-2 border-gray-300 py-3 max-w-4xl mx-auto"
            >
                <div
                    class="flex mx-auto justify-self-center text-center mb-2 pl-3"
                >
                    <h2 class="font-bold text-xl">Resumen de confirmación</h2>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2">Asegurado:</b>
                    <p class="w-1/2">
                        {{ client.name }} {{ client.lastname }}
                    </p>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2">Cédula:</b>
                    <p class="w-1/2">{{ client.cardnumber }}</p>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2">Dirección:</b>
                    <p class="w-1/2">{{ client.adrress }}</p>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2">Teléfono:</b>
                    <p class="w-1/2">{{ client.phonenumber }}</p>
                </div>

                <div
                    class="w-full flex items-center justify-start text-white bg-blue-800 my-2 pl-3"
                >
                    <h3 class="text-lg">Datos del Vehículo</h3>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2"> Tipo:</b>
                    <p class="w-1/2">{{ tipo }}</p>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2"> Marca:</b>
                    <p class="w-1/2">{{ marca }}</p>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2">Modelo:</b>
                    <p class="w-1/2">{{ modelo }}</p>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2"> Año:</b>
                    <p class="w-1/2">{{ car.year }}</p>
                </div>
                <div class="w-full flex items-center pl-3">
                    <b class="w-1/2"> Chassis:</b>

                    <label
                        class="w-1/2 break-words"
                        style="text-transform: uppercase"
                        >{{ car.chasis }}
                    </label>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2"> Registro:</b>

                    <label class="w-1/2" style="text-transform: uppercase">
                        {{ car.placa }}
                    </label>
                </div>

                <div
                    class="w-full flex items-center justify-start text-white bg-blue-800 my-2 pl-3"
                >
                    <h3 class="text-lg">Coberturas</h3>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2">Daños Prop. Ajena:</b>
                    <p class="w-1/2 flex justify-start items-center">
                        {{
                            Number(
                                sellers[0].DanosPropiedadAjena
                            ).toLocaleString("es-DO", {
                                style: "currency",
                                currency: "DOP",
                            })
                        }}
                    </p>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2">Resp. Civil: (Una persona):</b>
                    <p class="w-1/2 flex justify-start items-center">
                        {{
                            Number(
                                sellers[0].ResponsabilidadCivil
                            ).toLocaleString("es-DO", {
                                style: "currency",
                                currency: "DOP",
                            })
                        }}
                    </p>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2">Resp. Civil (Mas personas):</b>
                    <p class="w-1/2 flex justify-start items-center">
                        {{
                            Number(
                                sellers[0].ResponsabilidadCivil2
                            ).toLocaleString("es-DO", {
                                style: "currency",
                                currency: "DOP",
                            })
                        }}
                    </p>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2">Fianza Judicial:</b>
                    <p class="w-1/2">
                        {{
                            Number(sellers[0].FianzaJudicial).toLocaleString(
                                "es-DO",
                                { style: "currency", currency: "DOP" }
                            )
                        }}
                    </p>
                </div>

                <div
                    class="w-full flex items-center justify-start text-white bg-blue-800 my-2 pl-3"
                >
                    <h3 class="text-lg">Servicios Opcionales</h3>
                </div>

                <div
                    v-for="servicio in service"
                    :key="servicio.id"
                    class="w-full flex gap-2 pl-3"
                >
                    <b class="w-1/2"> {{ servicio.serviceName }}:</b>

                    <label class="w-1/2 flex items-center justify-start" style="text-transform: uppercase">
                        RD${{ servicio.servicePrice }}.00
                    </label>
                </div>
                <p v-if="service.length == 0" class="text-center w-full my-2">
                    No hay servivios seleccionados
                </p>

                <div
                    class="w-full font-bold rounded overflow-x-hidden border-t flex flex-col gap-2 text-lg justify-between pt-4 mt-4 pl-3"
                >
                    <p>
                        Sub Total:
                        {{
                            totalGeneral.toLocaleString("es-DO", {
                                style: "currency",
                                currency: "DOP",
                            })
                        }}
                    </p>

                    <div class="w-full flex justify-center items-center">
                        <button
                            v-if="!Descuento"
                            v-on:click="Descuento = true"
                            href="#"
                            class="text-center px-6 py-2 bg-blue-800 hover:bg-blue-700 text-white text-sm italic"
                        >
                            Tengo código de descuento
                        </button>

                        <div
                            v-if="Descuento"
                            class="flex flex-wrap justify-center items-center"
                        >
                            <input
                                class="border-blue-800"
                                type="text"
                                placeholder="CÓDIGO DE DESCUENTO"
                                name="codigo"
                                id="codigo"
                            />
                            <button
                                v-on:click="descuento()"
                                class="max-w-xl px-6 py-2 text-center bg-blue-800 text-white text-lg font-bold"
                            >
                                Aplicar
                            </button>
                        </div>
                    </div>

                    <p v-if="Descuento">
                        Descuento:
                        {{
                            form3.descontar.toLocaleString("es-DO", {
                                style: "currency",
                                currency: "DOP",
                            })
                        }}
                    </p>
                    <p>
                        Total a pagar:
                        {{
                            form3.totalGeneral.toLocaleString("es-DO", {
                                style: "currency",
                                currency: "DOP",
                            })
                        }}
                    </p>
                </div>
            </section>

             <div class="flex flex-col items-center justify-center">
                <img class="inline max-w-xs" src="ima/cardnetLogo.png" />
                <p class="font-bold text-2xl text-center">Aceptamos:</p>
                <img class="inline pb-12 pt-4 w-56" src="ima/tarjetas.png" />
            </div>

            <div
                class="mx-5 my-1 justify-self-center self-center text-center mt-6"
            >
                <button
                    v-on:click="submit"
                    class="w-full max-w-xl justify-center bg-blue-800 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-4 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full"
                >
                    Realizar Compra
                </button>

                <form 
                :action="`${paymentUrl}`"
                method="POST"
                name="CardNet"
                class="CardNet flex flex-col justify-center items-center"
                id="CardNet"
            >
                <input
                    type="hidden"
                    name="TransactionType"
                    id="TransactionType"
                    value="0200"
                />
                <input
                    type="hidden"
                    name="CurrencyCode"
                    id="CurrencyCode"
                    value="214"
                />
                <input
                    type="hidden"
                    name="AcquiringInstitutionCode"
                    id="AcquiringInstitutionCode"
                    value="349"
                />
                <input
                    type="hidden"
                    name="MerchantType"
                    id="MerchantType"
                    v-model="form.merchanttype"
                />
                <input
                    type="hidden"
                    name="MerchantNumber"
                    id="MerchantNumber"
                    v-model="form.merchantnumber"
                />
                <input
                    type="hidden"
                    name="MerchantTerminal"
                    id="MerchantTerminal"
                    v-model="form.merchantterminal"
                />
                <input
                    type="hidden"
                    name="ReturnUrl"
                    id="ReturnUrl"
                    v-model="form.urlreturn"
                />
                <input
                    type="hidden"
                    name="CancelUrl"
                    id="CancelUrl"
                    v-model="form.urlreturn"
                />
                <input
                    type="hidden"
                    name="PageLanguaje"
                    id="PageLanguaje"
                    value="ESP"
                />
                <input
                    type="hidden"
                    name="OrdenId"
                    id="OrdenId"
                    v-model="form.transaction_uuid"
                />
                <input
                    type="hidden"
                    name="TransactionId"
                    id="TransactionId"
                    v-model="form.transactionid"
                />
                <input
                    type="hidden"
                    name="Amount"
                    id="Amount"
                    v-model="form.total"
                />
                <input type="hidden" name="Tax" id="Tax" v-model="form.tax" />
                <input
                    type="hidden"
                    name="MerchantName"
                    id="MerchantName"
                    v-model="form.client_name"
                />
                <input
                    type="hidden"
                    name="KeyEncriptionKey"
                    id="KeyEncriptionKey"
                    v-model="form.transaction_uuid"
                />
                <input
                    type="hidden"
                    name="Ipclient"
                    id="Ipclient"
                    v-model="form.clientip"
                />
                <input type="hidden" name="loteid" Value="001" />
                <input type="hidden" name="seqid" id="seqid" Value="001" />

                <div
                    class="w-full mt-5 mx-5 my-4 pb-8 justify-self-center self-center text-center"
                >
                    <button
                        :onclick="(Loading = true)"
                        ref="myButton"
                        class="w-full max-w-xl justify-center bg-blue-800 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-4 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full"
                    >Realizar Compra</button>
                </div>
            </form>



            </div>
        </section>
    </section>
    <Footer />
</template>
<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Header from "../../components/Header.vue";
import Footer from "../../components/Footer.vue";
import { ref, onUnmounted } from "vue";

export default {
    components: {
        Footer,
        Header,
        Head,
        Link,
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
        clientepais: Array,
        paises: Object,
        codigosDescuento: Array,
        Descuento: false,

        /*  */


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
                totalGeneral: this.totalGeneral,
                marca: this.marca,
                tipo: this.tipo,
                modelo: this.modelo,
                client: this.client,
                tipos: this.tipos,
                marcas: this.marcas,
                modelos: this.modelos,
                insurre: this.insurre,
                clientepais: this.clientepais,
                paises: this.paises,
                service: this.service,
            },
            form2: {
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
                clientepais: this.clientepais,
                paises: this.paises,
                service: this.service,
            },
            form3: {
                car: this.car,
                cliente: this.client,
                services: this.services,
                totalGeneral: this.totalGeneral,
                policyTime: this.policyTime,
                sellers: this.sellers,
                descuento: "",
                descontar: 0,
                insurre: this.insurre,
                service: this.service,
            },q
        };
    },
    mounted() {
        console.log(this.insurre)
        //------------------ Guardar Vista por el cliente -------------------------------------
        axios.get(
            "/api/V1/validarVista/" +
                this.client.id +
                "/Resumen de confirmación"
        );

        const cuentaRegresiva = () => {
            axios.get("/api/V1/confirmarNegativo/" + this.client.phonenumber);
        };

        const timeoutId = setTimeout(cuentaRegresiva, 900000);

        onUnmounted(() => {
            clearTimeout(timeoutId);
        });
    },
    methods: {
        submit() {
            this.Loading = true;
            this.$inertia.post(this.route("generatepolicy"), this.form3);
        },
        descuento() {
            console.log(document.getElementById("codigo").value);
            var codigoIngresado = document.getElementById("codigo").value;
            var count = 0;
            var percentage = 0;
            this.codigosDescuento.forEach(function (codigo) {
                if (codigoIngresado == codigo.code) {
                    count++;
                    percentage = codigo.discount_amount;
                }
            });
            console.log(percentage);
            this.form.descontar = (this.totalGeneral * percentage) / 100;
            var aplicado = this.totalGeneral - this.form.descontar;
            console.log(aplicado);
            if (count > 0) {
                this.form.totalGeneral = aplicado;
            } else {
                alert(
                    "Código vencido o invalido, favor de verificar su código e introducirlo nuevamente"
                );
                document.getElementById("codigo").value = "";
            }
        },
        clientReturn() {
            this.Loading = true;
            this.$inertia.post(this.route("clientReturn"), this.form2);
        },
        cartReturn() {
            this.Loading = true;
            this.$inertia.post(this.route("carReturn"), this.form2);
        },
        caseguradoraReturn() {
            this.Loading = true;
            this.$inertia.post(this.route("caseguradoraReturn"), this.form2);
        },
        serviciosReturn() {
            this.Loading = true;
            this.$inertia.post(this.route("serviciosReturn"), this.form2);
        },
    },
    watch: {
        suma: function () {
            console.log("Entro");
        },
    },
};
</script>
