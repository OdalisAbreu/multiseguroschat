<template>
    <div class="w-full mb-2 rounded  overflow-x-hidden border-t flex flex-col bg-black shadow-lg shadow-black-500/50">
        <div class="p-2"> 
           <img class="inline h-12 w-25"  src="/ima/sc2_ic.png" alt="">
        </div>
    </div>
    
    <div class="mx-3 mt-8 mb-4 sm:mx-20 lg:mx-20 xl:mx-20">
        <div class=" bg-gray-200 rounded-full">
            <div class="bg-blue-500 text-xs font-medium text-blue-100 text-center p-1 leading-none rounded-l-full" style="width: 25%"></div>
        </div>
    </div>    

        <div class="p-3">
            <div class="text-black font-bold text-2xl sm:text-2xl md:text-3xl xl:text-3xl">VALIDAR DATOS</div>
            <div class="text-black font-semibold text-lg sm:text-1xl md:text-2xl xl:text-2xl">Confirma tu información y pulsa continuar</div>
        </div>
    <div class="p-3 px-5 sm:px-5 md:px-5 xl:px-5">
        <form @submit.prevent="submit">
            <label class="p-2 font-bold">Nombres <label class="text-red-500">*</label> </label> <br>
            <input class="rounded-lg w-full mb-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" style="text-transform:uppercase;" type="text" placeholder="Nombre" v-model="form.name" required>
            <br><label class="p-2 font-bold">Apellidos <label class="text-red-500">*</label> </label><br>
            <input class="rounded-lg w-full mb-4  sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" style="text-transform:uppercase;" type="text" placeholder="Apellido" v-model="form.lastname" required>
            <br><label class="p-2 font-bold">No. de Cédula <label class="text-red-500">*</label> </label><br>
            <input class="rounded-lg w-full mb-4  sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" style="text-transform:uppercase;" type="text" placeholder="Cédula" v-model="form.cardnumber" required>
            <br><label class="p-2 font-bold">Celular <label class="text-red-500">*</label></label><br>
            <input class="rounded-lg w-full mb-4  sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" style="text-transform:uppercase;" type="text" placeholder="Telefono" v-model="form.phonenumber" required>
            <br><label class="p-2 font-bold">Correo Electrónico <label class="text-red-500">*</label></label><br>
            <input class="rounded-lg w-full mb-4  sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" type="text" placeholder="Email" v-model="form.email" required>
            <br><label class="p-2 font-bold">Provincia<label class="text-red-500">*</label></label><br>
            <select class="rounded-lg w-full mb-4  sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" v-model="province" required>
                <option :value="clientProvince.id"  selected>{{clientProvince.descrip}}</option>
                <option v-for="province in provinces" :value="province.id" :key="province.id">{{province.descrip}} </option >
            </select>
            <br><label class="p-2 font-bold">Ciudad <label class="text-red-500">*</label></label><br>
            <select class="rounded-lg w-full mb-4  sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" v-model="form.city" required>
                <option :value="form.city" selected>{{form.city}}</option>
                <option v-for="city in ciudades" :value="city.descrip" :key="city.id">{{city.descrip}} </option >
            </select>
            <br><label class="p-2 font-bold">Dirección <label class="text-red-500">*</label></label><br>
            <input class="rounded-lg w-full mb-4  sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" type="text" placeholder="Dirección" v-model="form.adrress" required>
                <div class="mt-5 mx-5 my-4">
                    <button class="bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50" >Continuar</button>
                </div>
        </form>
    </div>

</template>
<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components:{
        Head,
        Link
    },
    props: {
        client: Object,
        cities: Object,
        provinces: Object,
        clientProvince: Array
    },
    data(){
        return {
            ciudades: '',
            province: this.client.province,
            form: {
                name: this.client.name,
                lastname: this.client.lastname,
                adrress: this.client.adrress,
                email: this.client.email,
                cardnumber: this.client.cardnumber,
                city: this.client.city,
                phonenumber: this.client.phonenumber,
                provincia: ''
            }
        }
    },
    methods:{
        submit(){
            this.$inertia.put(this.route('client.update', this.client.id), this.form)
        }
    },
    watch: {
             province: function (key){
            this.ciudades = this.cities.filter(ciudad => ciudad.id_prov == key)
            this.form.city = ''
            this.form.provincia = key
            console.log(this.ciudades)
    
         }

    }

}
</script>
<!--Este bloque sirve para crear clases personalizadas-->
<style scoped>

</style>
