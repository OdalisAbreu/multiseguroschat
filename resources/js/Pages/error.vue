<template>
    <section class="bg-gray-200">
        <Header :width="90" />

        <section class="p-6 relative rounded-xl bg-white mx-6 z-50 mt-4 ">

            <div class="text-center">
                <h3>Tu transacción no ha sido completada de manera correcta </h3>
                <div class="mt-5">
                    <a class="bg-blue-500 hover:bg-blue-600 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 px-6 mt-2 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50"
                        href="https://api.whatsapp.com/send/?phone=18297624444&text&type=phone_number&app_absent=0">WhatsApp</a>
                </div>
            </div>
        </section>
        <Footer class="mt-4" />
    </section>
</template>

<style scoped></style>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';

export default {
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
        TxToken: String 
    },
    mounted() {
                       //Validar si la seccion esta activa
       axios.get("/api/V1/validarCesion/" + this.client.id).then((response) => {
                if(!response.data.status){
                    alert('Su sesión se encuentra inactiva')
                    window.location.href = "https://api.whatsapp.com/send?phone=18494722428&text=Hola";
                }
            })
            .catch((error) => {
                console.log(error.response);
            });
                //------------------ Guardar Vista por el cliente -------------------------------------
        axios.get(
            "/api/V1/validarVista/"+this.client_id+"/Erro de Pago"
           );
        console.log('ResponseCode: ' + this.ResponseCode)
        console.log('TransactionID: ' + this.TransactionID)
        console.log('RemoteResponseCode: ' + this.RemoteResponseCode)
        console.log('AuthorizationCode: ' + this.AuthorizationCode)
        console.log('RetrivalReferenceNumber: ' + this.RetrivalReferenceNumber)
        console.log('TxToken: ' + this.TxToken)

            //--------------------------- Enviar Mensaje al cliente -------------------------------//
            axios
                    .post("/api/V1/enviarMensajeBotCitie", {
                    //.post("/api/V1/enviarMensajeBotCitie", {
                            type: "text",
                            text: "Tu transacción no ha sido completada de manera correcta",
                            phone: this.Client.phonenumber
                    })
                    .then((response) => {
                        console.log(response.data)
                    })
                    .catch((error) => {
                        console.log(error.response);
                    });
    }
}
</script>
