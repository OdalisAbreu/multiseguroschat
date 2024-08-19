<template>
    <section
        class="flex flex-col justify-center items-center text-center py-4 bg-gray-300 "
    >
        <div class="cursor-pointer text-gray-700 hover:text-blue-800">
            <p>
                SegurosChat®. Todos los derechos reservados © {{ currentYear }}
            </p>
        </div>
        <div class="flex justify-center items-center gap-x-2">
            <button
                @click="(terminos = !terminos), (politicas = false)"
                class="cursor-pointer text-blue-700 hover:text-blue-900"
            >
                Términos y condiciones
            </button>
            <span class="text-gray-700">|</span>
            <button
                @click="(politicas = !politicas), (terminos = false)"
                class="cursor-pointer text-blue-700 hover:text-blue-900"
            >
                Politicas de privacidad
            </button>
        </div>
    </section>

    <section
        v-show="terminos == true"
        class="w-11/12 h-5/6 fixed inset-0 mx-auto my-auto p-3 bg-gray-200 rounded-xl shadow-lg z-50 overflow-y-scroll"
    >
        <button @click="terminos = !terminos" class="absolute right-4">
            <img
                class="w-6 hover:w-7 transition-all duration-300"
                src="../../../public/ima/exit.png"
                alt="EXIT"
            />
        </button>
        <h1 class="text-center font-bold text-2xl my-6">
            Términos y condiciones
        </h1>
        <div class="my-2">
            <h3 class="text-left mb-2 text-lg font-bold">1. Servicios</h3>
            <p class="text-justify">
                Nuestra página web ofrece servicios de venta de seguros y
                servicios afines. Nos esforzamos por ofrecer una descripción
                precisa y completa de todos nuestros servicios. Sin embargo, no
                garantizamos que la información en nuestro sitio web esté libre
                de errores. Nos reservamos el derecho de modificar nuestros
                servicios en cualquier momento sin previo aviso.
            </p>
        </div>
        <div class="my-2">
            <h3 class="text-left mb-2 text-lg font-bold">
                2. Uso de nuestro sitio web
            </h3>
            <p class="text-justify">
                Al utilizar nuestro sitio web, aceptas no realizar ninguna
                actividad que sea ilegal, fraudulenta o que infrinja los
                derechos de propiedad intelectual de terceros. Además, aceptas
                no utilizar nuestro sitio web para difundir spam, malware o
                cualquier otra forma de software malicioso.
            </p>
        </div>
        <div class="my-2">
            <h3 class="text-left mb-2 text-lg font-bold">
                3. Propiedad intelectual
            </h3>
            <p class="text-justify">
                Todo el contenido en nuestro sitio web, incluyendo textos,
                gráficos, imágenes y software, son propiedad de nuestra compañía
                o de sus respectivos propietarios de derechos de autor. No se
                permite la reproducción, distribución o modificación de ningún
                contenido sin nuestro consentimiento previo y por escrito.
            </p>
        </div>
        <div class="my-2">
            <h3 class="text-left mb-2 text-lg font-bold">4. Privacidad</h3>
            <p class="text-justify">
                Nos comprometemos a proteger tu privacidad en todo momento. Por
                favor, consulta nuestra política de privacidad para obtener más
                información sobre cómo manejamos tus datos personales.
            </p>
        </div>
        <div class="my-2">
            <h3 class="text-left mb-2 text-lg font-bold">
                5. Exención de responsabilidad
            </h3>
            <p class="text-justify">
                No nos hacemos responsables de ningún daño directo, indirecto,
                incidental, especial o consecuente que pueda resultar del uso de
                nuestro sitio web o de nuestros servicios.
            </p>
        </div>
        <div class="my-2">
            <h3 class="text-left mb-2 text-lg font-bold">
                6. Modificaciones a estos términos y condiciones
            </h3>
            <p class="text-justify">
                Nos reservamos el derecho de modificar estos términos y
                condiciones en cualquier momento sin previo aviso. La versión
                más actualizada siempre estará disponible en nuestro sitio web.
            </p>
        </div>
        <div class="my-2">
            <h3 class="text-left mb-2 text-lg font-bold">
                7. Ley aplicable y jurisdicción
            </h3>
            <p class="text-justify">
                Estos términos y condiciones se regirán e interpretarán de
                acuerdo con las leyes de [país]. Cualquier disputa relacionada
                con estos términos y condiciones se resolverá exclusivamente en
                los tribunales de la República Dominicana .
            </p>
        </div>
    </section>

    <section
        v-show="politicas == true"
        class="w-11/12 h-5/6 fixed inset-0 mx-auto my-auto p-3 bg-gray-200 rounded-xl shadow-lg z-50 overflow-y-scroll"
    >
        <button @click="politicas = !politicas" class="absolute right-4">
            <img
                class="w-6 hover:w-7 transition-all duration-300"
                src="../../../public/ima/exit.png"
                alt="EXIT"
            />
        </button>
        <h1 class="text-center font-bold text-2xl my-8">
            POLÍTICA DE PRIVACIDAD
        </h1>
        <p class="text-justify my-3">
            Bienvenido a nuestra página web. La privacidad de nuestros usuarios
            es muy importante para nosotros, y nos comprometemos a protegerla en
            todo momento. Esta política de privacidad describe cómo recopilamos,
            utilizamos y compartimos tu información personal en nuestro sitio
            web. Al utilizar nuestro sitio web, aceptas los términos de esta
            política de privacidad.
        </p>
        <div class="my-2">
            <h3 class="text-left mb-2 text-lg font-bold">
                1. Información que recopilamos
            </h3>
            <p class="text-justify">
                Recopilamos información personal como tu nombre, dirección,
                número de teléfono, dirección de correo electrónico, fecha de
                nacimiento, los datos de tus vehículos y otras informaciones
                relevantes para proporcionar nuestros servicios. Además, podemos
                recopilar información de uso del sitio, como tu dirección IP, el
                tipo de dispositivo que estás utilizando, la versión del sistema
                operativo y el navegador web que utilizas.
            </p>
        </div>
        <div class="my-2">
            <h3 class="text-left mb-2 text-lg font-bold">
                2. Uso de la información
            </h3>
            <p class="text-justify">
                Utilizamos la información personal que recopilamos para
                proporcionar nuestros servicios, procesar transacciones,
                responder a preguntas y comentarios, mejorar nuestro sitio web y
                personalizar tu experiencia. Además, podemos utilizar tu
                información personal para enviarte comunicaciones de marketing
                sobre nuestros productos y servicios.
            </p>
        </div>

        <div class="my-2">
            <h3 class="text-left mb-2 text-lg font-bold">
                3. Compartir información
            </h3>
            <p class="text-justify">
                No vendemos, alquilamos ni compartimos tu información personal
                con terceros para fines comerciales. Sin embargo, podemos
                compartir tu información personal con proveedores de servicios y
                otras empresas de seguros para procesar transacciones y brindar
                servicios relacionados con nuestros productos.
            </p>
        </div>
        <div class="my-2">
            <h3 class="text-left mb-2 text-lg font-bold">
                4. Seguridad de la información
            </h3>
            <p class="text-justify">
                Nos comprometemos a proteger la seguridad de tu información
                personal y tomamos medidas razonables para evitar el acceso no
                autorizado, la divulgación y el uso indebido de tu información.
                Sin embargo, ten en cuenta que ningún método de transmisión por
                Internet es 100% seguro y no podemos garantizar la seguridad de
                la información que compartes con nosotros.
            </p>
        </div>
        <div class="my-2">
            <h3 class="text-left mb-2 text-lg font-bold">5. Tus derechos</h3>
            <p class="text-justify">
                Tienes derecho a acceder, actualizar o eliminar tu información
                personal en cualquier momento. Si deseas ejercer estos derechos
                o tienes preguntas sobre nuestra política de privacidad,
                contáctanos a través de la información de contacto proporcionada
                en nuestro sitio web.
            </p>
        </div>
        <div class="my-2">
            <h3 class="text-left mb-2 text-lg font-bold">
                6. Cambios en la política de privacidad
            </h3>
            <p class="text-justify">
                Nos reservamos el derecho de modificar esta política de
                privacidad en cualquier momento sin previo aviso. La versión más
                actualizada siempre estará disponible en nuestro sitio web.
            </p>
        </div>
    </section>
</template>

<script>
export default {
    name: "Footer",
    data() {
        return {
            politicas: false,
            terminos: false,
            currentYear: null,
        };
    },
    mounted() {
        this.getCurrentYear();
    },
    methods: {
        getCurrentYear() {
            this.currentYear = new Date().getFullYear();
        },
    },
};
</script>

