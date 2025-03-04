<template>
    <section class="w-full h-full pb-8">
        <div>
            <Nav :routeName="'Administrador'" class="fixed" />
        </div>
        <Sider />
    </section>
    <section class="w-screen flex flex-col  pt-20 pl-80">
         <div class="p-3 rounded-xl bg-white mx-3 ">
            <div class="p-3 px-5 sm:px-5 md:px-5 xl:px-5 bg-slate-100 rounded-xl border-2 border-gray-300 mb-4 max-w-4xl mx-auto">

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
                                                src="../../../../../../public/images/Up.png"
                                                alt="Up"
                                            />
                                            <img
                                                v-if="
                                                    !coberturaMultiS &&
                                                    index == 0 &&
                                                    index != 1 &&
                                                    index != 2 &&
                                                    index != 3
                                                "
                                                class="w-3"
                                                src="../../../../../../public/images/down.png"
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
                                                    Resp. Civil 1 Persona:
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
                                                    Resp. Civil +1 Persona:
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
                                                    Accidentes Personales:
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
                                           <div class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10 mt-4" v-if="seller.note_cobertura">
                                                <p class="text-left">
                                                    <p class="text-left" v-html="seller.note_cobertura"></p>
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
                                                src="../../../../../../public/images/Up.png"
                                                alt="Up"
                                            />
                                            <img
                                                v-if="
                                                    !coberturaSura &&
                                                    index == 1 &&
                                                    index != 0 &&
                                                    index != 2 &&
                                                    index != 3
                                                "
                                                class="w-3"
                                                src="../../../../../../public/images/down.png"
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
                                                            sellers[1]
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
                                                    Resp. Civil 1 Persona:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[1]
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
                                                    Resp. Civil +1 Persona:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[1]
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
                                                    Accidentes Personales:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[1]
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
                                                            sellers[1]
                                                                .FianzaJudicial
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>
                                            <div class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10 mt-4" v-if="seller.note_cobertura">
                                                <p class="text-left">
                                                    <p class="text-left" v-html="seller.note_cobertura"></p>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div
                                        v-auto-animate
                                        v-if="index == 2"
                                        v-on:click="
                                            coberturaAtrioPremium = !coberturaAtrioPremium
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
                                                    coberturaAtrioPremium && index == 2
                                                "
                                                class="w-3"
                                                src="../../../../../../public/images/Up.png"
                                                alt="Up"
                                            />
                                            <img
                                                v-if="
                                                    !coberturaAtrioPremium &&
                                                    index == 2 &&
                                                    index != 0 &&
                                                    index != 1 &&
                                                    index != 3
                                                "
                                                class="w-3"
                                                src="../../../../../../public/images/down.png"
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
                                                    sellers[2]
                                                        .DanosPropiedadAjena > 0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Daños Propiedad Ajena:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[2]
                                                                .DanosPropiedadAjena
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>
    
                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[2]
                                                        .ResponsabilidadCivil >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Resp. Civil 1 Persona:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[2]
                                                                .ResponsabilidadCivil
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>
    
                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[2]
                                                        .ResponsabilidadCivil2 >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Resp. Civil +1 Persona:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[2]
                                                                .ResponsabilidadCivil2
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>
    
                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="sellers[2].UnaPersona > 0"
                                            >
                                                <p class="w-8/12 text-left">
                                                    Accidentes Personales:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[2]
                                                                .UnaPersona
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>
    
                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[2].FianzaJudicial >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Fianza Judicial:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[2]
                                                                .FianzaJudicial
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>
                                            <div class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10 mt-4" v-if="seller.note_cobertura">
                                                <p class="text-left">
                                                    <p class="text-left" v-html="seller.note_cobertura"></p>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div
                                        v-auto-animate
                                        v-if="index == 3"
                                        v-on:click="
                                            coberturaSuraPremium = !coberturaSuraPremium
                                        "
                                        class="cursor-pointer w-full flex flex-col justify-center items-center rounded-xl text-xs bg-white text-blue-700 border border-blue-700 font-bold mb-2 text-center gap-x-1"
                                    >
                                        <div
                                            @click="isOpen4 = !isOpen4"
                                            class="flex justify-center items-center gap-x-2 py-1"
                                        >
                                            Ver Limites y Coberturas
    
                                            <img
                                                v-if="
                                                    coberturaSuraPremium && index == 3
                                                "
                                                class="w-3"
                                                src="../../../../../../public/images/Up.png"
                                                alt="Up"
                                            />
                                            <img
                                                v-if="
                                                    !coberturaSuraPremium &&
                                                    index == 3 &&
                                                    index != 2 &&
                                                    index != 0 &&
                                                    index != 1
                                                "
                                                class="w-3"
                                                src="../../../../../../public/images/down.png"
                                                alt="Down"
                                            />
                                        </div>
    
                                        <div
                                            v-if="isOpen4"
                                            class="w-full flex flex-col justify-center items-center text-center mb-2 bg-white p-1 rounded-md"
                                        >
                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[3]
                                                        .DanosPropiedadAjena > 0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Daños Propiedad Ajena:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[3]
                                                                .DanosPropiedadAjena
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>
    
                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[3]
                                                        .ResponsabilidadCivil >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Resp. Civil 1 Persona:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[3]
                                                                .ResponsabilidadCivil
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>
    
                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[3]
                                                        .ResponsabilidadCivil2 >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Resp. Civil +1 Persona:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[3]
                                                                .ResponsabilidadCivil2
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>
    
                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="sellers[3].UnaPersona > 0"
                                            >
                                                <p class="w-8/12 text-left">
                                                    Accidentes Personales:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[3]
                                                                .UnaPersona
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>
    
                                            <div
                                                class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10"
                                                v-if="
                                                    sellers[3].FianzaJudicial >
                                                    0
                                                "
                                            >
                                                <p class="w-8/12 text-left">
                                                    Fianza Judicial:
                                                </p>
                                                <p class="w-4/12 text-left">
                                                    RD${{
                                                        Number(
                                                            sellers[3]
                                                                .FianzaJudicial
                                                        ).toLocaleString()
                                                    }}
                                                </p>
                                            </div>
                                            <div class="w-full flex items-center font-bold text-sm text-blue-700 pl-1 md:px-4 lg:px-10 mt-4" v-if="seller.note_cobertura">
                                                  <p class="text-left" v-html="seller.note_cobertura"></p>
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
            </div>
         </div>  

    </section>
