<template>
    <section class="bg-blue-700">
        <Header :width="0" />
    </section>
    <section class="p-3 relative rounded-xl bg-white mx-3 z-40 xl:pt-40 xl:pb-40">
        <div class="p-3 px-5 sm:px-5 md:px-5 xl:px-5 bg-slate-100 rounded-xl border-2 border-gray-300 mb-4 max-w-2xl mx-auto">
             <div class="text-black text-left font-bold text-2xl sm:text-2xl md:text-3xl xl:text-3xl my-1 flex justify-center pb-4">
                Mi Perfil
             </div>
              
              <form @submit.prevent="submit">
                  <label class="pt-1 justify-start font-bold ">Celular <span class="text-red-400 inl">*</span></label>
                  <input class="rounded-lg w-full border-gray-300"  type="text" placeholder="Celular" v-model="form.Clinetphone" required />
                  <label class="pt-1 font-bold">Cedula / Pasaporte<span class="text-red-400 inl">*</span></label>
                  <input class="rounded-lg w-full border-gray-300"  type="text" placeholder="Cedula / Pasaporte" v-model="form.Clientid" required />
                  <CustomButton  Text="Continuar"/>
                </form>

            </div>
    </section>
<Footer />
</template>
<script>

    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Header from "../../components/Header.vue";
    import Footer from "../../components/Footer.vue";
    import CustomButton from "../../components/CustomButton.vue";

export default {
    components:{
        Header,
        Footer,
        CustomButton
    },
    props: {
    },
    data(){
        return {
            form: {
                Clinetphone: '',
                Clientid: '',
            }
        }
    },
    methods: {
         async submit() {
           console.log(this.form);
                this.$inertia.post(
                    this.route("clients.login"),
                    this.form
                );
            }
        }
    }
    
</script>
