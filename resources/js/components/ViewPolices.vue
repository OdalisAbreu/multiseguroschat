<template>
    <section v-if="shouldDisplayPolice" class="flex flex-col items-start justify-center bg-slate-100 rounded-xl border-2 border-gray-300 py-3 max-w-lg mx-auto p-6">
        <div class="flex flex-row justify-between w-full"> 
            <div class="flex-col">
                <div class="font-bold text-xl sm:text-xl md:text-xl xl:text-2xl">
                    <span>{{ police.type.nombre }}</span>
                </div>
                <div class="text-gray-800 font-bold text-md sm:text-md md:text-md xl:text-xl">
                    {{ police.brand.DESCRIPCION }} - {{ police.model.descripcion }}
                </div>
                <div :class="['text-md sm:text-md md:text-md xl:text-xl font-bold', textColor]">
                    FIN DE VIGENCIA: {{ policyEndDate }}
                </div>
            </div>
            <div class="flex flex-col justify-end items-center cursor-pointer">
                <a class="p-3 rounded-full bg-blue-800" @click="policeUpdate(police.id)">
                    <svg height="30px" width="30px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                            viewBox="0 0 28 28" xml:space="preserve">
                        <g>
                            <g id="reload">
                                <g>
                                    <path style="fill:#FFFFFF;" d="M22,16c0,4.41-3.586,8-8,8s-8-3.59-8-8s3.586-8,8-8l2.359,0.027l-1.164,1.164l2.828,2.828
                                        L24.035,6l-6.012-6l-2.828,2.828L16.375,4H14C7.375,4,2,9.371,2,16s5.375,12,12,12s12-5.371,12-12H22z"/>
                                </g>
                            </g>
                        </g>
                    </svg>
                </a>
                <p class="text-blue-800 font-bold text-sm">Renovar</p>
            </div>
            
        </div>
        <div v-auto-animate @click="cobertura = !cobertura" class="cursor-pointer w-full flex flex-col justify-center items-center rounded-xl text-xs bg-white text-blue-700 border border-blue-700 font-bold mb-2 text-center gap-x-1 mt-2">
            <div @click="isOpen = !isOpen" class="flex justify-center items-center gap-x-2 py-1">
                Ver Detalle de póliza
                <img class="w-3"  v-if="cobertura" src="/images/Up.png" alt="Up" />
                <img class="w-3" v-if="!cobertura" src="/images/down.png" alt="Down"/>
            </div>

            <div v-if="isOpen" class="w-full flex flex-col justify-center items-center text-center mb-2 bg-white p-1 rounded-md">
                <div class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10">
                    <p class="w-7/12 text-left">
                        TIPO:
                    </p>
                    <p class="w-5/12 text-left">
                        {{ police.type.nombre }}
                    </p>
                </div>

                <div class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10">
                    <p class="w-7/12 text-left">
                        MARCA:
                    </p>
                    <p class="w-5/12 text-left">
                        {{ police.brand.DESCRIPCION }}
                    </p>
                </div>

                <div class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10">
                    <p class="w-7/12 text-left">
                        MODELO:
                    </p>
                    <p class="w-5/12 text-left">
                        {{ police.model.descripcion }}
                    </p>
                </div>

                <div class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10">
                    <p class="w-7/12 text-left">
                       AÑO:
                    </p>
                    <p class="w-5/12 text-left">
                        {{ police.year }}
                    </p>
                </div>
                <div class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10">
                    <p class="w-7/12 text-left">
                        CHASSIS:
                    </p>
                    <p class="w-5/12 text-left relative group">
                        <span>{{ truncatedChassis }}</span>
                        <span class="absolute left-0 bg-gray-800 text-white text-xs rounded-lg py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            {{ chassis }}
                        </span>
                    </p>
                </div>
                    <div class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10">
                    <p class="w-7/12 text-left">
                        PLACA:
                    </p>
                    <p class="w-5/12 text-left">
                        {{ police.licensePlate }}
                    </p>
                </div>
            </div>
        </div>
    </section>

</template>
<script>

export default {
    name: "ViewPolices",
    props: {
        type: String, 
        police: Object

    },
    data() {
        return {
            chassis: this.police.chassis,
        };
    },
     computed: {
        truncatedChassis() {
            return this.chassis.substring(0, 8) + '...';
        },
        // Cálculo de la fecha de fin de vigencia
        policyEndDate() {
            const initDate = new Date(this.police.policyInitDate);
            const monthsToAdd = this.police.policyTime;

            initDate.setMonth(initDate.getMonth() + monthsToAdd);
            
            const day = String(initDate.getDate()).padStart(2, '0');
            const month = String(initDate.getMonth() + 1).padStart(2, '0');
            const year = initDate.getFullYear();
            
            return `${day}-${month}-${year}`;
        },

                // Filtrar si la póliza debe mostrarse (si tiene menos de 3 meses de vencida)
        shouldDisplayPolice() {
            const currentDate = new Date();
            const threeMonthsAgo = new Date();
            threeMonthsAgo.setMonth(threeMonthsAgo.getMonth() - 3); // Fecha de hace 3 meses
            
            const policyEndDate = new Date(this.police.policyInitDate);
            policyEndDate.setMonth(policyEndDate.getMonth() + this.police.policyTime);
            
            // Verificar si la póliza tiene menos de 3 meses de vencida
            return policyEndDate >= threeMonthsAgo;
        },

        textColor() {
            const initDate = new Date(this.police.policyInitDate);
            const monthsToAdd = this.police.policyTime;
            initDate.setMonth(initDate.getMonth() + monthsToAdd);
            
            const currentDate = new Date();
            const timeDiff = initDate - currentDate;
            const daysRemaining = Math.ceil(timeDiff / (1000 * 60 * 60 * 24)); // Convertir a días

            if (daysRemaining <= 7) {
                return 'text-red-500'; // Rojo si le falta una semana o menos
            } else if (daysRemaining <= 30) {
                return 'text-yellow-500'; // Amarillo si le falta un mes o menos
            } else {
                return 'text-green-500'; // Verde para el resto
            }
        },
    }, 
    methods: {
        policeUpdate(idPolice) {
            this.$inertia.get(route('updatePolicy', idPolice));
        },
    },
    mounted() {
        console.log(this.police);
    }
}
</script>
<script setup>
import { ref } from "vue";
const isOpen = ref(false);
const cobertura = ref(false);
</script>