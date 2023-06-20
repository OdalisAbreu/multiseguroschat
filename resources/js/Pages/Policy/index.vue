<script setup>
import { ref, onMounted, computed, watch } from "vue";
import { vAutoAnimate } from "@formkit/auto-animate";
import { useAutoAnimate } from "@formkit/auto-animate/vue";

const isOpen = ref(false);

const isOpen2 = ref(false);

const isOpen3 = ref(false);
</script>

<template>
    <section
        class="bg-gray-200 pb-6 min-h-screen"
        :class="{ 'animate-pulse': Loading, 'opacity-50': Loading }"
    >
        <Header :width="58" />

        <section class="p-3 relative rounded-xl bg-white mx-6 z-50 mt-4">
            <div
                v-if="Loading"
                class="fixed inset-0 flex items-center justify-center z-50"
            >
                <svg
                    aria-hidden="true"
                    role="status"
                    class="inline w-12 h-12 text-gray-200 animate-spin dark:text-gray-600"
                    viewBox="0 0 100 101"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor"
                    />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="#E5E7EB"
                    />
                </svg>
            </div>

            <div
                class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3 max-w-4xl mx-auto"
            >
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Asegurado</h3>
                    <p>{{ client.name }} {{ client.lastname }}</p>
                </div>

                <div
                    class="flex flex-col justify-end gap-1 items-center cursor-pointer"
                >
                    <a
                        @click="clientReturn()"
                        class="p-2 rounded-full bg-blue-800"
                    >
                        <img
                            src="../../../../public/ima/edit.png"
                            alt="Editar"
                        />
                    </a>
                    <p class="text-blue-800 bottom-2 font-bold text-sm">
                        Editar
                    </p>
                </div>
            </div>

            <div
                class="flex items-center justify-between bg-slate-100 rounded-xl border-2 border-gray-300 p-3 px-5 mb-3 max-w-4xl mx-auto"
            >
                <div class="flex flex-col justify-start">
                    <h3 class="font-bold text-lg">Vehículo</h3>
                    <p>
                        {{ car.marcaName }} {{ car.modeloName }}, {{ car.year }}
                    </p>
                </div>
                <div
                    class="flex flex-col justify-end gap-1 items-center cursor-pointer"
                >
                    <a
                        @click="cartReturn()"
                        class="p-2 rounded-full bg-blue-800"
                    >
                        <img
                            src="../../../../public/ima/edit.png"
                            alt="Editar"
                        />
                    </a>
                    <p
                        class="text-blue-800 bottom-2 text-center font-bold text-sm"
                    >
                        Editar
                    </p>
                </div>
            </div>

            <section
                class="flex flex-col bg-slate-100 rounded-xl border-2 border-gray-300 mb-2 px-4 p-3 max-w-4xl mx-auto"
            >
                <div class="p-2">
                    <div
                        class="text-left text-black font-bold text-xl sm:text-2xl md:text-3xl xl:text-3xl"
                    >
                        Selecciona tu aseguradora
                    </div>
                </div>

                <div
                    class="w-full"
                    v-for="(seller, index) in checkedItems"
                    :key="seller.id"
                >
                    <div class="w-full p-2">
                        <div class="container mx-auto">
                            <div>
                                <div
                                    class="relative w-full flex justify-start items-start overflow-hidden mb-1"
                                >
                                    <img
                                        class="bg-cover bg-no-repeat bg-center h-10"
                                        :src="seller.logo"
                                    />
                                </div>

                                <div
                                    class="flex flex-col justify-center items-center"
                                >
                                    <input
                                        type="hidden"
                                        id="servicios"
                                        :value="seller.servicios"
                                    />

                                    <div
                                        class="w-full flex justify-around items-center gap-1 mb-1"
                                    >
                                        <!-- <div class="relative w-2/5 flex flex-col justify-around items-center">

                                            <button v-on:click="insurances_id = seller.insurances_id, time = 'tresmeses'"
                                                @click="marcarItem(seller, 'button1', index)"
                                                class="relative flex focus:border-blue-600 hover:border-blue-600 hover:cursor-pointer flex-col items-center justify-center mb-1 text-sm font-semibold text-gray-900 border border-gray-300 bg-white text-center rounded-lg w-full h-16 px-2">
                                                <p>3 Meses</p>
                                                <p>RD$ {{
                                                    new
                                                        Intl.NumberFormat('en-IN').format(seller.tresmeses)
                                                }}.00</p>
                                            <div>
                                                <input style="top: -4px; right: -4px;" type="checkbox"
                                                    :checked="seller.isChecked && seller.selectedButton === 'button1'"
                                                    class="absolute rounded-full checked:bg-blue-800 p-2 ">
                                            </div>
                                        </button>
                                    </div> -->

                                        <div
                                            class="relative w-1/2 flex flex-col justify-around items-stretch"
                                        >
                                            <button
                                                v-on:click="
                                                    (insurances_id =
                                                        seller.insurances_id),
                                                        (time = 'seismeses')
                                                "
                                                :class="{
                                                    'border-blue-600 border-2':
                                                        seller.isChecked &&
                                                        time == 'seismeses' &&
                                                        quitarBorde === false,
                                                }"
                                                @click="
                                                    marcarItem(
                                                        seller,
                                                        'button2',
                                                        index
                                                    )
                                                "
                                                class="relative flex hover:border-blue-600 hover:cursor-pointer flex-col items-center justify-center mb-1 text-sm font-semibold text-gray-900 border bg-white text-center rounded-lg w-full h-16 px-2"
                                            >
                                                <p>6 Meses</p>
                                                <p>
                                                    RD$
                                                    {{
                                                        new Intl.NumberFormat(
                                                            "en-IN"
                                                        ).format(
                                                            seller.seismeses
                                                        )
                                                    }}.00
                                                </p>
                                                <div>
                                                    <input
                                                        @click="
                                                            (quitarBorde = true),
                                                                (seller.time =
                                                                    null),
                                                                (seller.isChecked =
                                                                    null)
                                                        "
                                                        style="
                                                            top: -4px;
                                                            right: -4px;
                                                        "
                                                        type="checkbox"
                                                        :checked="
                                                            seller.isChecked &&
                                                            seller.selectedButton ===
                                                                'button2'
                                                        "
                                                        class="absolute rounded-full checked:bg-blue-800 p-2"
                                                    />
                                                </div>
                                            </button>
                                        </div>

                                        <div
                                            class="relative w-1/2 flex flex-col justify-around items-stretch"
                                        >
                                            <button
                                                v-on:click="
                                                    (insurances_id =
                                                        seller.insurances_id),
                                                        (time = 'docemeses')
                                                "
                                                :class="{
                                                    'border-blue-600 border-2':
                                                        seller.isChecked &&
                                                        time == 'docemeses' &&
                                                        quitarBorde === false,
                                                }"
                                                @click="
                                                    marcarItem(
                                                        seller,
                                                        'button3',
                                                        index
                                                    )
                                                "
                                                class="relative flex hover:border-blue-600 hover:cursor-pointer flex-col items-center justify-center mb-1 text-sm font-semibold text-gray-900 border bg-white text-center rounded-lg w-full h-16 px-2"
                                            >
                                                <p>Anual</p>
                                                <p>
                                                    RD$
                                                    {{
                                                        new Intl.NumberFormat(
                                                            "en-IN"
                                                        ).format(
                                                            seller.docemeses
                                                        )
                                                    }}.00
                                                </p>
                                                <div>
                                                    <input
                                                        @click="
                                                            (quitarBorde = true),
                                                                (seller.time =
                                                                    null),
                                                                (seller.isChecked =
                                                                    null)
                                                        "
                                                        style="
                                                            top: -4px;
                                                            right: -4px;
                                                        "
                                                        type="checkbox"
                                                        :checked="
                                                            seller.isChecked &&
                                                            seller.selectedButton ===
                                                                'button3'
                                                        "
                                                        class="absolute rounded-full checked:bg-blue-800 p-2"
                                                    />
                                                </div>
                                            </button>
                                        </div>
                                    </div>

                                    <div
                                        v-auto-animate
                                        v-show="index == 0"
                                        v-on:click="
                                            coberturaMultiS = !coberturaMultiS
                                        "
                                        class="cursor-pointer w-full flex flex-col justify-center items-center rounded-xl text-xs bg-white text-blue-700 border border-blue-700 font-bold mb-2 text-center gap-x-1"
                                    >
                                        <div
                                            @click="isOpen = !isOpen"
                                            class="flex justify-center items-center gap-x-2 py-1"
                                        >
                                            Ver Limites y Coberturas

                                            <img
                                                v-if="
                                                    coberturaMultiS &&
                                                    index == 0
                                                "
                                                class="w-3"
                                                src="../../../../public/images/Up.png"
                                                alt="Up"
                                            />
                                            <img
                                                v-if="
                                                    !coberturaMultiS &&
                                                    index == 0 &&
                                                    index != 1 &&
                                                    index != 2
                                                "
                                                class="w-3"
                                                src="../../../../public/images/down.png"
                                                alt="Down"
                                            />
                                        </div>

                                        <div
                                            v-if="isOpen"
                                            class="w-full flex flex-col justify-center items-center text-center mb-2 bg-white p-1 rounded-md"
                                        >
                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[1]
                                                        .DanosPropiedadAjena > 0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Daños Propiedad Ajena:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[0]
                                                                .DanosPropiedadAjena
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[1]
                                                        .ResponsabilidadCivil >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Responsabilidad Civil:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[0]
                                                                .ResponsabilidadCivil
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[1]
                                                        .ResponsabilidadCivil2 >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Responsabilidad Civil 2:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[0]
                                                                .ResponsabilidadCivil2
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="sellers[1].UnaPersona > 0"
                                            >
                                                <p class="w-8/12 text-left">
                                                    Una Persona:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[0]
                                                                .UnaPersona
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[1].FianzaJudicial >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Fianza Judicial:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[0]
                                                                .FianzaJudicial
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        v-auto-animate
                                        v-show="index == 1"
                                        v-on:click="
                                            coberturaSura = !coberturaSura
                                        "
                                        class="cursor-pointer w-full flex flex-col justify-center items-center rounded-xl text-xs bg-white text-blue-700 border border-blue-700 font-bold mb-2 text-center gap-x-1"
                                    >
                                        <div
                                            @click="isOpen2 = !isOpen2"
                                            class="flex justify-center items-center gap-x-2 py-1"
                                        >
                                            Ver Limites y Coberturas

                                            <img
                                                v-if="
                                                    coberturaSura && index == 1
                                                "
                                                class="w-3"
                                                src="../../../../public/images/Up.png"
                                                alt="Up"
                                            />
                                            <img
                                                v-if="
                                                    !coberturaSura &&
                                                    index == 1 &&
                                                    index != 0 &&
                                                    index != 2
                                                "
                                                class="w-3"
                                                src="../../../../public/images/down.png"
                                                alt="Down"
                                            />
                                        </div>

                                        <div
                                            v-if="isOpen2"
                                            class="w-full flex flex-col justify-center items-center text-center mb-2 bg-white p-1 rounded-md"
                                        >
                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[1]
                                                        .DanosPropiedadAjena > 0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Daños Propiedad Ajena:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[0]
                                                                .DanosPropiedadAjena
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[1]
                                                        .ResponsabilidadCivil >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Responsabilidad Civil:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[0]
                                                                .ResponsabilidadCivil
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[1]
                                                        .ResponsabilidadCivil2 >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Responsabilidad Civil 2:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[0]
                                                                .ResponsabilidadCivil2
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="sellers[1].UnaPersona > 0"
                                            >
                                                <p class="w-8/12 text-left">
                                                    Una Persona:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[0]
                                                                .UnaPersona
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[1].FianzaJudicial >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Fianza Judicial:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[0]
                                                                .FianzaJudicial
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        v-auto-animate
                                        v-if="index == 2"
                                        v-on:click="
                                            coberturaAtrio = !coberturaAtrio
                                        "
                                        class="cursor-pointer w-full flex flex-col justify-center items-center rounded-xl text-xs bg-white text-blue-700 border border-blue-700 font-bold mb-2 text-center gap-x-1"
                                    >
                                        <div
                                            @click="isOpen3 = !isOpen3"
                                            class="flex justify-center items-center gap-x-2 py-1"
                                        >
                                            Ver Limites y Coberturas

                                            <img
                                                v-if="
                                                    coberturaAtrio && index == 2
                                                "
                                                class="w-3"
                                                src="../../../../public/images/Up.png"
                                                alt="Up"
                                            />
                                            <img
                                                v-if="
                                                    !coberturaAtrio &&
                                                    index == 2 &&
                                                    index != 0 &&
                                                    index != 1
                                                "
                                                class="w-3"
                                                src="../../../../public/images/down.png"
                                                alt="Down"
                                            />
                                        </div>

                                        <div
                                            v-if="isOpen3"
                                            class="w-full flex flex-col justify-center items-center text-center mb-2 bg-white p-1 rounded-md"
                                        >
                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[1]
                                                        .DanosPropiedadAjena > 0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Daños Propiedad Ajena:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[0]
                                                                .DanosPropiedadAjena
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[1]
                                                        .ResponsabilidadCivil >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Responsabilidad Civil:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[0]
                                                                .ResponsabilidadCivil
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[1]
                                                        .ResponsabilidadCivil2 >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Responsabilidad Civil 2:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[0]
                                                                .ResponsabilidadCivil2
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="sellers[1].UnaPersona > 0"
                                            >
                                                <p class="w-8/12 text-left">
                                                    Una Persona:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[0]
                                                                .UnaPersona
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[1].FianzaJudicial >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Fianza Judicial:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[0]
                                                                .FianzaJudicial
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="w-full border-t-2 border-gray-700 border-dashed pt-4"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col justify-center">
                    <h3 class="text-xl text-center font-bold mb-2">
                        Inicio de Vigencia
                    </h3>
                    <p class="pl-1 text-left flex items-center">
                        Seleccione una fecha <span class="text-red-400">*</span>
                    </p>
                    <VueDatePicker
                        :min-date="new Date()"
                        :clearable="false"
                        auto-apply
                        required
                        :format="format"
                        :enable-time-picker="false"
                        v-model="form.date"
                    ></VueDatePicker>
                </div>

                <div
                    class="w-full mt-5 mx-5 my-4 justify-self-center self-center text-center"
                >
                    <button
                        type="submit"
                        v-on:click="procesar(insurances_id, time)"
                        class="w-full max-w-xl justify-center bg-blue-800 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-4 mt-5 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full"
                    >
                        Continuar
                    </button>
                </div>
            </section>
        </section>
    </section>

    <Footer />
