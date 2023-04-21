<template>
    <section class="bg-gray-200">
        <Header :width="100" />
        <section class="py-2 pb-6 relative rounded-xl bg-white mx-3 z-40">
            <div class="grid grid-cols-12 gap-1">
                <div class="col-span-12">
                    <h3 class="font-bold text-2xl text-center">
                        Seguro procesado correctamente
                    </h3>
                </div>
            </div>
            <div
                class="flex flex-col justify-center items-center text-center overflow-x-visible"
            >
                <img class="text-center w-36" :src="logo" />
                <iframe
                    :src="
                        'https://multiseguros.com.do/SegurosChat/Admin/Sist.Sucursal/Seguro/poliza.php?id=' +
                        transactionId
                    "
                    width="100%"
                    height="630"
                    frameborder="0"
                >
                </iframe>

                <div class="mt-6">
                    <a
                        class="bg-blue-800 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg w-full py-3 px-6 mt-2 sm:m-3 sm:w-30 md:m-3 md:w-40 xl:m-3 xl:w-50"
                        href="https://api.whatsapp.com/send/?phone=18297624444&text&type=phone_number&app_absent=0"
                        >Ir a WhatsApp
                    </a>
                </div>
            </div>
        </section>
        <Footer class="mt-4" />
    </section>

    <!----------------------------------------------IMAGEN PARA BASE64-------------------->

    <div id="image" class="fondo">
        <div class="border-2 border-sky-500 rounded-md tarjeta">
            <span class="">
                <div class="header_poliza"></div>
                <div class="grid grid-cols-2 gap-2 pl-1 pr-2">
                    <div>No. Poliza:</div>
                    <div>{{Poliza}}</div>
                    <div>Aseguradora:</div>
                    <div>{{Aseguradora}}</div>
                    <div>Fecha de Emisión:</div>
                    <div>{{ invoice.created_at }}</div>
                    <div>Valido por:</div>
                    <div>{{ invoice.policyTime }}</div>
                </div>
                <hr size="10px" color="black" class="mt-2 mb-2" />
                <div class="grid grid-cols-2 gap-2 pl-1 pr-2">
                    <div>Nombres:</div>
                    <div>{{Client.name}}</div>
                    <div>Apellidos:</div>
                    <div>{{Client.lastname}}</div>
                    <div>No. Identificación</div>
                    <div v-if="Client.cardnumber">{{Client.cardnumber}}</div>
                    <div v-if="Client.passportnumber">{{Client.passportnumber}}</div>
                </div>
                <hr size="10px" color="black" class="mt-2 mb-2" />
                <div class="grid grid-cols-2 gap-2 pl-1 pr-2">
                    <div>Tipo:</div>
                    <div>{{tipo.nombre}}</div>
                    <div>Marca:</div>
                    <div>{{Marca}}</div>
                    <div>Año:</div>
                    <div>{{invoice.year}}</div>
                    <div>Placa:</div>
                    <div>{{invoice.licensePlate}}</div>
                    <div>Chassis:</div>
                    <div>{{invoice.chassis}}</div>
                </div>
                <hr size="10px" color="black" class="mt-2 mb-2" />
                <div class="grid grid-cols-2 gap-2 pl-1 pr-2">
                    <div>Coberturas</div>
                    <div></div>
                    <div>Daños Prop. Ajena:</div>
                    <div>{{ tipo.dpa }}</div>
                    <div>Resp. Civil:<br />(Una persona)</div>
                    <div>{{ tipo.rc }}</div>
                    <div>Resp. Civil:<br />(Más de una persona)</div>
                    <div>{{ tipo.rc2 }}</div>
                    <div>Fianza Judicial:<br />(Una persona)</div>
                    <div>{{ tipo.fj }}</div>
                </div>
                <div class="grid grid-cols-1 gap-1 pl-1 pr-2">
                    <div>Servicios Opcionales</div>
                    <div>No tiene ningun servicio incluido</div>
                </div>
                <div class="grid grid-cols-2 gap-2 pl-1 pr-2">
                    <div>Prima Total:</div>
                    <div>{{invoice.totalGeneral}}</div>
                </div>
                <div>Gracias por elegir MultiSeguros</div>
                <div class="foother_poliza"></div>
            </span>
        </div>
    </div>
    <!------------------------------------------------------------------------------------>
</template>

<style scoped>
.fondo {
    width: fit-content;
    height: max-content;
    padding: 3px;
    display: v-bind(display);
    background-color: rgb(255, 255, 255);
}
.tarjeta {
    width: fit-content;
    height: max-content;
    background-color: rgb(255, 255, 255);
}
.header_poliza {
    background-image: url("/images/Seguros_Chat-11.png");
    background-color: rgb(31, 127, 252);
    /*background-image: url("/images/Atrio-Horizontal-sin-fondo.png");*/
    background-size: contain !important;
    background-repeat: no-repeat;
    height: 80px;
    width: 500px;
}
.foother_poliza {
  /*  background-image: url("/images/Seguros_Chat-11.png");*/
    background-size: contain !important;
    background-color: rgb(31, 127, 252);
    background-repeat: no-repeat;
    height: 80px;
    width: 500px;
}
</style>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
//import file from "file-saver";
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";
import domtoimage from "dom-to-image-more";
import { toBlob, toJpeg, toPng } from 'html-to-image';

export default defineComponent({
    components: {
        Head,
        Link,
        Header,
        Footer,
    },
    props: {},
    data() {
        return {
            display: "flex",
            image64: [],
        };
    },
    props: {
        ResponseCode: String,
        TransactionID: String,
        RemoteResponseCode: String,
        AuthorizationCode: String,
        RetrivalReferenceNumber: String,
        TxToken: String,
        transactionId: String,
        logo: String,
        Poliza: String,
        Client: Array,
        Marca: String,
        Modelo: String,
        Aseguradora: String,
        invoice: Array,
        tipo: Array
    },
    mounted() {
        //this.image64 = 'PRueba'
        console.log("ResponseCode: " + this.ResponseCode);
        console.log("TransactionID: " + this.TransactionID);
        console.log("RemoteResponseCode: " + this.RemoteResponseCode);
        console.log("AuthorizationCode: " + this.AuthorizationCode);
        console.log("RetrivalReferenceNumber: " + this.RetrivalReferenceNumber);
        console.log("TxToken: " + this.TxToken);

        //Genera la Imagen en Base64

        var node = document.getElementById("image");
      /*  domtoimage.toPng(node).then((dataUrl) => {
            console.log(dataUrl);
          
        }).catch((error) => {
            console.error("oops, something went wrong!", error);
        });*/

        console.log(this.invoice.id)
        var inv = this.invoice.id
        toPng(node)
            .then(function (dataUrl) {
                var img = new Image();
                img.src = dataUrl;
              //  console.log(dataUrl);
               // document.body.appendChild(img);
               axios
               .post("/api/V1/savePolizaImage", {
                   idPoliza: inv,
                   image: dataUrl,
                })
                .then((response) => {
                    console.log(inv)
                    console.log(esponse.data);
                })
                .catch((error) => {
                    console.log(inv)
                    console.log(error.response);
                });
            })
            .catch(function (error) {
                console.error('oops, something went wrong!', error);
            });
        setTimeout(() => {
            this.display = "none";
        }, 5000);
        axios.get(
            "/api/V1/enviarIdPolizaBot/"+this.invoice.id+"/"+this.Client.idConversacion
        );
    },
});
</script>
