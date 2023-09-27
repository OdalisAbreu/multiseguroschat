<script setup>
import { Inertia } from "@inertiajs/inertia";

const logout = () => {
    Inertia.get(route('logoutApp'))
}
</script>

<template>
    <div>
        <div class="relative">
            <!-- Dropdown toggle button -->
            <button v-on:click="cambiar()" class="flex items-center w-8">
                <img src="../../assets/Barra.png" alt="" /> 
            </button>

            <!-- Dropdown menu -->
            <div v-show="show" class="absolute py-2 bg-slate-700 rounded-md shadow-xl w-44">

                <div>
                    <Link href="/"
                        class="block px-4 py-2 text-sm text-indigo-100 hover:bg-slate-600 focus:bg-slate-600 hover:text-indigo-100">
                    Home
                    </Link>
                </div>

                <div>
                    <Link href="/ConsultarSocio"
                        class="block px-4 py-2 text-sm text-indigo-100 hover:bg-slate-600 focus:bg-slate-600 hover:text-indigo-100">
                    Consultar Socio
                    </Link>
                </div>

                <div>
                    <Link href="/Admin/ConsultarSocio"
                        class="block px-4 py-2 text-sm text-indigo-100 hover:bg-slate-600 focus:bg-slate-600 hover:text-indigo-100">
                    Admin Socio
                    </Link>
                </div>

                <div>
                    <Link href="/ConsultarInvitado"
                        class="block px-4 py-2 text-sm text-indigo-100 hover:bg-slate-600 focus:bg-slate-600 hover:text-indigo-100">
                    Consultar Invitado
                    </Link>
                </div>

                <div>
                    <Link href="/Admin/ConsultarInvitado"
                        class="block px-4 py-2 text-sm text-indigo-100 hover:bg-slate-600 focus:bg-slate-600 hover:text-indigo-100">
                    Admin Invitado
                    </Link>
                </div>

                <div>
                    <Link href="/Admin/Dashboard"
                        class="block px-4 py-2 text-sm text-indigo-100 hover:bg-slate-600 focus:bg-slate-600 hover:text-indigo-100">
                    Dashboard
                    </Link>
                </div>

                <button @click="logout"
                    class="w-full text-left block px-4 py-2 text-sm text-indigo-100 hover:bg-slate-600 focus:bg-slate-600 hover:text-indigo-100">
                    Logout
                </button>

            </div>
        </div>
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: { Link },
    data() {
        return { 
        //    user: [],
            show: false
        };
    },
    props: {
        url: String,
    },
    beforeCreate() {
    /*    axios.post("/api/V1/indexAuth")
            .then((response) => {
                this.user = response.data;
            })
            .catch((error) => {
                console.log(error.response);
            });*/
    },
    methods:{
        cambiar(){
            this.show = !this.show;
            console.log(this.show);
        }
    }
};
</script>
