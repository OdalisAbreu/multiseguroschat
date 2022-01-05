<template>
    <h1>Nuestros Seguros</h1>



</template>
<script>

export default {
    components:{

    },
    props: {
        client: Object,
        token: Object,
        seller: Array
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
