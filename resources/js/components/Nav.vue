<script setup>;
import DropDownNav from "./DropDownNav.vue";
</script>

<template>
    <div
        class="NavBar flex flex-col lg:flex-row lg:justify-between w-full justify-center items-center h-20 bg-gradient-to-r from-blue-600 via-blue-700 to-blue-900 border-b-2 border-black shadow-sm shadow-black">
        <div class="w-full flex items-center mx-4 lg:hidden absolute left-0">
            <!-- Dropdown menu -->
            <DropDownNav />
        </div>
        <div class="items-center">
            <!-- <img class=" w-52 lg:w-60 mx-3 LogoPrincipalNav" src="" alt="Logo" /> -->
        </div>
        <div class="text-white font-bold text-sm lg:text-lg italic lg:mr-8 no-copy">
            {{ routeName }} V.1.0.0
        </div>
    </div>
</template>

<script>
export default {
    name: "Nav",
    components: { DropDownNav },
    props: {
        routeName: {
            type: String,
            requiblue: true
        },
    }
};
</script>