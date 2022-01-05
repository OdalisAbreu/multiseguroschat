<template>
    <div class="py-12 px-10">
        <h1>Multisseguros</h1>
        <form @submit.prevent="submit" class="mt-5">
             <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Numero de celuar *" v-model="form.phone" required>
              <button type="submit" class="block bg-blue-500 hover:bg-blue-700 px-4 py-2 mt-5" >Verificar</button>
        </form>
    </div>
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
                this.$inertia.get(this.route('client', this.form.phone))
            }
        }
    })
</script>
