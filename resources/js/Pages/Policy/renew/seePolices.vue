<template>
    <section
        class="bg-gray-200 h-full pb-4"
        :class="{ 'animate-pulse': Loading, 'opacity-50': Loading }"
    >
        <Header :name="name + ' ' + lastname" />
                    <section class="p-3 relative rounded-xl bg-white mx-3 z-50 mt-4 mh-611 min-h-96 mb-4">
            <div v-if="Loading" class="fixed inset-0 flex items-center justify-center z-50">
                <svg
                    aria-hidden="true"
                    role="status"
                    class="inline w-12 h-12 text-gray-200 animate-spin dark:text-gray-600"
                    viewBox="0 0 100 101"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor"
                    />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="#E5E7EB"
                    />
                </svg>
            </div>
            <div class="flex mx-auto justify-self-center text-center mb-2 pl-3 justify-center">
                <h2 class="font-bold text-2xl">Renovar Pólizas</h2>
            </div>
            <div v-for="polices in data.polices" :key="polices" class="mb-2">
                <ViewPolices :type="'renew'" :police="polices"/>

            </div>
                  <!-- Verificamos si la póliza está vacía -->
            <div v-if="!data.polices || Object.keys(data.polices).length === 0" class="text-center text-gray-500 font-bold text-xl py-4">
                No tiene pólizas activas
                <CustomButton
                   :disabled="false"
                    Text="Compar Póliza"
                    @click="policeInit(data.client.phonenumber)"
                   />
            </div>
            
        </section>
        <Footer />
    </section>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Header from "../../../components/Header.vue";
import Footer from "../../../components/Footer.vue";
import "@vuepic/vue-datepicker/dist/main.css";
import CustomButton from "../../../components/CustomButton.vue";
import ViewPolices from "../../../components/ViewPolices.vue";

export default {
    components: {
        Footer,
        Header,
        Head,
        Link,
        ViewPolices,
        CustomButton,
    },
    props: {
        data: Array,
    },
    mounted() {
        //console.log(this.data.client.name);
    },
    data() {
        return {
            name : this.data.client.name ? this.data.client.name : '',
            lastname : this.data.client.lastname ? this.data.client.lastname : '',
        };
    },
    methods: {
        policeInit(phonenumber) {
            this.$inertia.get(route('client.show', phonenumber));
        },
    },
};
</script>