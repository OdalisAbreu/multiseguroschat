<template>
    <div class="w-full mb-4 rounded  overflow-x-hidden border-t flex flex-col bg-blue-600 shadow-lg shadow-blue-500/50">
        <div class="p-3">
            <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Multiseguros</a>
        </div>
    </div>



</template>
<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
import { watch } from '@vue/runtime-core';
export default {
    components:{
        Head,
        Link
    },
    props:{
       car: Array,
       tarifa: Array,
       sellers: Array,
       token: String,
       services: Array,
       policyTime: String
    },
    mounted(){
    },
    data(){
        return{
            total: 50,
            form:{
                car: this.car,
                tarifa:this.tarifa,
                seller: this.sellers,
                token: this.token,
                services: this.services,
                policyTime: this.policyTime,
                servicios: []

            }
        }
    },
    methods:{
        submit(){
            this.$inertia.post(this.route('servicespolicy'), this.form)
        }
    },
    watch: {
        suma: function(){
            console.log('Entro')
        }
    }

}
</script>
