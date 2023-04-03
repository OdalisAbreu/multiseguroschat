<template>
    <main class="bg-white h-screen max-w-xl mx-auto md:p-12 rounded-lg shadow-2xl">
        <div class="text-center w-full bg-blue-700">
            <img class="inline w-72 rounded-xl" src="../../../public/images/SegurosChatAzul-.jpg">
        </div>

        <div @submit.prevent="submit" class="mt-6 p-8">
          <!--  <form class="flex flex-col">
                <div class="mb-8 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3">Para poder continuar favor digita tu
                        celular</label>
                    <input type="text"
                        class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-blue-500 transition duration-500 px-3 pb-3"
                        placeholder="Numero de celuar *" v-model="form.phone" required>
                </div>
                <button v-if="!Loading" type="submit"
                    class="bg-blue-600 hover:bg-blue-600 text-white font-bold mx-3 py-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200 sm:mx-3">
                    Verificar
                </button>
                <button v-else disabled type="submit"
                    class="animate-pulse flex justify-center bg-blue-500 hover:bg-blue-600 text-white font-bold mx-3 py-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200 sm:mx-3">
                    <svg aria-hidden="true" role="status"
                        class="inline w-7 h-7 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="#E5E7EB" />
                    </svg>
                </button>
            </form> -->
            <div class="mb-8 pt-3 rounded bg-gray-200">
                <label class="block text-gray-700 text-sm font-bold mb-2 ml-3">Su sesión ha finalizado o caducado por inactividad, para poder continuar con su proceso por favor dirígete a WhatsApp</label>
            </div>
        </div>
        <div class="mt-6">
            <a class=" flex justify-center bg-blue-700 hover:bg-blue-900 text-white font-bold mx-3 py-4 rounded-lg shadow-lg hover:shadow-xl transition duration-200 sm:mx-3"
                href="https://api.whatsapp.com/send/?phone=18297624444&text&type=phone_number&app_absent=0">Ir a
                WhatsApp
            </a>
        </div>
    
        <footer class="bg-white rounded-lg shadow md:flex md:items-center md:justify-between">
            <div class="absolute inset-x-0 bottom-0 pl-4 pb-2 text-gray-500 dark:text-gray-400">Seguros Chat 2.1.4</div>
        </footer>
    </main>
</template>

<style scoped></style>

<script>
import { defineComponent } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        Head,
        Link,
    },

    props: {

    },
    data() {
        return {
            form: {
                phone: '',
            },
            Loading: false,
        }
    },
    methods: {
        submit() {
            this.Loading = true
            this.$inertia.get(this.route('client.show', this.form.phone))
        }
    }
})
</script>
