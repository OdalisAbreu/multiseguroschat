<template>
    <div class="w-full mb-4 rounded  overflow-x-hidden border-t flex flex-col bg-blue-600 shadow-lg shadow-blue-500/50">
        <div class="p-3">
            <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Multiseguros</a>
        </div>
    </div>


<div class="antialiased bg-gray-200 text-gray-900 font-sans p-6" v-for="seller in sellers" :key="seller.id">
    <div class="container mx-auto">
        <div class="flex flex-wrap -mx-1 md:flex flex-col">
            <div class="w-full p-4 sm:w-1/4 md:w-1/2 xl:w-1/3">
                <a @click.prevent="sentDate(seller.id)" class="c-card block bg-white shadow-md  hover:shadow-xl rounded-lg overflow-hidden">
                    <div class="relative pb-48 overflow-hidden">
                        <img class="absolute  inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1605152276897-4f618f831968?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80">
                    </div>
                    <div class="p-2">
                        <span class="inline-block px-2 py-1 leading-none bg-orange-200 text-orange-800 rounded-full font-semibold uppercase tracking-wide text-xs">{{seller.id}} -
                            {{seller.insuranceCarrierName}}</span>
                        <h2 class="mt-2 mb-2  font-bold">Compañía De Seguros en Santo Domingo</h2>
                        <p class="text-sm">Calle Doctor Jacinto Ignacio Mañón 15 Santo Domingo República Dominicana.</p>
                            <div class="mt-3 flex items-center">
                            <!--<span class="font-bold text-xl">Click Aqui</span>-->
                            </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!--{{seller.id}} -
    {{seller.insuranceCarrierName}}
   <Link> Seleccionar </Link>-->

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
            auto: 'Toyota',
        }
    },
    methods: {
        getSeller(){
            console.log( this.seller.id)
        },
        sentDate(sellerId){
          var info = new Object();
            info.phone = this.client.phonenumber;
            info.token = this.token.token;
            info.sellerId = sellerId;

           this.$inertia.post(this.route('seguros'), info);
        }
    },
}
</script>
<!--Este bloque sirve para crear clases personalizadas-->
<style scoped>

</style>
