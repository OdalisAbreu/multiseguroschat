<template>
    <section
        class="bg-gray-200 h-full pb-4"
        :class="{ 'animate-pulse': Loading, 'opacity-50': Loading }"
    >
        <Header :width="100" />

        <section class="p-3 relative rounded-xl bg-white mx-3 z-50 mt-4">
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
            <section
                class="flex flex-col items-start justify-center bg-slate-100 rounded-xl border-2 border-gray-300 py-3 max-w-4xl mx-auto"
            >
                <div
                    class="flex mx-auto justify-self-center text-center mb-2 pl-3"
                >
                    <h2 class="font-bold text-xl">Valida tus Datos</h2>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2">Asegurado:</b>
                    <p class="w-1/2">
                        {{ data.client.name }} {{ data.client.lastname }}
                    </p>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2">Cédula:</b>
                    <p class="w-1/2">{{ data.client.cardnumber }}</p>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2">Dirección:</b>
                    <p class="w-1/2">{{ data.client.adrress }}</p>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2">Teléfono:</b>
                    <p class="w-1/2">{{ data.client.phonenumber }}</p>
                </div>

                <div
                    class="w-full flex items-center justify-start text-white bg-blue-800 my-2 pl-3"
                >
                    <h3 class="text-lg">Datos del Vehículo</h3>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2"> Tipo:</b>
                    <p class="w-1/2">{{ data.car.type }}</p>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2"> Marca:</b>
                    <p class="w-1/2">{{ data.car.brand }}</p>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2">Modelo:</b>
                    <p class="w-1/2">{{ data.car.model }}</p>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2"> Año:</b>
                    <p class="w-1/2">{{ data.invoice.year }}</p>
                </div>
                <div class="w-full flex items-center pl-3">
                    <b class="w-1/2"> Chassis:</b>

                    <label
                        class="w-1/2 break-words"
                        style="text-transform: uppercase"
                        >{{ data.invoice.chassis }}
                    </label>
                </div>

                <div class="w-full flex gap-2 pl-3">
                    <b class="w-1/2"> Registro:</b>

                    <label class="w-1/2" style="text-transform: uppercase">
                        {{ data.invoice.licensePlate }}
                    </label>
                </div>
            </section>

            <section
                class="flex flex-col bg-slate-100 rounded-xl border-2 border-gray-300 mb-2 px-4 p-3 max-w-4xl mx-auto mt-3"
            >
                <div class="p-2">
                    <div
                        class="text-left text-black font-bold text-xl sm:text-2xl md:text-2xl xl:text-2xl"
                    >
                        Selecciona la vigencia de tu seguro
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
                                                src="../../../../../public/images/Up.png"
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
                                                src="../../../../../public/images/down.png"
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
                                                    data.sellers[0]
                                                        .DanosPropiedadAjena > 0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Daños Propiedad Ajena:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            data.sellers[0]
                                                                .DanosPropiedadAjena
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    data.sellers[0]
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
                                                            data.sellers[0]
                                                                .ResponsabilidadCivil
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    data.sellers[0]
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
                                                            data.sellers[0]
                                                                .ResponsabilidadCivil2
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    data.sellers[0].UnaPersona >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Una Persona:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            data.sellers[0]
                                                                .UnaPersona
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    data.sellers[0]
                                                        .FianzaJudicial > 0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Fianza Judicial:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            data.sellers[0]
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
                                                src="../../../../../public/images/Up.png"
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
                                                src="../../../../../public/images/down.png"
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
                                                    data.sellers[0]
                                                        .DanosPropiedadAjena > 0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Daños Propiedad Ajena:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            data.sellers[0]
                                                                .DanosPropiedadAjena
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    data.sellers[0]
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
                                                            data.sellers[0]
                                                                .ResponsabilidadCivil
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    data.sellers[0]
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
                                                            data.sellers[0]
                                                                .ResponsabilidadCivil2
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    data.sellers[0].UnaPersona >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Una Persona:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            data.sellers[0]
                                                                .UnaPersona
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    data.sellers[0]
                                                        .FianzaJudicial > 0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Fianza Judicial:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            data.sellers[0]
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
                                        </div>

                                        <div
                                            v-if="isOpen3"
                                            class="w-full flex flex-col justify-center items-center text-center mb-2 bg-white p-1 rounded-md"
                                        >
                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    data.sellers[0]
                                                        .DanosPropiedadAjena > 0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Daños Propiedad Ajena:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            data.sellers[0]
                                                                .DanosPropiedadAjena
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    data.sellers[0]
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
                                                            data.sellers[0]
                                                                .ResponsabilidadCivil
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    data.sellers[0]
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
                                                            data.sellers[0]
                                                                .ResponsabilidadCivil2
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    data.sellers[0].UnaPersona >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Una Persona:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            data.sellers[0]
                                                                .UnaPersona
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>

                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    data.sellers[0]
                                                        .FianzaJudicial > 0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Fianza Judicial:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            data.sellers[0]
                                                                .FianzaJudicial
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section
                class="flex flex-col justify-center items-center bg-slate-100 rounded-xl border-2 border-gray-300 mb-2 max-w-4xl mx-auto"
            >
                <div class="p-3">
                    <div
                        class="text-black font-bold text-center text-2xl sm:text-2xl md:text-3xl xl:text-3xl"
                    >
                        Servicios Opcionales
                    </div>
                </div>

                <form @submit.prevent="submit">
                    <div class="mx-4 flex flex-col max-w-sm rounded-lg gap-2">
                        <div
                            class="relative flex justify-between items-center p-2 bg-white border border-gray-300 rounded-xl"
                            v-for="service in data.services"
                            :key="service.id"
                        >
                            <div class="flex justify-start items-center">
                                <div>
                                    <input
                                        type="checkbox"
                                        class="checked:bg-blue-800 p-1 mx-3 rounded-full"
                                        @change="
                                            handleCheckboxChange(service, time)
                                        "
                                        :value="service.id"
                                        v-model="form.servicios"
                                        name="poliza"
                                        :disabled="
                                            time != 'seismeses' &&
                                            time != 'docemeses'
                                        "
                                    />
                                </div>
                                <div
                                    class="flex h-28 flex-col justify-center items-start"
                                >
                                    <label class="text-start">{{
                                        service.nombre
                                    }}</label>

                                    <label
                                        v-if="time === 'seismeses'"
                                        class="font-bold"
                                        >RD$
                                        {{
                                            new Intl.NumberFormat(
                                                "en-IN"
                                            ).format(service.seismeses)
                                        }}.00
                                    </label>
                                    <label
                                        v-else-if="time === 'docemeses'"
                                        class="font-bold"
                                        >RD$
                                        {{
                                            new Intl.NumberFormat(
                                                "en-IN"
                                            ).format(service.docemeses)
                                        }}.00
                                    </label>
                                    <label v-else class="font-bold"
                                        >RD$0.00
                                    </label>
                                </div>
                            </div>

                            <!-- Imagenes para automoviles -->
                            <img
                                v-if="service.nombre == 'Casa del Conductor'"
                                src="../../../../../public/ima/conductor.png"
                                alt="Conductor"
                            />
                            <img
                                v-if="
                                    service.nombre == 'Asistencia Vial (Grua)'
                                "
                                src="../../../../../public/ima/grua.png"
                                alt="Grua"
                            />
                            <img
                                class="mr-1"
                                v-if="
                                    service.nombre ==
                                    'Aumento Fianza Hasta RD$1,000,000 (Veh. Livianos)'
                                "
                                src="../../../../../public/ima/plus.png"
                                alt="mas"
                            />
                            <img
                                v-if="
                                    service.nombre ==
                                    'Accidentes Personales RD$100,000'
                                "
                                src="../../../../../public/ima/accidente.png"
                                alt="mas"
                            />
                            <img
                                v-if="
                                    service.nombre == 'Ultimos Gastos RD$50,000'
                                "
                                src="../../../../../public/ima/gastos.png"
                                alt="mas"
                            />
                            <img
                                v-if="
                                    service.nombre ==
                                    'Plan Premium Automoviles(500/500/1,000,000 y 1 Millón FJ)'
                                "
                                alt="premium"
                            />
                        </div>
                        <div
                            class="w-full mx-5 my-2 justify-self-center self-center text-center"
                        ></div>
                    </div>
                    <br />
                </form>
            </section>
            <section
                class="flex flex-col items-start justify-center bg-slate-100 rounded-xl border-2 border-gray-300 py-3 max-w-4xl mx-auto"
            >
                <div
                    class="w-full font-bold rounded overflow-x-hidden border-t flex flex-col gap-2 text-lg justify-between pt-4 mt-4 pl-3"
                >
                    <p>
                        Sub Total:
                        {{
                            newSubTotal.toLocaleString("es-DO", {
                                style: "currency",
                                currency: "DOP",
                            })
                        }}
                    </p>

                    <div class="w-full flex justify-center items-center">
                        <button
                            v-if="!Descuento"
                            v-on:click="Descuento = true"
                            href="#"
                            class="text-center px-6 py-2 bg-blue-800 hover:bg-blue-700 text-white text-sm italic"
                        >
                            Tengo código de descuento
                        </button>

                        <div
                            v-if="Descuento"
                            class="flex flex-wrap justify-center items-center"
                        >
                            <input
                                class="border-blue-800"
                                type="text"
                                placeholder="CÓDIGO DE DESCUENTO"
                                name="codigo"
                                id="codigo"
                            />
                            <button
                                v-on:click="descuento()"
                                class="max-w-xl px-6 py-2 text-center bg-blue-800 text-white text-lg font-bold"
                                :disabled="isButtonDisabled" 
                                
                            >
                                Aplicar
                            </button>
                        </div>
                    </div>

                    <p v-if="Descuento">
                        Descuento:
                        {{
                            descontar.toLocaleString("es-DO", {
                                style: "currency",
                                currency: "DOP",
                            })
                        }}
                    </p>
                    <p>
                        Total a pagar:
                        {{
                            (totalGeneral).toLocaleString("es-DO", {
                                style: "currency",
                                currency: "DOP",
                            })
                        }}
                    </p>
                </div>
            </section>

            <div
                class="flex flex-col items-center justify-center border-2 border-blue-800 bg-white max-w-4xl mt-6 rounded-xl mx-auto px-6 py-3 shadow-lg shadow-blue-500/50"
            >
                <p
                    class="flex gap-x-1 justify-center items-start max-w-sm text-justify"
                >
                    <img
                        class="w-4 pt-1"
                        src="../../../../../public/ima/info.png"
                        alt="info"
                    />
                    A continuación te redireccionaremos a la pasarela de pagos
                    de CardNet®. Las primas son cobradas directamente por la
                    aseguradora seleccionada.
                </p>
                <img
                    class="inline w-64 px-6"
                    src="../../../../../public/ima/cardnetLogo.png"
                />
                <img
                    class="inline pt-4 w-64 px-8"
                    src="../../../../../public/ima/tarjetas.png"
                />
                <span
                    class="flex gap-x-1 justify-center items-start max-w-sm text-justify mt-8"
                    ><img
                        class="w-4 pt-1"
                        src="../../../../../public/ima/info.png"
                        alt="info"
                    />
                    Una vez aprobada la transacción, recibirás los documentos de
                    tu póliza en tu WhatsApp</span
                >
            </div>

            <div
                class="mx-5 my-1 justify-self-center self-center text-center mt-6"
            >
                <form
                      :action="`${data.payment_url}`"
                        method="POST"
                        name="CardNet"
                        class="CardNet flex flex-col justify-center items-center"
                        id="CardNet"
                        ref="CardNet"
                >
                    <input
                        type="hidden"
                        name="TransactionType"
                        id="TransactionType"
                        value="0200"
                    />
                    <input
                        type="hidden"
                        name="CurrencyCode"
                        id="CurrencyCode"
                        value="214"
                    />
                    <input
                        type="hidden"
                        name="AcquiringInstitutionCode"
                        id="AcquiringInstitutionCode"
                        value="349"
                    />
                    <input
                        type="hidden"
                        name="MerchantType"
                        id="MerchantType"
                        v-model="data.sellerCardnetCredencial.merchanttype"
                    />
                    <input
                        type="hidden"
                        name="MerchantNumber"
                        id="MerchantNumber"
                        v-model="data.sellerCardnetCredencial.merchantnumber"
                    />
                    <input
                        type="hidden"
                        name="MerchantTerminal"
                        id="MerchantTerminal"
                        v-model="data.sellerCardnetCredencial.merchantterminal"
                    />
                    <input
                        type="hidden"
                        name="ReturnUrl"
                        id="ReturnUrl"
                        v-model="data.urlReturn"
                    />
                    <input
                        type="hidden"
                        name="CancelUrl"
                        id="CancelUrl"
                        v-model="data.urlReturn"
                    />
                    <input
                        type="hidden"
                        name="PageLanguaje"
                        id="PageLanguaje"
                        value="ESP"
                    />
                    <input
                        type="hidden"
                        name="OrdenId"
                        id="OrdenId"
                        v-model="orderId"
                    />
                    <input
                        type="hidden"
                        name="TransactionId"
                        id="TransactionId"
                        v-model="orderId"
                    />
                    <input
                        type="hidden"
                        name="Amount"
                        id="Amount"
                        :value="(totalGeneral) + '00' "
                    />
                    <input type="hidden" name="Tax" id="Tax" Value="00" />
                    <!--<input type="hidden" name="Tax" id="Tax" v-model="form.tax" />-->
                    <input
                        type="hidden"
                        name="MerchantName"
                        id="MerchantName"
                        v-model="data.sellerCardnetCredencial.client_name"
                    />
                    <input
                        type="hidden"
                        name="KeyEncriptionKey"
                        id="KeyEncriptionKey"
                        v-model="data.invoice.id"
                    />
                    <input
                        type="hidden"
                        name="Ipclient"
                        id="Ipclient"
                        v-model="data.clientIp"
                    />
                    <input type="hidden" name="loteid" Value="001" />
                    <input type="hidden" name="seqid" id="seqid" Value="001" />

                    <div class="flex justify-center items-start my-3 gap-x-2">
                        <input
                            type="checkbox"
                            @change="condiciones != condiciones"
                            v-model="condiciones"
                        />
                        <p class="text-justify text-sm">
                            Al hacer click en "Comprar" acepto los términos y
                            condiciones de SegurosChat® en la compra de mis
                            pólizas
                        </p>
                    </div>

                </form>
                <div
                    class="w-full mt-5 mx-5 my-4 pb-8 justify-self-center self-center text-center"
                >
                    <button
                        :class="{
                            'bg-slate-600 shadow-none hover:bg-slate-600':
                                condiciones == false,
                        }"
                        :disabled="condiciones == false"
                        @click="submit()"
                        ref="myButton"
                        class="w-full max-w-xl justify-center bg-blue-800 hover:bg-blue-700 shadow-lg shadow-blue-500/50 text-white font-bold rounded-lg py-4 sm:m-3 sm:w-full md:m-3 md:w-full xl:m-3 xl:full"
                    >
                        Realizar Compra
                    </button>
                </div>
            </div>
        </section>
        <Footer />
    </section>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Header from "../../../components/Header.vue";
