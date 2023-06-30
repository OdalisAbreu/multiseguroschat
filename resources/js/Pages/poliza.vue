<template>
    <div id="image" class="fondo">
        <div class="border-2 border-sky-500 rounded-md tarjeta">
                <div class="header_poliza"></div>
                <div class="grid grid-cols-2 gap-2 pl-1 pr-2">
                    <div>No. Poliza:</div>
                    <div>AUTO-MSP-000001</div>
                    <div>Aseguradora:</div>
                    <div>Seguros Patria</div>
                    <div>Fecha de Emisión:</div>
                    <div>18-Agosto-2017 9:03 PM</div>
                    <div>Valido desde:</div>
                    <div>29-Agosto-2017</div>
                    <div>Valido hasta:</div>
                    <div>29-Agosto-2018</div>
                </div>
                <hr size="10px" color="black" class="mt-1 mb-1" />
                <div class="grid grid-cols-2 gap-1 pl-1 pr-2">
                    <div>Nombres:</div>
                    <div>ALEYRIS</div>
                    <div>Apellidos:</div>
                    <div>DIAZ BAUTISTA</div>
                    <div>Cédula:</div>
                    <div>402-2470068-8</div>
                </div>
                <hr size="10px" color="black" class="mt-1 mb-1" />
                <div class="grid grid-cols-2 gap-1 pl-1 pr-2">
                    <div>Tipo:</div>
                    <div>Motocicleta</div>
                    <div>Marca:</div>
                    <div>YAMAHA</div>
                    <div>Año:</div>
                    <div>2016</div>
                    <div>Placa:</div>
                    <div>K0757588</div>
                    <div>Chassis:</div>
                    <div>ME1SE8020G3003517</div>
                </div>
                <hr size="10px" color="black" class="mt-1 mb-1" />
                <div class="grid grid-cols-2 gap-1 pl-1 pr-2">
                    <div>Coberturas</div>
                    <div></div>
                    <div>Daños Prop. Ajena:</div>
                    <div>50,000.00</div>
                    <div>Resp. Civil:<br />(Una persona)</div>
                    <div>50,000.00</div>
                    <div>Resp. Civil:<br />(Más de una persona)</div>
                    <div>100,000.00</div>
                    <div>Fianza Judicial:<br />(Una persona)</div>
                    <div>50,000.00</div>
                </div>
                <div class="grid grid-cols-1 gap-1 pl-1 pr-2">
                    <div>Servicios Opcionales</div>
                    <div>No tiene ningun servicio incluido</div>
                </div>
                <div class="grid grid-cols-2 gap-2 pl-1 pr-2">
                    <div>Prima Total:</div>
                    <div>RD$ 275.00</div>
                </div>
                <div>Gracias por elegir MultiSeguros</div>
                <div class="foother_poliza"></div>
        </div>
    </div>
</template>
<style>
.fondo {
    width: fit-content;
    height: max-content;
    padding: 3px;
    /* display: v-bind(display);*/
}
.tarjeta {
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
    height: 20px;
    width: 500px;
}
</style>
<script>
import domtoimage from "dom-to-image-more";
import htmlToImage from "html-to-image";
import { toBlob, toJpeg, toPng } from 'html-to-image';
export default {
    data() {
        return {
            display: "contents",
        };
    },
    components: {},
    props: {},
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
        var node = document.getElementById("image");

         toPng(node)
            .then(function (dataUrl) {
                var img = new Image();
                img.src = dataUrl;
                document.body.appendChild(img);
            })
            .catch(function (error) {
                console.error('oops, something went wrong!', error);
            });
       /* domtoimage
            .toPng(node)
            .then(function (dataUrl) {
                var ima = new Image();
                ima.src = dataUrl;
                document.body.appendChild(ima);
                console.log(dataUrl);
            })
            .catch(function (error) {
                console.error("oops, something went wrong!", error);
            });*/

        setTimeout(() => {
            // this.display = 'none'
        }, 100);
    },
};
</script>
