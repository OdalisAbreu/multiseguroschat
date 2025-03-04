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
                <div>
                    <div class="text-black text-left font-bold text-2xl sm:text-2xl md:text-3xl xl:text-3xl my-1">
                        Crear Empresa
                    </div>
                    <div class="text-red-700 text-sm mb-4">
                        Los campos con (*) son obligatorios
                    </div>
                </div>

                <form @submit.prevent="submit" class="flex flex-col lg:items-center">
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
                        >Razón Social
                        <span class="text-red-400 inl">*</span></label
                    >
                    <input
                        class="rounded-lg w-full border-gray-300"
                        style="text-transform: uppercase"
                        type="text"
                        placeholder="Razón Social"
                        v-model="form.lastname"
                        required
                    />

                    <label class="pt-1 font-bold">
                        RNC <span class="text-red-400 inl">*</span> </label><br />

                    <!-- <div class="flex justify-center items-center gap-x-8 py-2">
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
                    </div> -->

                    <!-- <div  v-if="!selectedDocument" class="w-full">
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
                    </div> -->

                    <div  class="w-full">
                        <input
                            class="rounded-lg w-full border-gray-300"
                            :class="{'invalid': v$.form.cardnumber.$error || !validateId()}"
                            style="text-transform: uppercase"
                            type="text"
                            placeholder="RNC"
                            v-model="form.cardnumber"
                            maxlength="11"
                        />
                        <!-- <span v-if="v$.form.cardnumber.$error" class="text-red-500">{{ v$.form.cardnumber.$errors[0].$message }}</span>
                        <span v-if="!validateId()" class="text-red-500">Cédula Invalida</span> -->
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
                    />
                    <!-- <label class="pt-1 font-bold">Correo Electrónico </label>
                    <input
                        class="rounded-lg w-full border-gray-300"
                        type="text"
                        placeholder="Email"
                        v-model="form.email"
                    /> -->


                   <CustomInput
                    v-model= "form.adrress"
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

                   <CustomButton
                   :disabled="isCityEmpty || isprovinciaEmpty"
                    Text="Continuar"
                   />
                </form>
            </div>
        </div>
    </section>
</template>
<script>
    import  Nav  from "../../../../components/Nav.vue";
    import  Sider  from "../../../../Components/Sider.vue";
    import { Head, Link } from "@inertiajs/inertia-vue3";
    import CustomButton from "../../../../components/CustomButton.vue";
    import CustomInput from "../../../../components/CustomInput.vue";
    import { ModelListSelect } from "vue-search-select";
    import "vue-search-select/dist/VueSearchSelect.css";
    import { ref, onUnmounted } from "vue";
    import sdq from 'sdq';
    import useVuelidate from "@vuelidate/core";
    import { minLength, numeric,alphaNum, maxLength,requiredIf,helpers,required } from '@vuelidate/validators'

    export default {
    components: {
        Head,
        Link,
        Nav,
        Sider,
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
            nuevaCiudad: [{ descrip: "" }],
            nuevaProvincia: [
                {
                    id: "",
                    descrip: "",
                },
            ],
            selectedDocument: true,
            eleccionPasaporte: false,
            eleccionCedula: true,
            ciudades: "",
            province: "",
            pais: "",
            loading: true,
            cities: this.cities,
            provinces: this.provinces,
            form: {
                name: "",
                lastname: "",
                adrress: "",
                email: "",
                cardnumber: "",
                passportnumber: "",
                city: "",
                phonenumber: "",
                provincia: "",
                pais: "",
                clientProvince: this.clientProvince,
                // car: this.car,
                // tipos: this.tipos,
                // marcas: this.marcas,
                // modelos: this.modelos,
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
                    isValidProvince: helpers.withMessage('Seleccione una de las opciones',() => this.provinces.some(province => province.descrip == this.province))
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
          handleBeforeUnload(event) {
            event.preventDefault();
            event.returnValue = 'Si actualizas la página, perderás los datos ingresados. ¿Estás seguro de que deseas continuar?';
        },
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
                this.$inertia.post(
                    this.route("client.stor"),
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
    //    console.log(this.clientProvince)
    //    axios.get("/api/V1/validarCesion/" + this.client.id).then((response) => {
    //             if(!response.data.status){
    //                 alert('Su sesión se encuentra inactiva')
    //                 window.location.href = "https://api.whatsapp.com/send?phone=18494722428&text=Hola";
    //             }
    //         })
    //         .catch((error) => {
    //             console.log(error.response);
    //         });

        // this.form.city;
        // this.Loading = false;
        // if (this.activarPresentacion == "False") {
        //     this.loading = false;
        // } else {
        //     setTimeout(() => {
        //         this.loading = false;
        //     }, 5000);
        // }
        // const cuentaRegresiva = () => {
        //     axios.get("/api/V1/confirmarNegativo/" + this.client.phonenumber);
        // };

        // const timeoutId = setTimeout(cuentaRegresiva, 900000);

        // onUnmounted(() => {
        //     clearTimeout(timeoutId);
        // });
        //------------------ Guardar Vista por el cliente -------------------------------------
       // axios.get("/api/V1/validarVista/" + this.client.id + "/Editar Cliente");
    },

    /*  */
    watch: {
        province: function (key) {
            this.form.provincia = key;
            this.filterCities();
        },
    },
    computed: {
        optionList() {
            return Object.values(this.paises);
        },
    },
};
</script>

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