import Footer from "../../../components/Footer.vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import { ref, onUnmounted } from "vue";

export default {
    components: {
        Footer,
        Header,
        Head,
        Link,
    },
    props: {
        Loading: Boolean,
        data: Array,
        coberturaMultiS: false,
        coberturaSura: false,
        coberturaAtrio: false,
    },
    created() {
        this.checkedItems = this.data.sellers.map((el) => {
            return {
                ...el,
                isChecked: false,
                selectedButton: null,
            };
        });
    },
    methods: {
        descuento() {
            var codigoIngresado = document.getElementById("codigo").value;
            var count = 0;
            var percentage = 0;
            var id = 0;
            this.data.cuponCode.forEach(function (codigo) {
                if (codigoIngresado == codigo.code) {
                    id= codigo.id;
                    count++;
                    percentage = codigo.discount_amount;
                }
            });
            this.discount_id = id;
            this.descontar = Math.round(
                (this.totalGeneral * percentage) / 100
            );
            var aplicado = this.totalGeneral - this.descontar;
            if (count > 0) {
                //Deshabilitar btnDescuento
                 this.isButtonDisabled = true;
                this.totalGeneral = aplicado;
            } else {
                alert(
                    "Código vencido o invalido, favor de verificar su código e introducirlo nuevamente"
                );
                document.getElementById("codigo").value = "";
            }
        },
        sumaSubTotal(monto) {
            this.subTotal = Number(monto);
            this.totalGeneral =  Number(monto);
            this.newSubTotal = this.totalGeneral 
        },
        sumaTotal(sumarMonto, restarMonto) {
            this.total = this.total + sumarMonto - restarMonto;
            this.newSubTotal = this.subTotal + this.total
            this.totalGeneral = this.subTotal + this.total
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

                if (this.time == "seismeses") {
                    this.sumaSubTotal(seller.seismeses);
                } else if (this.time == "docemeses") {
                    this.sumaSubTotal(seller.docemeses);
                }
                this.total = 0;
                this.form.servicios = [];
            });
        },
        handleCheckboxChange(service, time) {
            const isChecked = this.form.servicios.includes(service.id);
            const value =
                time === "seismeses" ? service.seismeses : service.docemeses;

            if (isChecked) {
                this.sumaTotal(value, 0);
            } else {
                this.sumaTotal(0, value);
            }
        },
        submit() {
            axios.get("/api/accesoCarnetUpdate/" + this.data.client.id);
            this.Loading = true;
            // console.log('entro');
           if (this.time == ""){
               alert("Favor de seleccionar la vigencia de tu seguro");
               return;
           }
           if(this.time == "seismeses"){
               this.data.time = 6
           }else{
               this.data.time = 12
           }
            this.data.policePrice = this.totalGeneral;
            this.data.newServices = this.form.servicios;
            this.data.discount_id = this.discount_id;
            axios.post( "/api/UpdatePolice", this.data)
            .then((response) => {
                    console.log(response);
                    this.orderId = response.data.id;
                })
                .catch((error) => {
                    console.log(error);
                })
                .finally(() => {
                    this.Loading = false;
                    this.$refs.CardNet.submit();//Envía el formulario
                });
             
        },
    },
    data() {
        return {
            condiciones: false,
            Descuento: false,
            quitarBorde: false,
            marcado: false,
            Loading: false,
            isButtonDisabled: false,
            checkedItems: Array,
            showCheckboxes: false,
            sellerSeleccionado: null,
            orderId: this.data.invoice.id,
            totalGeneral: 0,
            newSubTotal: 0,
            descontar: 0,
            ServicesPrice: 0,
            discount_id: 0,
            total: 0,
            subTotal: 0,
            time: "",
            form: {
                servicios: [],
                descontar: 0,
                descuento: "",
                price: this.data.policePrice + "00",
            },
        };
    },
};
</script>
