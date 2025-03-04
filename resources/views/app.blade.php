<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <meta name="description" content="Tu seguro rápido, simple y seguro a través de WhatsApp.">
    <meta name="keywords" content="seguros, ley, vehículo, asegurado, aseguradora, whatsapp, renovacion, seguro de ley, república dominicana, santo domingo, bavaro, punta cana, santiago, samana, moca, bani, san cristobal, puerto plata, la vega, romana, higuey, bonao, terrenas " />
    <meta name="robots" content="index, follow">
    <link rel="alternate" hreflang="es" href="https://www.seguroschat.com/">
    <link rel="alternate" hreflang="x-default" href="https://www.seguroschat.com/">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#1d4ed8">

    <link rel="shortcut icon" href="https://home.seguroschat.com/icons/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="https://home.seguroschat.com/icons/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="https://home.seguroschat.com/icons/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="https://home.seguroschat.com/icons/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="https://home.seguroschat.com/icons/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="https://home.seguroschat.com/icons/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="https://home.seguroschat.com/icons/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="https://home.seguroschat.com/icons/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="https://home.seguroschat.com/icons/apple-touch-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="https://home.seguroschat.com/icons/apple-touch-icon-180x180.png" />

    <!-- X/Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="https://www.seguroschat.com/">
    <meta name="twitter:title" content="Seguros Chat">
    <meta name="twitter:description" content="Tu seguro rápido, simple y seguro a través de WhatsApp.">

    <!-- X/Twitter summary card  -->
    <meta name="twitter:image:src" content="https://home.seguroschat.com/seguros-chat11-1@2x.a564a9f9.png">

    <!-- Open Graph data -->
    <meta property="og:title" content="Seguros Chat">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.seguroschat.com/">
    <meta property="og:image" content="https://home.seguroschat.com/seguros-chat11-1@2x.a564a9f9.png">
    <meta property="og:description" content="Tu seguro rápido, simple y seguro a través de WhatsApp.">
    <meta property="og:site_name" content="Seguros Chat">
    <link rel="canonical" href="https://www.seguroschat.com/">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Favicon -->

    <!-- href="../../public/ima/favicon.png" -->
    <!-- Scripts -->
    @routes
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    @inertia

    @env ('local')
    <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
    @endenv
</body>

</html>