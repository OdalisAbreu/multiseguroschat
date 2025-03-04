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
        <Link href="/admin/ventas/seguro-unico">
            <div class="flex md:pr-10 gap-2 items-center hover:bg-blue-400 w-full justify-start border-l-2 border-b-2 border-black py-2 pl-4">
                <p>Vender Seguro Unico</p>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 sm:absolute sm:right-4">
                    <path fill-rule="evenodd" d="M4.5 3.75a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V6.75a3 3 0 0 0-3-3h-15Zm4.125 3a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Zm-3.873 8.703a4.126 4.126 0 0 1 7.746 0 .75.75 0 0 1-.351.92 7.47 7.47 0 0 1-3.522.877 7.47 7.47 0 0 1-3.522-.877.75.75 0 0 1-.351-.92ZM15 8.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15ZM14.25 12a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H15a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15Z" clip-rule="evenodd" />
                </svg>
            </div>
        </Link>
        <Link href="/admin/ventas/seguro-flotilla">
            <div
                class="flex md:pr-10 gap-2 items-center hover:bg-blue-400 w-full justify-start border-l-2 border-b-2 border-black py-2 pl-4">
                <p>Vender Seguro Flotilla</p>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 sm:absolute sm:right-4">
                    <path fill-rule="evenodd" d="M4.5 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5h-.75V3.75a.75.75 0 0 0 0-1.5h-15ZM9 6a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm-.75 3.75A.75.75 0 0 1 9 9h1.5a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM9 12a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm3.75-5.25A.75.75 0 0 1 13.5 6H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM13.5 9a.75.75 0 0 0 0 1.5H15A.75.75 0 0 0 15 9h-1.5Zm-.75 3.75a.75.75 0 0 1 .75-.75H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM9 19.5v-2.25a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-4.5A.75.75 0 0 1 9 19.5Z" clip-rule="evenodd" />
                </svg>
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