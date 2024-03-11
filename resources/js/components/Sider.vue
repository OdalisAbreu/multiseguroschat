<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";

const logout = () => {
    Inertia.post(route('logout'));
}

</script>

<template>
    <div class="sideBar fixed h-screen text-white text-lg font-bold bg-gradient-to-b from-blue-600 via-blue-800 to-blue-900 border-r-2 border-black"
        style="width: 14%;margin-top: 5rem;">

       <Link href="/admin">
        <div
            class="flex md:pr-10 gap-2 items-center hover:bg-blue-500 w-full justify-start border-l-2 border-b-2 border-black py-2 pl-4">
            <p>DashBoard</p>
            <img class="w-6 sm:absolute sm:right-4" src="../../assets/adminSocio.png" alt="Consulta Invitado Logo" />
        </div>
        </Link>

         <Link href="/admin/codigo"> 
        <div
            class="flex md:pr-10 gap-2 items-center hover:bg-blue-400 w-full justify-start border-l-2 border-b-2 border-black py-2 pl-4">
            <p>Codigo de Descuento</p>
            <img class="w-5 sm:absolute sm:right-4" src="../../assets/consultaSocioLogo.png" alt="Consulta Socio Logo" />
        </div>
        </Link>
        <Link href="/tarifas"> 
        <div
            class="flex md:pr-10 gap-2 items-center hover:bg-blue-400 w-full justify-start border-l-2 border-b-2 border-black py-2 pl-4">
            <p>Tarifas</p>
            <img class="w-5 sm:absolute sm:right-4" src="../../assets/consultaSocioLogo.png" alt="Consulta Socio Logo" />
        </div>
        </Link>

      <!-- <Link href="/Admin/ConsultarSocio">
        <div
            class="flex md:pr-10 gap-2 items-center hover:bg-blue-500 w-full justify-start border-l-2 border-b-2 border-black py-2 pl-4">
            <p>Admin Socio</p>
            <img class="w-6 sm:absolute sm:right-4" src="../../assets/adminSocio.png" alt="Consulta Invitado Logo" />
        </div>
        </Link>

        <Link href="/ConsultarInvitado">
        <div
            class="flex md:pr-10 gap-2 items-center hover:bg-blue-500 w-full justify-start border-l-2 border-b-2 border-black py-2 pl-4">
            <p>Consultar Invitado</p>
            <img class="w-5 sm:absolute sm:right-4" src="../../assets/consultarInvitadoLogo.png"
                alt="Consulta Invitado Logo" />
        </div>
        </Link>
        <Link href="/Admin/ConsultarInvitado">
        <div
            class="flex md:pr-10 gap-2 items-center hover:bg-blue-500 w-full justify-start border-l-2 border-b-2 border-black py-2 pl-4">
            <p>Admin Invitado</p>
            <img class="w-6 sm:absolute sm:right-4" src="../../assets/adminSocio.png" alt="Consulta Invitado Logo" />
        </div>
        </Link>
        <Link href="/register">
            <div
                class="flex md:pr-10 gap-2 items-center hover:bg-blue-500 w-full justify-start border-l-2 border-b-2 border-black py-2 pl-4">
                <p>Registrar Usuario</p>
                <img class="w-6 sm:absolute sm:right-4" src="../../assets/adminSocio.png" alt="Consulta Invitado Logo" />
            </div>
        </Link>
        <Link href="/consultar">
            <div
                class="flex md:pr-10 gap-2 items-center hover:bg-blue-500 w-full justify-start border-l-2 border-b-2 border-black py-2 pl-4">
                <p>Consultar Usuarios</p>
                <img class="w-6 sm:absolute sm:right-4" src="../../assets/adminSocio.png" alt="Consulta Invitado Logo" />
            </div>
        </Link>-->
        <div class="w-full">
            <div
                class="flex md:pr-10 gap-2 items-center hover:bg-blue-500 w-full justify-start border-l-2 border-b-2 border-black py-2 pl-4"
                @click="logout"
                >
                <p>Logout</p>
                <img class="w-5 sm:absolute sm:right-4" src="../../assets/LogOut.png" alt="Consulta Invitado Logo" />
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: 'Sider',
    data() {
     //   return { user: [] };
    },
    props: {
        url: String,
    },
    beforeCreate() {
     /*   axios.post("http://127.0.0.1:8000/api/V1/indexAuth")
            .then((response) => {
                this.user = response.data;
            })
            .catch((error) => {
                console.log(error.response);
            });*/
    },
}
</script>