<template>
<main class="bg-white max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl">
        <div class="text-center">
            <img class="inline" src="ima/Botpro-logo.png">
            <h3 class="font-bold text-2xl text-center">Seguros Chat</h3>
        </div>

        <div @submit.prevent="submit" class="mt-10">
            <form class="flex flex-col">
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3">Celular</label>
                    <input type="text" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-blue-400 transition duration-500 px-3 pb-3" placeholder="Numero de celuar *" v-model="form.phone" required>
                </div>
                <button type="submit" class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 rounded shadow-lg hover:shadow-xl transition duration-200">Verificar</button>
            </form>
        </div>
    </main>
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
