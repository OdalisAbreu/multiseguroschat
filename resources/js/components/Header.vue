<template>
    <KeepAlive>
        <div class="bg-blue-700 mb-3">
            <div class="flex flex-col justify-center bg-blue-800">
                <div class="justify-self-center self-center overflow-x-hidden flex flex-col bg-blue">
                    <div class="p-2">
                        <img class="w-60" src="../../../public/ima/Seguros_Chat-11.png" alt="Logo" />
                    </div>
                </div>

                <div class="flex justify-around text-sm bg-blue-800 mt-2 text-white mb-2">
                    <p>Asegurado</p>
                    <p>Vehículo</p>
                    <p>Aseguradora</p>
                    <p>Pago</p>
                </div>

                <div class="mx-3 sm:mx-20 lg:mx-20 xl:mx-20">
                    <div class="bg-slate-800 opacity-50 rounded-full">
                        <div class="bg-cyan-400 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-l-full progress"
                            :style="{ width: width + '%' }">
                        </div>
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute z-0">
                <path fill="rgb(30 64 175)" fill-opacity="1"
                    d="M0,224L120,202.7C240,181,480,139,720,138.7C960,139,1200,181,1320,202.7L1440,224L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z">
                </path>
            </svg>
        </div>
    </KeepAlive>
</template>

<style>
.progress {
    animation: progressBar 1s ease-in-out;
    animation-fill-mode: both;
}

@keyframes progressBar {
    0% {
        width: 0;
    }
}
</style>

<script>
import { booleanLiteral, interfaceDeclaration } from '@babel/types';

export default {
    name: "Header",
    props: {
        width: Number, /* Prop para asignar tamaño a barra en navegacion */
    },
}
</script>