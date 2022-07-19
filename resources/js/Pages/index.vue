<template>
<main class="bg-white max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl">
        <div class="text-center">
            <img class="inline" src="ima/segchat.jpg">
            <h3 class="font-bold text-2xl text-center">Seguros Chat</h3>
        </div>

        <div @submit.prevent="submit" class="mt-10">
            <form class="flex flex-col">
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3">Celular</label>
                    <input type="text" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-lime-400 transition duration-500 px-3 pb-3" placeholder="Numero de celuar *" v-model="form.phone" required>
                </div>
                <button type="submit" class="bg-lime-600 hover:bg-lime-700 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200">Verificar</button>
            </form>
        </div>
    </main>

    <footer class="bg-white rounded-lg shadow md:flex md:items-center md:justify-between dark:bg-gray-800">
        <div class="absolute inset-x-0 bottom-0 h-10 pl-4 text-gray-500 dark:text-gray-400">Seguros Chat 1.5.3</div>
    </footer>

</template>

<style scoped>

</style>

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
        data(){
            return {
                form: {
                    phone: '',
                }
            }
        },
        methods: {
            submit(){
                this.$inertia.get(this.route('client.show', this.form.phone))
            }
        }
    })
</script>
