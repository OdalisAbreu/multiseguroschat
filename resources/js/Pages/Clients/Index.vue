<template>
    <h1>Nuestros Seguros</h1>

<div v-for="seller in sellers" :key="seller.id">
    {{seller.id}} -
    {{seller.insuranceCarrierName}}
   <Link> Seleccionar </Link>

</div>

</template>
<script>
    import { Link } from '@inertiajs/inertia-vue3'

export default {
    components:{
        Link
    },
    props: {
        client: Object,
        token: Object,
        sellers: Array
    },
    data(){
        return {
            auto: 'Toyota',
        }
    },
    mounted(){
        console.log('Hola Entro el asunto')
        this.getSeller();
    },
    methods: {
        getSeller(){
            console.log( this.seller)
        },
    },
}
</script>
<!--Este bloque sirve para crear clases personalizadas-->
<style scoped>

</style>