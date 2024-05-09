<template>
    <div
        class="bg-gray-200 pb-6"
        :class="{ 'animate-pulse': Loading, 'opacity-50': Loading }"
    >
        <section class="bg-blue-700">
            <Header :width="50" />
        </section>

        <section class="p-3 relative rounded-xl bg-white mx-3 z-50 mt-4">
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
                class="flex min-h-90 items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3 max-w-4xl mx-auto"
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
                        class="p-2 rounded-full bg-blue-800"
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
                class="flex flex-col p-3 px-5 sm:px-5 md:px-3 xl:px-3 bg-slate-100 rounded-xl border-2 border-gray-300 mb-2 max-w-4xl mx-auto"
            >
                <div class="mt-2 py-2">
                    <div
                        class="text-left text-2xl font-bold sm:text-2xl md:text-3xl xl:text-3xl"
                    >
                        Datos del Vehículo
                    </div>
                </div>

                <form @submit.prevent="submit" class="flex flex-col">
                    
                    <!-- <model-list-select
                        class="selectSearch"
                        v-model="form.tipo"
                        :value="tipos.id"
                        :list="tipos"
                        :key="tipos.id"
                        option-value="id"
                        option-text="nombre"
                        placeholder="VEHICULO"
                        required
                    >
                    </model-list-select> -->

                    <label class="pt-1 font-bold">Marca <span class="text-red-400">*</span></label>
                    <div class="relative">
                        <input
                            class="rounded-lg w-full border-gray-300"
                            :class="{'invalid': v$.form.marca.$error}"
                            style="text-transform: uppercase"
                            type="text"
                            placeholder="MARCA"
                            v-model="form.marca"
                            @input="filterMarcas"
                            @focus="handleFocus"
                            @blur="handleBlur"
                        />
                        <span v-if="v$.form.marca.$error" class="text-red-500">{{ v$.form.marca.$errors[0].$message }}</span>
                        <div v-if="filteredMarcas.length > 0 && showDropdown" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-md" style="max-height: 425px; overflow-y: auto;">
                            <ul class="py-2">
                                <li
                                    v-for="marca in filteredMarcas"
                                    :key="marca.ID"
                                    :value="marca.ID"
                                    @click="selectMarca(marca)"
                                    class="px-4 py-2 cursor-pointer hover:bg-gray-100 w-full"
                                >
                                    {{ marca.DESCRIPCION }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!--  <model-list-select
                        class="selectSearch"
                        v-model="marca"
                        :value="marcas.ID"
                        :list="marcas"
                        :key="marcas.ID"
                        option-value="ID"
                        option-text="DESCRIPCION"
                        placeholder="MARCA"
                        required
                    >
                    </model-list-select> -->

                    <label class="pt-1 font-bold">Modelo <span class="text-red-400 inl">*</span></label>
                    <div class="relative">
                        <!-- <input
                            class="rounded-lg w-full border-gray-300"
                            type="text"
                            placeholder="MODELO"
                            v-model="modelo"
                            @input="filterModelos"
                            @focus="handleModeloFocus"
                            @blur="handleModeloBlur"
                            required
                        />
                        <div v-if="filteredModelos.length > 0 && showModeloDropdown" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-md" style="max-height: 425px; overflow-y: auto;">
                            <ul class="py-2">
                                <li
                                    v-for="modelo in filteredModelos"
                                    :key="modelo.ID"
                                    @click="selectModelo(modelo)"
                                    class="px-4 py-2 cursor-pointer hover:bg-gray-100"
                                >
                                    {{ modelo.descripcion }}
                                </li>
                            </ul>
                        </div> -->
                        <model-list-select
                           class="selectSearch"
                           :class="{'invalid': v$.form.modelo.$error}"
                           v-model="form.modelo"
                           :value="car.modeloName"
                           :list="!models ? [{}] : models"
                           :key="car.modeloName"
                           option-value="ID"
                           option-text="descripcion"
                           placeholder="MODELO"
                       >
                       </model-list-select>
                    </div>                
                    <span v-if="v$.form.modelo.$error" class="text-red-500">{{ v$.form.modelo.$errors[0].$message }}</span>

                    <label class="pt-1 justify-start font-bold"
                        >Tipo de Vehículo
                        <span class="text-red-400 inl">*</span></label
                    >

                    <select
                        class="rounded-lg w-full border-gray-300"
                        v-model="form.tipo"
                    >
                        <option
                            :value="car.tipoName"
                            disabled
                            selected
                            hidden
                            v-if="car.tipoName != ''"
                        >
                            {{ car.tipoName }}
                        </option>
                        <option value="" disabled selected hidden v-else>
                            TIPO DE VEHÍCULO
                        </option>
                        <option
                            v-for="tipo in vehicletype"
                            :value="tipo.Id"
                            :key="tipo.Id"
                        >
                            {{ tipo.Name }}
                        </option>
                    </select>

                    <label class="pt-1 font-bold"
                        >Año <span class="text-red-400 inl">*</span></label
                    >
                    <select
                        class="rounded-lg w-full border-gray-300"
                        v-model="form.year"
                        required
                    >
                        <option
                            :value="car.year"
                            disabled
                            selected
                            hidden
                            v-if="car.year != ''"
                        >
                            {{ car.year }}
                        </option>
                        <option value="" disabled selected hidden v-else>
                            AÑO
                        </option>
                        <option v-for="year in years" :value="year">{{ year }}</option>
                    </select>

                    
                    <label class="pt-1 font-bold"
                        >No. de Placa
                        <span class="text-red-400 inl">*</span></label
                    >
                    <input
                        class="rounded-lg w-full border-gray-300"
                        style="text-transform: uppercase"
                        :class="{'invalid': v$.form.placa.$error}"
                        type="text"
                        maxlength="10"
                        placeholder="PLACA"
                        v-model="form.placa"
                    />
                    <span v-if="v$.form.placa.$error" class="text-red-500">{{ v$.form.placa.$errors[0].$message }}</span>


                    <label class="pt-1 font-bold"
                        >No. de Chasis <span class="text-red-400 inl">*</span>
                    </label>
                    <input
                        class="rounded-lg w-full border-gray-300"
                        :class="{'invalid': v$.form.chasis.$error}"
                        style="text-transform: uppercase"
                        type="text"
                        maxlength="17"
                        placeholder="CHASIS"
                        v-model="form.chasis"
                        @input="cleanSpaces"
                    />
                    <span v-if="v$.form.chasis.$error" class="text-red-500">{{ v$.form.chasis.$errors[0].$message }}</span>
                    
                    <div
                        class="w-full mt-5 mx-5 my-4 justify-self-center self-center text-center"
                    >
                        <button
                            :disabled="
                                isTipoCarroEmpty ||
                                isMarcaEmpty ||
                                isModeloEmpty
                            "
                            class="w-full max-w-xl justify-center bg-blue-800 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-4 mt-5 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full"
                        >
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
import { Head, Link, router } from "@inertiajs/inertia-vue3";
import Header from "../../components/Header.vue";
import Footer from "../../components/Footer.vue";
import { ModelListSelect } from "vue-search-select";
import "vue-search-select/dist/VueSearchSelect.css";
import { ref, onUnmounted } from "vue";
import useVuelidate from "@vuelidate/core";
import { minLength, alphaNum, maxLength, helpers, required} from '@vuelidate/validators'
import axios from "axios";
import swal from 'sweetalert';

export default {
    components: {
        Footer,
        Header,
        Head,
        Link,
        ModelListSelect,
    },
    props: {
        tipos: Array,
        marcas: Array,
        modelos: Array,
        clien_id: String,
        cities: Object,
        provinces: Object,
        clientProvince: Object,
        client: Object,
        car: Object,
        clientepais: Array,
        paises: Object,
    },
    data() {
        return {
            v$: useVuelidate(),
            years: [2022, 2021, 2020],
            isTipoCarroEmpty: false,
            isMarcaEmpty: false,
            isModeloEmpty: false,
            newCar: [{ id: this.car.id, name: this.car.tipoName }],
            models: "",
            form: {
                tipo: this.car.tipoName,
                modelo: this.car.modeloName,
                marca: this.car.marcaName,
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
                paises: this.paises,
                error: "",
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
                paises: this.paises,
            },
            Loading: false,
            years: [],
            filteredMarcas: [], 
            showDropdown: false,
            blurTimeout: null,
            selectedBrand: this.car.marca,
            filteredModelos: [], 
            showModeloDropdown: false,
            vehicletype: [],
            countErrorPlate: 0,
            selectedType: ""
        };
    },
    validations(){
        return{

            form:{
                marca: {
                    required: helpers.withMessage('El campo no puede estar vacio', required),
                    isValidBrand: helpers.withMessage('Esta no es un marca valida',() => this.marcas.some(brand => brand.DESCRIPCION == this.form.marca))
                },
                modelo: {
                    required: helpers.withMessage('El campo no puede estar vacio', required),
                }, 
                placa: {
                    required: helpers.withMessage('El campo no puede estar vacio', required),
                    isValidPlate: helpers.withMessage('Esta no es un placa valida',() => this.isValidPlate)
                },
                chasis:{
                    required: helpers.withMessage('El campo no puede estar vacio', required),
                    alphaNum: helpers.withMessage('no puede escribir caracteres especiales',helpers.regex(/^[a-zA-Z0-9\\-]+$/)),
                    minLength: helpers.withMessage('Chasis inválido o incompleto',minLength(8)),
                    maxLength: helpers.withMessage('Chasis inválido o incompleto',maxLength(17)),
                },
            },
        }
    },
    created() {
        for (let year = 2024; year >= 1970; year--) {
        this.years.push(year.toString());
        }
    },
    mounted() {
        this.isRestrictedNumberphone();
        //Validar si la seccion esta activa
        axios
            .get("/api/V1/validarCesion/" + this.client.id)
            .then((response) => {
                if (!response.data.status) {
                    alert("Su cesión se encuentra inactiva");
                    window.location.href =
                        "https://api.whatsapp.com/send?phone=18494722428&text=Hola";
                }
            })
            .catch((error) => {
                console.log(error.response);
            });
        //------------------ Guardar Vista por el cliente -------------------------------------
        axios.get(
            "/api/V1/validarVista/" + this.client.id + "/Datos del Vehículo"
        );
        this.models = this.modelos.filter(
            (model) => model.IDMARCA == this.car.marca
        );
        const cuentaRegresiva = () => {
            axios.get("/api/V1/confirmarNegativo/" + this.client.phonenumber);
        };

        const timeoutId = setTimeout(cuentaRegresiva, 900000);

        onUnmounted(() => {
            clearTimeout(timeoutId);
        });
    },
    watch: {
        'form.modelo': function (){
            if(!this.form.modelo)
                return
            this.getTypeVehicle();
        },
    },
    computed:{
        errorTransform () {
            let errors = this.v$.form.$silentErrors.map(item => item.$uid)
           this.form.error =  errors.join(", ")
           return this.form.error
        },
        isValidPlate(){
          this.selectedType = this.vehicletype?.find(item => item.Id === this.form?.tipo)
          const plateArray = this.selectedType?.Plate?.split(',')
          const result = plateArray?.some(item => this.form.placa.toLowerCase().startsWith(item.toLowerCase()))
          return result
        }
    },
    methods: {
        async submit() {
            const isInvalid = this.v$.form.$invalid
            if(isInvalid){
                await axios.post('/errorLogs',this.form)
                swal('Error',"Tiene errores en el formulario", "error");
                await this.v$.form.$validate()

                if(this.v$.form.placa.isValidPlate.$invalid && this.form.placa)
                { 
                    this.countErrorPlate++
                    if(this.countErrorPlate > 3){
                        await axios.post('/SavePhoneNumber',{phonenumber:this.client.phonenumber})
                        swal('Contacte a servico Tecnico',"Su solicitud no pudo ser completada, favor contactar con servicio al cliente.", "error");
                        this.$inertia.visit('../Blocked')
                    }
                }
                return
            }
            this.Loading = true;
           this.$inertia.post(this.route("policy", this.form.marca), this.form);
        },
        clientReturn() {
            this.Loading = true;
            this.$inertia.post(this.route("clientReturn"), this.form2);
        },
        filterMarcas() {
            if(!this.form.marca){
                this.form.modelo = ""
                this.models = ""
            }
            this.showDropdown = true;
            const searchText = this.form.marca.toLowerCase();
            this.filteredMarcas = this.marcas.filter((marca) =>
                marca.DESCRIPCION.toLowerCase().includes(searchText)
            );
        },
        
        filterModelos() {            
            this.showModeloDropdown = true;
            const searchText = this.modelo.toLowerCase();
            this.filteredModelos = this.models.filter((modelo) =>
                modelo.descripcion.toLowerCase().includes(searchText)
            );
        },

        selectModelo(modelo) {    
            this.modelo = modelo.descripcion;
            this.filteredModelos = [];
        },

        handleModeloFocus() {
            this.filterModelos(); 
        },

        handleModeloBlur() {
            this.blurTimeout = setTimeout(() => {
                this.showModeloDropdown = false;
            }, 200);
        },

        updateModels() {    
            this.models = this.modelos.filter(
                (model) => model.IDMARCA === this.selectedBrand
            );
        },

        selectMarca(marca) {    
            this.form.marca = marca.DESCRIPCION;
            this.selectedBrand = marca.ID; 
            this.filteredMarcas = [];
            this.updateModels();
        },

        handleFocus() {
            this.filterMarcas()
        },
        handleBlur() {
            this.blurTimeout = setTimeout(() => {
                if (this.filteredMarcas.length === 1) {
                    let marca = this.filteredMarcas[0]
                    this.selectMarca(marca)
                }
                this.showDropdown = false;
            }, 200);
        },
        cleanSpaces(){
            this.form.chasis = this.form.chasis.trim()
        },
        async getTypeVehicle() {
            try {
                const response = await axios.get(`/getTypeVehicle/${this.form.modelo}`);
                const data = response.data;
                this.vehicletype = data
            } catch (error) {
                console.error(error);
            }
        },
        async isRestrictedNumberphone(){
           const response = await axios.post('/IsRestricted',{phonenumber:this.client.phonenumber})
           if(response.data){
               this.$inertia.visit('../Blocked')
           }
        }
/*         showConfirmation(event) {
            event.preventDefault();
            event.returnValue = ""; // Necesario para mostrar el mensaje en algunos navegadores antiguos
            return "¿Estás seguro de que quieres salir? Todos los cambios no guardados se perderán.";
        }, */
    },    
    beforeUnmount() {
        if (this.mostrarConfirmacion == true) {
            window.removeEventListener("beforeunload", this.showConfirmation);
        }
    },
};
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
.invalid {
  background-color: pink !important;
  border: solid 1px red !important;
}
</style>