<template>
    <section class="w-full h-full pb-8">
        <div>
            <Nav :routeName="'Administrador'" class="fixed" />
        </div>
        <Sider />
    </section>
    <section class="w-screen flex flex-col  pt-20 pl-80">
           <div class="p-3 rounded-xl bg-white mx-3 ">
            <div class="p-3 px-5 sm:px-5 md:px-5 xl:px-5 bg-slate-100 rounded-xl border-2 border-gray-300 mb-4 max-w-4xl mx-auto">
                            <section
                class="flex flex-col justify-center items-center bg-slate-100 rounded-xl border-2 border-gray-300 mb-2 max-w-4xl mx-auto">

                <div class="p-3">
                    <div class="text-black font-bold text-center text-2xl sm:text-2xl md:text-3xl xl:text-3xl">Servicios Opcionales </div>
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
                            <img v-if="service.serviceName == 'Casa del Conductor'" src="../../../../../../public/ima/conductor.png" alt="Conductor">
                            <img v-if="service.serviceName == 'Asistencia Vial (Grua)'" src="../../../../../../public/ima/grua.png" alt="Grua">
                            <img class="mr-1" v-if="service.serviceName == 'Aumento Fianza Hasta RD$1,000,000 (Veh. Livianos)'" src="../../../../../../public/ima/plus.png" alt="mas">
                            <img v-if="service.serviceName == 'Accidentes Personales RD$100,000' || service.serviceName == 'Centro del Automovilista'" src="../../../../../../public/ima/accidente.png" alt="mas">
                            <img v-if="service.serviceName == 'Ultimos Gastos RD$50,000'" src="../../../../../../public/ima/gastos.png" alt="mas">
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
            </div>
        </div>
    </section>
</template>
<script>
    import  Nav  from "../../../../components/Nav.vue";
    import  Sider  from "../../../../Components/Sider.vue";
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { onUnmounted  } from 'vue';

    export default {
        components: {
            Nav,
            Sider,
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
        // window.addEventListener('beforeunload', this.handleBeforeUnload);
               //Validar si la seccion esta activa
       axios.get("/api/V1/validarCesion/" + this.client.id).then((response) => {
                if(!response.data.status){
                    alert('Su sesión se encuentra inactiva')
                    window.location.href = "https://api.whatsapp.com/send?phone=18494722428&text=Hola";
                }
            })
            .catch((error) => {
                console.log(error.response);
            });

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
    // beforeUnmount() {
    //     // Remover el evento antes de que se desmonte el componente
    //     window.removeEventListener('beforeunload', this.handleBeforeUnload);
    // },
    methods: {
        //  handleBeforeUnload(event) {
        //     event.preventDefault();
        //     event.returnValue = 'Si actualizas la página, perderás los datos ingresados. ¿Estás seguro de que deseas continuar?';
        // },
        submit() {
            this.Loading = true
            this.$inertia.post(this.route('clients.confirmpolicy'), this.form)
        },
        clientReturn() {
           // this.Loading = true
            this.$inertia.post(this.route('clientReturn'), this.form2)
        },
        cartReturn() {
          //  this.Loading = true
            this.$inertia.post(this.route('carReturn'), this.form2)
        },
        caseguradoraReturn() {
          //  this.Loading = true
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
