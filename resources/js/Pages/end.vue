<template>
    <main
        class="bg-white max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl"
    >
        <div class="text-center">
            <img class="inline" src="ima/Botpro-logo.png" />
            <h3 class="font-bold text-2xl text-center">Seguros Chat 1.3.2</h3>
        </div>
        <div class="text-center">
            <h3 class="font-bold text-2xl text-center">
                Gracias por utilizar Multiseguros chats
            </h3>
            <h3 class="font-bold text-2xl text-center">
                Para poder visualizar tu póliza dirígete al Bot y escribe
                “Quiero ver mi póliza”
            </h3>
        </div>
    </main>
</template>

<style scoped></style>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    components: {
        Head,
        Link,
    },

    props: {},
});
</script>
