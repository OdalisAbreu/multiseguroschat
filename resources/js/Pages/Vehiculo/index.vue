<template>
    <h1>Aqui se crean los Vehiculos</h1>
</template>
<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
export default {
    components:{
        Head,
        Link
    },
    props:{
       tipos: Array,
       marcas: Array,
       modelos: Array,
       token: String,


    },
}
</script>
