<template>
        <div id="image" class="fondo" >
            <!--<img class="text-center w-36" :src="logo">-->
            <div class="border-2 border-sky-500 rounded-md tarjeta" >
                <img class="text-center w-36" src="../../../public/ima/Atrio-Horizontal-sin-fondo.png">
                <img class="w-60" src="../../../public/ima/Seguros_Chat-11.png" alt="Logo" />
               <span class="">
                <table class="">
                    <tr>
                        <td>
                            NO. POLIZA: 
                        </td>
                        <td>
                            AUTO-AT-027723
                        </td>
                    </tr>
                    <tr>
                        <td>
                            NOMBRES: 
                        </td>
                        <td>
                            ANEURYS ALONZO MERCEDES NUNEZ
                        </td>
                    </tr>
                    <tr>
                        <td>
                            VEHICULO: 
                        </td>
                        <td>
                            Jeep HYUNDAI 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            AÑO: 
                        </td>
                        <td>
                            2010
                        </td>
                    </tr>
                    <tr>
                        <td>
                            CHASSIS: 
                        </td>
                        <td>
                            KMHSH81BBAU610286
                        </td>
                    </tr>
                    <tr>
                        <td>
                            VIGENCIA: 
                        </td>
                        <td>
                            DESDE 05-04-2023 HASTA 05-04-2024 12:00 PM
                        </td>
                    </tr>
                    <tr>
                        <td>
                            FIANZA JUDICIAL: 
                        </td>
                        <td>
                            RD$ 300,00
                        </td>
                    </tr>
                </table>
               </span> 
            </div>
        </div>
</template>
<style>
    .fondo{
        width: 500;
         height: 410px;
    }
    .tarjeta{
        width: 500px; 
        height: 400px;
    }
</style>
<script>
import domtoimage from 'dom-to-image-more';
import htmlToImage from 'html-to-image';
//import { toPng, toJpeg, toBlob, toPixelData, toSvg } from 'html-to-image';
export default {
    components: {

    },
    props: {

    },
    mounted() {
        var node = document.getElementById('image');

           /* htmlToImage.toPng(node)
            .then(function (dataUrl) {
                var img = new Image();
                img.src = dataUrl;
                document.body.appendChild(img);
            })
            .catch(function (error) {
                console.error('oops, something went wrong!', error);
            });*/
            
        domtoimage.toPng(node)
            .then(function (dataUrl) {
                var ima = new Image();
                ima.src = dataUrl;
                document.body.appendChild(ima);
                console.log(dataUrl)
            })
            .catch(function (error) {
                console.error('oops, something went wrong!', error);
            });

    }
}
</script>
