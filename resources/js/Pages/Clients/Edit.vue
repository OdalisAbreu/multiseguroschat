<template>
    <div class="w-full mb-4 rounded  overflow-x-hidden border-t flex flex-col bg-blue-600 shadow-lg shadow-blue-500/50">
        <div class="p-3">
            <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Multiseguros</a>
        </div>
    </div>

    <form @submit.prevent="submit">
        <h2>Validar Datos</h2>
        <label>Confirma tu información y pulsa continuar </label>

        <input type="text" placeholder="Nombre" v-model="form.name">
        <input type="text" placeholder="Apellido" v-model="form.lastname">
         <input type="text" placeholder="Cédula" v-model="form.cardnumber">
        <input type="text" placeholder="Telefono" v-model="form.phonenumber">
        <input type="text" placeholder="Email" v-model="form.email">
        <input type="text" placeholder="Ciudad" v-model="form.city">
        <input type="text" placeholder="Pasaporte" v-model="form.passportnumber">
        <input type="text" placeholder="Dirección" v-model="form.adrress">

        <br /> <br />
        <button class="bg-blue-500 py-2 px-4" >Continuar</button>
    </form>


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