</template>
<script>
    import  Nav  from "../../../../components/Nav.vue";
    import  Sider  from "../../../../Components/Sider.vue";
    import VueDatePicker from "@vuepic/vue-datepicker";
    import "@vuepic/vue-datepicker/dist/main.css";
    import { Head, Link } from "@inertiajs/inertia-vue3";
    import Header from "../../../../components/Header.vue";
    import Footer from "../../../../components/Footer.vue";
    import { ref, onUnmounted, onMounted  } from "vue";
 
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
            Nav,
            Sider,
            Footer,
            Header,
            Head,
            Link,
            VueDatePicker
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
        coberturaSuraPremium: false,
        coberturaAtrioPremium: false,
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
        // Agregar evento beforeunload
        // window.addEventListener('beforeunload', this.handleBeforeUnload);
        //Validar si la seccion esta activa
        axios
            .get("/api/V1/validarCesion/" + this.client.id)
            .then((response) => {
                if (!response.data.status) {
                    alert("Su cesión se encuentra inactiva");
                    window.location.href =
                        "https://api.whatsapp.com/send?phone=18494722428&text=Hola";
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

        /*   window.addEventListener('beforeunload', this.showConfirmation); */

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
                this.form.date = this.form.date;
                this.Loading = true;
                this.$inertia.post(
                    this.route("clients.services", [insurances_id, time]),
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
        /*       showConfirmation(event) {
            event.preventDefault();
            event.returnValue = ""; // Necesario para mostrar el mensaje en algunos navegadores antiguos
            return "¿Estás seguro de que quieres salir? Todos los cambios no guardados se perderán.";
        }, */
    },
    /*  beforeUnmount() {
        window.removeEventListener("beforeunload", this.showConfirmation);
    }, */
};
</script>
