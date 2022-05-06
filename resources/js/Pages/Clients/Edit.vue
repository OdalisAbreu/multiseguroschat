<template>
    <div class="w-full mb-4 rounded  overflow-x-hidden border-t flex flex-col bg-blue-600 shadow-lg shadow-blue-500/50">
        <div class="p-3">
            <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Seguros Chat</a>
        </div>
    </div>

    
    <div class="mx-3 mt-8 mb-4 sm:mx-20 lg:mx-20 xl:mx-20">
        <div class=" bg-gray-200 rounded-full">
            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-l-full" style="width: 25%"> 25%</div>
        </div>
    </div>    

        <div class="p-3">
            <div class="text-black font-bold text-2xl sm:text-2xl md:text-3xl xl:text-3xl">VALIDAR DATOS</div>
            <div class="text-black font-semibold text-lg sm:text-1xl md:text-2xl xl:text-2xl">Confirma tu información y pulsa continuar</div>
        </div>
    <div class="px-5 sm:px-5 md:px-5 xl:px-5">
        <form @submit.prevent="submit">
            <input class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" type="text" placeholder="Nombre" v-model="form.name">
            <input class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" type="text" placeholder="Apellido" v-model="form.lastname">
            <input class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" type="text" placeholder="Cédula" v-model="form.cardnumber">
            <input class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" type="text" placeholder="Telefono" v-model="form.phonenumber">
            <input class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" type="text" placeholder="Email" v-model="form.email">
            <input class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" type="text" placeholder="Ciudad" v-model="form.city">
            <input class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" type="text" placeholder="Pasaporte" v-model="form.passportnumber">
            <input class="rounded-lg w-full mt-4 sm:m-3 sm:w-40 md:m-3 md:w-60 xl:m-3 xl:w-80" type="text" placeholder="Dirección" v-model="form.adrress">
                <div class="mt-5">
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
        token: Object,
        sellers: Array
    },
    data(){
        return {
            form: {
                name: this.client.name,
                lastname: this.client.lastname,
                adrress: this.client.adrress,
                email: this.client.email,
                cardnumber: this.client.cardnumber,
                city: this.client.city,
                passportnumber: this.client.passportnumber,
                phonenumber: this.client.phonenumber,
                token: this.token.token
            }
        }
    },
    methods:{
        submit(){
            this.$inertia.put(this.route('client.update', this.client.id), this.form)
        }
    },
    mounted(){
    }
}
</script>
<!--Este bloque sirve para crear clases personalizadas-->
<style scoped>

</style>
