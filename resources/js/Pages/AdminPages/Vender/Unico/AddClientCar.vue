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
                <div class="">
                    <div
                        class="text-left text-2xl font-bold sm:text-2xl md:text-3xl xl:text-3xl"
                    >
                        Datos del Vehículo
                    </div>
                </div>

                <form @submit.prevent="submit" class="flex flex-col">
                    <label class="pt-1 justify-start font-bold"
                        >Tipo de Vehículo
                        <span class="text-red-400 inl">*</span></label
                    >

                    <select
                        class="rounded-lg w-full border-gray-300"
                        v-model="form.tipo"
                        required
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
                            v-for="tipo in tipos"
                            :value="tipo.id"
                            :key="tipo.id"
                        >
                            {{ tipo.nombre }}
                        </option>
                    </select>

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

                    <label class="pt-1 font-bold">Modelo <span class="text-red-400 inl">*</span></label>
                    <div class="relative">
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
<!-- 
                    <label class="pt-1 justify-start font-bold"
                        >Uso
                        <span class="text-red-400 inl">*</span></label
                    >

                    <select
                        class="rounded-lg w-full border-gray-300"
                        v-model="form.tipoUso"
                        required
                    >
                        <option value="" disabled selected>
                            Uso
                        </option>
                        <option value="publico">
                            Público
                        </option>
                        <option value="privado">
                            Privado
                        </option>
                        <option value="privado">
                            Taxi
                        </option>
                        <option value="privado">
                            Transporte Turístico
                        </option>
                        <option value="privado">
                            Transporte Escolar
                        </option>
                    </select> -->

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
                        type="text"
                        maxlength="10"
                        placeholder="PLACA"
                        v-model="form.placa"
                        required
                    />
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
        </div>
    </section>
</template>
<script>
    import  Nav  from "../../../../components/Nav.vue";
    import  Sider  from "../../../../Components/Sider.vue";
    import { Head, Link } from "@inertiajs/inertia-vue3";
    import Header from "../../../../components/Header.vue";
    import Footer from "../../../../components/Footer.vue";
    import { ModelListSelect } from "vue-search-select";
    import "vue-search-select/dist/VueSearchSelect.css";
    import { ref, onUnmounted,  onMounted } from "vue";
    import useVuelidate from "@vuelidate/core";
    import { minLength, alphaNum, maxLength, helpers, required} from '@vuelidate/validators';

 export default {
    components: {
        Footer,
        Header,
        Head,
        Link,
        ModelListSelect,
        Nav,
        Sider
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
                tipoUso: "",
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
        };
    },
    setup: () => ({ v$: useVuelidate() }),
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
        // window.addEventListener('beforeunload', this.handleBeforeUnload);

        //Validar si la seccion esta activa
        // axios
        //     .get("/api/V1/validarCesion/" + this.client.id)
        //     .then((response) => {
        //         if (!response.data.status) {
        //             alert("Su cesión se encuentra inactiva");
        //             window.location.href =
        //                 "https://api.whatsapp.com/send?phone=18494722428&text=Hola";
        //         }
        //     })
        //     .catch((error) => {
        //         console.log(error.response);
        //     });
        //------------------ Guardar Vista por el cliente -------------------------------------
        axios.get(
            "/api/V1/validarVista/" + this.client.id + "/Datos del Vehículo"
        );
        this.models = this.modelos.filter(
            (model) => model.IDMARCA == this.car.marca
        );
        // const cuentaRegresiva = () => {
        //     axios.get("/api/V1/confirmarNegativo/" + this.client.phonenumber);
        // };

        // const timeoutId = setTimeout(cuentaRegresiva, 900000);

        // onUnmounted(() => {
        //     clearTimeout(timeoutId);
        // });
    },
    methods: {
        async submit() {
            const isFormCorrect = await this.v$.form.$validate()
            if(!isFormCorrect)
                return;
            this.Loading = true;
           this.$inertia.post(this.route("clients.addcar", this.form.marca), this.form);
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
        }
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

