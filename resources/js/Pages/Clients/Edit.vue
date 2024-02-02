<template>
    <!-- Pantalla de Carga -->
    <div
        class="w-screen h-screen imagenFondo flex flex-col items-center justify-center gap-8 text-white p-4"
        v-if="loading"
    >
        <div>
            <h1 class="w-80 text-center">
                <img
                    src="../../../../public/ima/Seguros_Chat-11.png"
                    alt="Logo"
                />
            </h1>
        </div>
        <p class="text-center text-lg">
            La plataforma digital más segura para comprar el seguro de tu
            vehiculo
        </p>
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
        <p class="text-center text-lg">Espere por favor</p>

        <!-- <div class="w-screen md:hidden absolute flex flex-col justify-center items-center bottom-0 bg-white">
            <div class="flex justify-center items-center">
                <img class="w-32 mr-2" src="../../../../public/ima/Atrio-Horizontal-sin-fondo.png" alt="Atrio">
                <img class="w-28 mt-6 ml-2" src="../../../../public/ima//sura.png" alt="Sura">
            </div>
            <div>
                <img src="../../../../public/ima/cardnet-payments.jpg" alt="Tarjetas">
            </div>
        </div> -->
    </div>

    <div
        class="bg-gray-200 pb-6"
        v-if="!loading"
        :class="{ 'animate-pulse': Loading, 'opacity-50': Loading }"
    >
        <Header :width="25" />

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

        <div class="p-3 relative rounded-xl bg-white mx-3 z-40">
            <div
                class="p-3 px-5 sm:px-5 md:px-5 xl:px-5 bg-slate-100 rounded-xl border-2 border-gray-300 mb-4 max-w-4xl mx-auto"
            >
                <div>
                    <div
                        class="text-black text-left font-bold text-2xl sm:text-2xl md:text-3xl xl:text-3xl my-1"
                    >
                        Mi Perfil
                    </div>
                    <div
                        class="text-left text-black font-semibold text-md sm:text-1xl md:text-2xl xl:text-2xl mb-2"
                    >
                        Confirma tu información
                    </div>
                    <div class="text-red-700 text-sm mb-4">
                        Los campos con (*) son obligatorios
                    </div>
                </div>

                <form
                    @submit.prevent="submit"
                    class="flex flex-col lg:items-center"
                >
                    <label class="pt-1 justify-start font-bold"
                        >Nombres <span class="text-red-400 inl">*</span>
                    </label>
                    <input
                        class="rounded-lg w-full border-gray-300"
                        style="text-transform: uppercase"
                        type="text"
                        placeholder="Nombre"
                        v-model="form.name"
                        required
                    />
                    <label class="pt-1 font-bold"
                        >Apellidos
                        <span class="text-red-400 inl">*</span></label
                    >
                    <input
                        class="rounded-lg w-full border-gray-300"
                        style="text-transform: uppercase"
                        type="text"
                        placeholder="Apellido"
                        v-model="form.lastname"
                        required
                    />

                    <label class="pt-1 font-bold"
                        >Documento de Identidad
                        <span class="text-red-400 inl">*</span> </label
                    ><br />

                    <div class="flex justify-center items-center gap-x-8 py-2">
                        <div class="flex items-center gap-2">
                            <p>Cédula:</p>
                            <input
                                :checked="selectedDocument"
                                type="radio"
                                @click="changeId"
                            />
                        </div>
                        <div class="flex items-center gap-2">
                            <p>Pasaporte:</p>
                            <input
                                :checked="!selectedDocument"
                                type="radio"
                                value="eleccionPasaporte"
                                @click="changeId"
                            />
                        </div>
                    </div>

                    <div  v-if="!selectedDocument" class="w-full">
                        <input
                            class="rounded-lg w-full border-gray-300"
                            :class="{'invalid': v$.form.passportnumber.$error}"
                            style="text-transform: uppercase"
                            type="text"
                            placeholder="Pasaporte"
                            v-model="form.passportnumber"
                            maxlength="15"
                        />
                        <span v-if="v$.form.passportnumber.$error" class="text-red-500">{{ v$.form.passportnumber.$errors[0].$message }}</span>
                    </div>

                    <div v-if="selectedDocument" class="w-full">
                        <input
                            class="rounded-lg w-full border-gray-300"
                            :class="{'invalid': v$.form.cardnumber.$error || !validateId()}"
                            style="text-transform: uppercase"
                            type="text"
                            placeholder="Cédula"
                            v-model="form.cardnumber"
                            maxlength="11"
                        />
                        <span v-if="v$.form.cardnumber.$error" class="text-red-500">{{ v$.form.cardnumber.$errors[0].$message }}</span>
                        <span v-if="!validateId()" class="text-red-500">Cédula Invalida</span>
                    </div>

                    <div
                        class="w-full flex flex-col lg:items-center"
                        v-if="!selectedDocument"
                    >
                        <label class="mx-auto pt-1 font-bold"
                            >Nacionalidad
                            <span class="text-red-400 inl">*</span></label
                        ><br />
                        <model-list-select
                            class="selectSearch"
                            :list="paises"
                            v-model="form.pais"
                            :value="clientepais.id"
                            required
                            option-value="id"
                            option-text="pais"
                            placeholder="NACIONALIDAD"
                        >
                        </model-list-select>
                    </div>

                    <label class="pt-1 font-bold"
                        >Celular <span class="text-red-400 inl">*</span></label
                    >
                    <input
                        class="rounded-lg w-full border-gray-300"
                        style="text-transform: uppercase"
                        type="text"
                        placeholder="Telefono"
                        v-model="form.phonenumber"
                        disabled
                    />
                    <label class="pt-1 font-bold">Correo Electrónico </label>
                    <input
                        class="rounded-lg w-full border-gray-300"
                        type="text"
                        placeholder="Email"
                        v-model="form.email"
                    />


                   <CustomInput
                    v-model= "hola.hi"
                    labelName="Direccion"
                    typeInput="text"
                    placeholder="Direccion"
                    :is-obligatory="true"
                    :error="v$.form.adrress.$error"
                    :error-message=" v$.form.adrress?.$errors[0]?.$message"
                   />

                    <label class="pt-1 font-bold">Provincia <span class="text-red-400">*</span></label>
                    <div class="relative w-full"> 
                        <input
                            class="rounded-lg w-full border-gray-300"
                            :class="{'invalid': v$.form.provincia.$error}"
                            style="text-transform: uppercase"
                            type="text"
                            placeholder="PROVINCIA"
                            v-model="province"
                            @input="filterProvincias"
                            @focus="handleFocus"
                            @blur="handleBlur"
                            @change="filterCities"
                        />
                        <span v-if="v$.form.provincia.$error" class="text-red-500">{{ v$.form.provincia?.$errors[0]?.$message }}</span>

                        <div v-if="filteredProvinces.length > 0 && showDropdown" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-md" style="max-height: 425px; overflow-y: auto; bottom: 100%;">
                            <ul class="py-2">
                                <li
                                    v-for="province in filteredProvinces"
                                    :key="province.id"
                                    @click="selectProvincia(province)"
                                    class="px-4 py-2 cursor-pointer hover:bg-gray-100"
                                >
                                    {{ province.descrip }}
                                </li>
                            </ul>
                        </div>
                    </div> 

                    <!-- <model-list-select
                        class="selectSearch"
                        selected
                        :list="!provinces ? nuevaProvincia : provinces"
                        v-model="province"
                        :value="province.id"
                        :key="province.id"
                        option-value="id"
                        option-text="descrip"
                        placeholder="PROVINCIA"
                        required
                    >
                    </model-list-select>               -->

                    <label class="pt-1 font-bold">Ciudad <span class="text-red-400 inl">*</span></label>
                    <select
                        class="rounded-lg w-full border-gray-300"
                        :class="{'invalid': v$.form.city.$error}"
                        v-model="form.city"
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
                    <div class="relatice w-full">
                        <span v-if="v$.form.city.$error" class="text-red-500 float-left">{{ v$.form.city.$errors[0].$message }}</span>
                    </div>

                    <!--   <model-list-select
                        class="selectSearch"
                        selected
                        :list="!ciudades ? nuevaCiudad : ciudades"
                        v-model="form.city"
                        :value="form.city.descrip"
                        :key="form.city.id"
                        required
                        option-value="descrip"
                        option-text="descrip"
                        placeholder="CIUDAD"
                    >
                    </model-list-select> -->

                    
                   <CustomButton
                   :disabled="isCityEmpty || isprovinciaEmpty"
                    Text="Continuar"
                   />
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
import CustomButton from "../../components/CustomButton.vue";
import CustomInput from "../../components/CustomInput.vue";
import { ModelListSelect } from "vue-search-select";
import "vue-search-select/dist/VueSearchSelect.css";
import { ref, onUnmounted } from "vue";
import sdq from 'sdq';
import useVuelidate from "@vuelidate/core";
import { minLength, numeric,alphaNum, maxLength,requiredIf,helpers,required } from '@vuelidate/validators'

