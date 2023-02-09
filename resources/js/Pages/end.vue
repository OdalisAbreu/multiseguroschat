<template>
    <section class="bg-gray-200">
        <Header :width="90" />
        <section class="p-2 relative rounded-xl bg-white mx-6 z-50 mt-4 ">

            <div class="grid grid-cols-12 gap-1">
            <div class="col-span-12">
            <h3 class="font-bold text-2xl text-center">Seguro procesado correctamente
            </h3>
            </div>
            </div>
            <div class="text-center">
                <img class="inline h-12 w-25" src="/ima/sura-logo-act.png">
                <iframe
                    :src="'https://multiseguros.com.do/SegurosChat/Admin/Sist.Sucursal/Seguro/poliza.php?id='+transactionId"
                    width="100%"
                    height="500"
                    frameborder="0" >
                </iframe>
        
                 <div class="mt-5">
                        <a class="bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 px-6 mt-2 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50" href="https://api.whatsapp.com/send/?phone=18297624444&text&type=phone_number&app_absent=0">Ir a WhatsApp</a>
                    </div>
            </div>
        </section>
        <Footer class="mt-4" />
    </section>


</template>

<style scoped></style>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';

export default defineComponent({
    components: {
        Head,
        Link,
        Header,
        Footer,
    },

    props: {
        ResponseCode: String,
        TransactionID: String,
        RemoteResponseCode: String,
        AuthorizationCode: String,
        RetrivalReferenceNumber: String,
        TxToken: String,
        transactionId: String
    },
    mounted(){
       console.log('ResponseCode: ' + this.ResponseCode)
        console.log('TransactionID: ' + this.TransactionID)
        console.log('RemoteResponseCode: ' + this.RemoteResponseCode)
        console.log('AuthorizationCode: ' + this.AuthorizationCode)
        console.log('RetrivalReferenceNumber: ' + this.RetrivalReferenceNumber)
        console.log('TxToken: ' + this.TxToken)

    }
});
</script>
