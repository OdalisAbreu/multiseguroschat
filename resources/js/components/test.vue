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
                    <!-- SVG Loader -->
                </svg>
            </div>

            <div class="flex mx-auto justify-self-center text-center mb-2 pl-3 justify-center">
                <h2 class="font-bold text-2xl">Renovar Pólizas</h2>
            </div>

            <!-- Renderizar cada póliza -->
            <div v-for="polices in data.polices" :key="polices.id" class="mb-2">
                <ViewPolices
                    :type="'renew'"
                    :police="polices"
                    @all-policies-expired="markAllExpired"
                />
            </div>

            <!-- Mensaje si no hay pólizas activas -->
            <div v-if="showNoPoliciesMessage" class="text-center text-gray-500 font-bold text-xl py-4">
                No tiene pólizas activas
                <CustomButton
                   :disabled="false"
                   Text="Comprar Póliza"
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
        data: Object,
    },
    data() {
        return {
            showNoPoliciesMessage: false, // Estado para controlar el mensaje
            name: this.data.client.name ? this.data.client.name : '',
            lastname: this.data.client.lastname ? this.data.client.lastname : '',
        };
    },
    methods: {
        policeInit(phonenumber) {
            this.$inertia.get(route('client.show', phonenumber));
        },
        // Método para manejar el evento de que todas las pólizas están vencidas
        markAllExpired() {
            this.showNoPoliciesMessage = true;
        },
    },
};
</script>
