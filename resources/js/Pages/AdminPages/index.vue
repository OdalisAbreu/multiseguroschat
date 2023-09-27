<script setup>
import Nav from "../../components/Nav.vue";
import Sider from "../../Components/Sider.vue";
</script>

<template>
    <section class="w-full h-full pb-8">
        <div>
            <Nav :routeName="'Administrador'" class="fixed" />
        </div>
        <Sider />
    </section>
</template>