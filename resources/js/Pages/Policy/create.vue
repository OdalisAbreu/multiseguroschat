<template>
    <section class="bg-gray-200 pb-6"> 
       <Header :width="65" />
            <section class="p-6 relative rounded-xl bg-white mx-6 z-50 mt-4">
                            <div
                class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-7">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Asegurado</h3>
                    <p>RAFAEL DE LA CRUZ</p>
                </div>
                <div class="p-4 rounded-full bg-blue-700">
                    <img src="../../../../public/ima/edit.png" alt="Editar">
                </div>
            </div>

            <div
                class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-7">
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Poliza</h3>
                    <p>BMW Serie 430, 2012</p>
                </div>
                <div class="p-4 rounded-full bg-blue-700">
                    <img src="../../../../public/ima/edit.png" alt="Editar">
                </div>
            </div>

                <section class="flex flex-col bg-slate-100 rounded-xl border-2 border-gray-300 mb-2">

                    <div class="p-3">
                            <div class="text-black font-bold text-center text-2xl sm:text-2xl md:text-3xl xl:text-3xl">Servicios Opcionales </div>
                    </div>
                
                    <form @submit.prevent="submit">
                        <div class="mx-4 block p-2 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:border-gray-700">
                            <div class="grid grid-cols-12 gap-1" v-for="service in services" :key="service.id">
                                <div class="col-span-1">
                                    <input type="checkbox" :checked="suma" :value="service.id" v-model="form.servicios"  name="poliza" >
                                </div>
                                <div class="col-span-6">
                                    <label class="" >{{ service.serviceName }}</label>
                                </div>
                                <div class="col-span-5">
                                    <label class="" > -> RD$ {{new Intl.NumberFormat('en-IN').format(service.servicePrice)}}.00</label>
                                </div>
                                <hr class="col-span-12">              
                            </div>
                        </div>
                    <br>
                    <div class="mt-2 mx-5 my-4">
                        <button class="bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50" >Continuar</button>
                    </div>   
                    </form>
                
                </section>
            </section>
    </section>

</template>
<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { watch } from '@vue/runtime-core';
    import Header from '../../components/Header.vue';
    import Footer from '../../components/Footer.vue';
export default {
    components:{
        Footer,
        Header,
        Head,
        Link
    },
    props:{
       car: Array,
       tarifa: Array,
       sellers: Array,
       services: Array,
       policyTime: String,
       clien_id: String,
       insurres: Array,
    },
    mounted(){
        console.log(this.insurres)
    },
    data(){
        return{
            total: 50,
            form:{
                car: this.car,
                tarifa:this.tarifa,
                seller: this.sellers,
                services: this.services,
                policyTime: this.policyTime,
                clien_id: this.clien_id,
                servicios: [],
                insurre: this.insurres

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
