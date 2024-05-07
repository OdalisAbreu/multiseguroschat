<template>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="initial-scale=1, width=device-width" />
        <title>SegurosChat | Compra tu seguro desde WhatsApp</title>
        <meta
            name="description"
            content="SegurosChat, Comprar seguro, Seguro WhatsApp"
        />
        <link rel="stylesheet" href="../../css/index.css" />
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        />
    </head>
    <body>
        <section id="header">
            <div class="bg-[#1D4ED8]">
                <a
                    href="/"
                    class="align-middle flex flex-row h-20 w-full xl:h-[7rem] xl:min-h-32"
                >
                    <img
                        class="pl-3 py-4 xl:max-w-[15rem] xl:pl-14 xl:pt-7"
                        alt=""
                        src="images/seguros-chat11-1@2x.a564a9f9.png"
                    />
                </a>
            </div>
        </section>
        <div style="margin-bottom: 42vh;">
            <section
                id="details"
                class="bg-white max-w-lg mx-auto p-2 pb-8 md:p-4 md:pb-12 my-5 rounded-lg shadow-2xl"
            >
                <h1 class="font-bold my-6 text-2xl text-center">
                    Su solicitud no pudo ser completada, favor contactar con servicio al cliente.
                </h1>
            </section>
        </div>
        <div class="mb-48">

        </div>
        <footer class="footer">
            <div class="waves">
                <div class="wave" id="wave1"></div>
                <div class="wave" id="wave2"></div>
                <div class="wave" id="wave3"></div>
                <div class="wave" id="wave4"></div>
            </div>
            <ul class="align-middle flex flex-row h-32 justify-evenly">
                <li class="mx-5">
                    <a
                        class="align-middle flex flex-col justify-center"
                        href="https://api.whatsapp.com/send?phone=18494722428&text=Hola"
                        target="_blank"
                    >
                        <img
                            src="images/whatsapp.f2a9acdc.svg"
                            alt="whatsapp"
                            class="mx-auto w-14"
                        />
                        <p>WhatsApp</p>
                    </a>
                </li>
                <li class="mx-4">
                    <a
                        class="flex flex-col"
                        href="https://www.instagram.com/seguroschatrd/"
                        target="_blank"
                    >
                        <img
                            src="images/Instagram.4dc2d318.svg"
                            alt="Instagram"
                            class="h-14 mx-auto p-1 w-14"
                        />
                        <p>Instagram</p>
                    </a>
                </li>
                <li class="mx-5">
                    <a
                        class="flex flex-col"
                        href="https://www.facebook.com/seguroschatrd"
                        target="_blank"
                    >
                        <img
                            src="images/Facebook.37b64d85.svg"
                            alt="Facebook"
                            class="h-14 mx-auto p-1 w-14"
                        />
                        <p>Facebook</p>
                    </a>
                </li>
            </ul>
            <div>
                <p class="align-middle flex flex-row justify-evenly">
                    &copy;&nbsp;<span id="copyright-year"></span>
                    &nbsp;SegurosChat
                </p>
            </div>
            <div>
                <a
                    class="align-middle flex flex-row justify-evenly link"
                    href="/Terminos"
                >
                    Términos y condiciones
                </a>
            </div>
            <div>
                <a
                    class="align-middle flex flex-row justify-evenly link"
                    href="/Politicas"
                >
                    Política de privacidad
                </a>
            </div>
        </footer>
    </body>
</template>
