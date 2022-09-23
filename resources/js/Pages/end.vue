<template>
    <main
        class="bg-white max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl"
    >
        <div class="text-center">
            <img class="inline" src="/ima/sc_ic.png.jpg">
        </div>
        <div class="text-center">
            <h3 class="font-bold text-2xl text-center">
               ¡Gracias por confiar en nosotros!
            </h3>
            <h3 class="font-bold text-2xl text-center">
               Para poder visualizar tu póliza dirígete a WhatsApp haciendo clic en el botón y selecciona la opción “Quiero ver mi póliza”
            </h3>
             <div class="mt-5">
                    <a class="bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 px-6 mt-5 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50" href="https://api.whatsapp.com/send/?phone=18297624444&text&type=phone_number&app_absent=0">WhatsApp</a>
                </div>
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
    /*    ResponseCode,
        TransactionID,
        RemoteResponseCode,
        AuthorizationCode,
        RetrivalReferenceNumber,
        TxToken*/
    },

    props: {},
    mounted(){
       /* console.log('ResponseCode: ' + this.ResponseCode)
        console.log('TransactionID: ' + this.TransactionID)
        console.log('RemoteResponseCode: ' + this.RemoteResponseCode)
        console.log('AuthorizationCode: ' + this.AuthorizationCode)
        console.log('RetrivalReferenceNumber: ' + this.RetrivalReferenceNumber)
        console.log('TxToken: ' + this.TxToken)*/
    }
});
</script>
