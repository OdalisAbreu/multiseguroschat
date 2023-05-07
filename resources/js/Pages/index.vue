<template>
    <main
        style="font-family: Helvetica"
        class="bg-slate-100 h-full w-full mx-auto shadow-2xl pb-16"
    >
        <div class="flex items-center justify-between pr-6 w-full bg-blue-700">
            <img
                class="inline w-60 rounded-xl"
                src="../../../public/images/SegurosChatAzul-.jpg"
            />
        </div>

        <div
            @submit.prevent="submit"
            class="flex flex-col items-center justify-center"
        >
            <div class="w-full flex justify-center items-start mb-8 image h-72 pl-6 pt-6 pb-8">
                <label class="relative text-white font-bold lg:text-6xl text-4xl mb-8 pr-20"
                    >Compra tus seguros desde WhatsApp<span style="font-family: Roboto" class="bottom-0 absolute first-letter:text-blue-700 text-6xl font-bold rounded-full">.</span>
                </label>
            </div>

            <div class="flex py-4 justify-center text-base text-black">
                <ul class="list-disc list-inside">
                    <hr class="w-full">
                    <li class="my-4 pl-6 pr-1">
                        Elige tu aseguradora, compara las condiciones, los
                        límites y los precios
                    </li>
                    <hr class="w-full">
                    <li class="my-4 pl-6 pr-1">
                        Paga online y obtienes cobertura de inmediato.
                    </li>
                    <hr class="w-full">

                    <li class="my-4 pl-6 pr-1">Recibes tus documentos en tu móvil.</li>
                    <hr class="w-full">

                    <li class="my-4 pl-6 pr-1">
                        Ofrecemos Seguros de Ley para todo tipo de vehículos y
                        Seguros de Viaje para que disfrutes con tranquilidad de
                        tus próximas vacaciones
                    </li>
                    <hr class="w-full">

                </ul>
            </div>
        </div>

        <div class="mt-6 max-w-2xl flex justify-center items-center mx-auto">
            <a
                class="w-full relative flex items-center justify-center py-2 bg-blue-700 hover:bg-blue-900 text-white font-bold mx-3 rounded-lg shadow-lg hover:shadow-xl transition duration-200 sm:mx-3"
                target="_blank"
                href="https://api.whatsapp.com/send/?phone=18297624444&text&type=phone_number&app_absent=0"
            >
                Contáctanos por WhatsApp
                <img
                    class="w-6 md:w-8"
                    src="../../../public/ima/arrow.png"
                    alt="arrow"
                />
                <img
                    class="w-12"
                    src="../../../public/ima/whatsapp.webp"
                    alt="WhatsApp"
                />
            </a>
        </div>
    </main>

    <div
        style="font-family: Helvetica"
        class="relative w-full flex gap-10 bg-slate-800 text-white items-start justify-around py-12 px-4 md:px-10 lg:px-10"
    >
        <div>
            <h3 class="text-xl bold mb-3">Dirección:</h3>
            <p class="md:w-3/4">
                c/ Jacinto Mañón No 7, Suite 101 Ens. Paraíso Santo Domingo,
                Distrito Nacional, 00130, República Dominicana
            </p>
        </div>

        <div class="w-1/4 flex justify-center items-center flex-wrap gap-12">
            <div class="flex flex-col items-center justify-center">
                <img
                    class="w-10 bold mb-2"
                    style="padding: 3px"
                    src="../../../public/ima/telefono.png"
                    alt="Instagram"
                />
                <p class="flex-nowrap">849-472-2428</p>
            </div>
    
            <div class="flex flex-col items-center justify-center">
                <img
                    class="w-10 bold mb-2"
                    src="../../../public/ima/instagram.png"
                    alt="Instagram"
                />
                <a
                    class="cursor-pointer hover:text-blue-700"
                    href="https://www.instagram.com/seguros.chat/"
                    >@seguros.chat</a
                >
            </div>
        </div>
        
    </div>
</template>

<style scoped>
.image {
    background-image: url(../../../public/ima/HeroSection.jpg);
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    background-color: rgba(0, 0, 0, 0.6);
    background-blend-mode: multiply;
}
</style>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Head,
        Link,
    },

    props: {},
    data() {
        return {
            form: {
                phone: "",
            },
            Loading: false,
        };
    },
    methods: {
        submit() {
            this.Loading = true;
            this.$inertia.get(this.route("client.show", this.form.phone));
        },
    },
});
</script>