</template>

<script>
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Header from "../../components/Header.vue";
import Footer from "../../components/Footer.vue";
import { ref, onUnmounted } from "vue";

let date = ref(new Date());

const format = (date) => {
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();

    var validDate = `${day}/${month}/${year}`;

    return validDate;
};

export default {
    components: {
        Footer,
        Header,
        Head,
        Link,
        VueDatePicker,
    },
    data() {
        return {
            quitarBorde: false,
            marcado: false,
            Loading: false,
            checkedItems: Array,
            showCheckboxes: false,
            sellerSeleccionado: null,
            form: {
                date: date.value,
                car: this.car,
                client: this.client,
                tipos: this.tipos,
                marcas: this.marcas,
                modelos: this.modelos,
                cities: this.cities,
                car: this.car,
                provinces: this.provinces,
                clientProvince: this.clientProvince,
                seller: this.sellers,
                clien_id: this.clien_id,
                servicios: "",
                clientepais: this.clientepais,
                paises: this.paises,
                insurances_id: String,
                time: String,
            },
            form2: {
                cities: this.cities,
                provinces: this.provinces,
                clientProvince: this.clientProvince,
                client: this.client,
                car: this.car,
                tipos: this.tipos,
                marcas: this.marcas,
                modelos: this.modelos,
                clientepais: this.clientepais,
                paises: this.paises,
            },
        };
    },
    props: {
        car: Array,
        sellers: Array,
        clien_id: String,
        cities: Object,
        provinces: Object,
        clientProvince: Array,
        client: Array,
        tipos: Array,
        marcas: Array,
        modelos: Array,
        modelos: Array,
        clientepais: Array,
        paises: Object,
        coberturaMultiS: false,
        coberturaSura: false,
        coberturaAtrio: false,
    },
    created() {
        this.checkedItems = this.sellers.map((el) => {
            return {
                ...el,
                isChecked: false,
                selectedButton: null,
            };
        });
    },
    mounted() {
               //Validar si la seccion esta activa
       axios.get("/api/V1/validarCesion/" + this.client.id).then((response) => {
                if(!response.data.status){
                    alert('Su cesión se encuentra inactiva')
                    window.location.href = "https://api.whatsapp.com/send?phone=18494722428&text=Hola";
                }
            })
            .catch((error) => {
                console.log(error.response);
            });

        //------------------ Guardar Vista por el cliente -------------------------------------
        axios.get(
            "/api/V1/validarVista/" +
                this.client.id +
                "/Selecciona tu aseguradora"
        );
        /* console.log(this.sellers) */

        // Inicializa el objeto checkedItems con las propiedades isChecked para cada objeto de cada elemento
        this.form.servicios = document.getElementById("servicios").value;
        // Asignar el arreglo de objetos a tu variable items
        /*  console.log(this.checkedItems) */

        const cuentaRegresiva = () => {
            axios.get("/api/V1/confirmarNegativo/" + this.client.phonenumber);
        };

        const timeoutId = setTimeout(cuentaRegresiva, 900000);

        onUnmounted(() => {
            clearTimeout(timeoutId);
        });
    },
    methods: {
        procesar: function (insurances_id, time) {
            if (insurances_id && time) {
                this.form.date = this.form.date.toISOString()
                this.Loading = true;
                this.$inertia.post(
                    this.route("services", [insurances_id, time]),
                    this.form
                );
            } else {
                alert("¡Seleccione una aseguradora para poder continuar!");
            }
        },
        marcarItem(selectedSeller, buttonId, selectedIndex) {
            this.checkedItems.forEach((seller, index) => {
                if (seller.id !== selectedSeller.id || index != selectedIndex) {
                    seller.isChecked = false;
                    this.marcado = false;
                } else {
                    this.quitarBorde = false;
                    this.marcado = true;
                    seller.isChecked = true;
                    seller.selectedButton = buttonId;
                }
            });
        },
        clientReturn() {
            this.Loading = true;
            this.$inertia.post(this.route("clientReturn"), this.form2);
        },
        cartReturn() {
            this.Loading = true;
            this.$inertia.post(this.route("carReturn"), this.form2);
        },
    },
};
</script>