export default {
    components: {
        Footer,
        Header,
        Head,
        Link,
        ModelListSelect,
        CustomButton,
        CustomInput
    },
    props: {
        client: Object,
        cities: Object,
        paises: Object,
        provinces: Object,
        clientProvince: Object,
        activarPresentacion: String,
        car: Array,
        tipos: Array,
        marcas: Array,
        modelos: Array,
        clientepais: Array,
    },
    data() {
        return {
            isCityEmpty: false,
            isprovinciaEmpty: false,
            nuevaCiudad: [{ descrip: this.client.city }],
            nuevaProvincia: [
                {
                    id: this.client.province,
                    descrip: this.clientProvince.descrip,
                },
            ],
            selectedDocument: true,
            eleccionPasaporte: false,
            eleccionCedula: true,
            ciudades: "",
            province: this.clientProvince.descrip,
            pais: this.client.nacionalidad,
            loading: true,
            form: {
                name: this.client.name,
                lastname: this.client.lastname,
                adrress: this.client.adrress,
                email: this.client.email,
                cardnumber: this.client.cardnumber,
                passportnumber: this.client.passportnumber,
                city: this.client.city,
                phonenumber: this.client.phonenumber,
                provincia: this.client.province,
                pais: this.client.nacionalidad,
                cities: this.cities,
                provinces: this.provinces,
                clientProvince: this.clientProvince,
                car: this.car,
                tipos: this.tipos,
                marcas: this.marcas,
                modelos: this.modelos,
                clientepais: this.clientepais,
                paises: this.paises,
            },
            Loading: false,
            filteredProvinces: [], 
            showDropdown: false,
            blurTimeout: null,
            hola:{hi:"hola mundo"}
        };
    },
    setup: () => ({ v$: useVuelidate() }),
    validations(){
        return{
            form:{
                cardnumber:{
                    required: helpers.withMessage('El campo no puede estar vacio', requiredIf(this.selectedDocument)),
                    numeric: helpers.withMessage('Solo se acepta numeros',numeric),
                    minLength: helpers.withMessage('Debe contener 11 caracteres, sin guiones',minLength(11)),
                }, 
                passportnumber: {
                    required: helpers.withMessage('El campo no puede estar vacio', requiredIf(!this.selectedDocument)),
                    alphaNum: helpers.withMessage('no puede escribir caracteres especiales',alphaNum),
                    minLength: helpers.withMessage('Debe Contener 6 caracteres minimos',minLength(6)),
                    maxLength: helpers.withMessage('Debe Contener 15 caracteres maximos',maxLength(15)),
                },
                provincia:{
                    required: helpers.withMessage('El campo no puede estar vacio', required),
                    isValidProvince: helpers.withMessage('Seleccione una de las opciones',() => this.form.provinces.some(province => province.descrip == this.province))
                },
                city:{
                    required: helpers.withMessage('El campo no puede estar vacio', required),
                },
                adrress:{
                    required: helpers.withMessage('El campo no puede estar vacio', required),
                }
            },
        }
    },
    methods: {
        async submit() {
            const isFormCorrect = await this.v$.form.$validate()
            if(!isFormCorrect || (!this.validateId() && this.selectedDocument))
                return;

            const selectedProvince = this.provinces.find(
                (province) => province.descrip === this.province
                );
                
                if (selectedProvince) {
                 this.Loading = true;
                this.form.provincia = selectedProvince.id;
                this.$inertia.put(
                    this.route("client.update", this.client.id),
                    this.form
                );
            }
        },
        filterProvincias() {
            this.showDropdown = true;
            const searchText = this.province.toLowerCase();
            this.filteredProvinces = this.provinces.filter(province =>
                province?.descrip?.toLowerCase().includes(searchText)
            );
        },
        selectProvincia(province) {
            this.province = province.descrip;
            this.filteredProvinces = [];
            if (this.blurTimeout) {
                clearTimeout(this.blurTimeout);
            }
            this.form.city = "";
        },
        handleFocus() {
            this.filterProvincias();
        },
        handleBlur() {
            this.blurTimeout = setTimeout(() => {
                if (this.filteredProvinces.length === 1) {
                    let province = this.filteredProvinces[0]
                    this.selectProvincia(province)
                }
                else{
                    this.province = ""
                }
                this.showDropdown = false;
            }, 
            200);
        },
        filterCities() {
            if (this.form.provincia) {
                const selectedProvince = this.provinces.find(
                    province => province.descrip === this.form.provincia
                );
                if (selectedProvince) {
                    this.ciudades = this.cities.filter(
                        city => city.id_prov === selectedProvince.id
                    );
                }
            }
            else{
                this.form.city = ""
                this.ciudades = ""
            }
        },   

        /*  validateInput() {
            this.isInputEmpty = this.form.city.trim() === '';
        } */
        validateId(){
            //verifica que sea una cedula dominicana valida
            if(this.form.cardnumber == null)
                return true
            else if(this.form.cardnumber.length !== 11)
                return true
            return sdq.isCedula(this.form.cardnumber)
        },
        changeId(){
            this.selectedDocument = !this.selectedDocument
        },
    },
    mounted() {
       //Validar si la seccion esta activa
       console.log(this.clientProvince)
       axios.get("/api/V1/validarCesion/" + this.client.id).then((response) => {
                if(!response.data.status){
                    alert('Su sesión se encuentra inactiva')
                    window.location.href = "https://api.whatsapp.com/send?phone=18494722428&text=Hola";
                }
            })
            .catch((error) => {
                console.log(error.response);
            });

        this.form.city;
        this.Loading = false;
        if (this.activarPresentacion == "False") {
            this.loading = false;
        } else {
            setTimeout(() => {
                this.loading = false;
            }, 5000);
        }
        const cuentaRegresiva = () => {
            axios.get("/api/V1/confirmarNegativo/" + this.client.phonenumber);
        };

        const timeoutId = setTimeout(cuentaRegresiva, 900000);

        onUnmounted(() => {
            clearTimeout(timeoutId);
        });
        //------------------ Guardar Vista por el cliente -------------------------------------
        axios.get("/api/V1/validarVista/" + this.client.id + "/Editar Cliente");
    },

    /*  */
    watch: {
        province: function (key) {
            this.form.provincia = key;
            this.filterCities();
        },
        /* province: function (key) {
            console.log('Entro');
            this.ciudades = this.cities.filter(
                (ciudad) => ciudad.id_prov == key
            );
            this.form.city = "";
            this.form.provincia = key;
        }, */
        /* "form.city": function () {
            this.isCityEmpty = !this.form.city; // Verifica si form.city es nulo o vacío
        },
        province: function () {
            this.isprovinciaEmpty = !this.province; // Verifica si form.city es nulo o vacío
        }, */
    },
    computed: {
        optionList() {
            return Object.values(this.paises);
        },
    },
};
</script>
<!--Este bloque sirve para crear clases personalizadas-->
<style scoped>
.selectSearch {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 2.6rem;
    margin-bottom: 0.5rem;
    color: rgb(229 231 235 / var(--tw-text-opacity));
}
.invalid {
  background-color: pink;
  border: solid 1px red;
}
</style>