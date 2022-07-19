<template>
    <main
        class="bg-white max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl"
    >
        <div class="text-center">
            <img class="inline" src="http://multiseguros.com.do:85/ima/Botpro-logo.png" />
            <h3 class="font-bold text-2xl text-center">Seguros Chat</h3>
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
    <footer class="bg-white rounded-lg shadow md:flex md:items-center md:justify-between dark:bg-gray-800">
        <div class="absolute inset-x-0 bottom-0 h-10 pl-4 text-gray-500 dark:text-gray-400">Seguros Chat 1.5.3</div>
    </footer>
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
