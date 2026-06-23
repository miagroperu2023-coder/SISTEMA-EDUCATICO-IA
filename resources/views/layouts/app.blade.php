<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description"
        content="EduPeruApp es una plataforma educativa inteligente para estudiantes de primaria y secundaria. Accede a clases en video, material educativo, evaluaciones interactivas e Inteligencia Artificial para fortalecer el aprendizaje y mejorar el rendimiento académico.">

    <meta name="keywords"
        content="EduPeruApp, educación escolar, aprendizaje escolar, primaria, secundaria, clases virtuales, videos educativos, evaluaciones online, inteligencia artificial educativa, plataforma educativa Perú, reforzamiento escolar, estudio online, material educativo PDF, ejercicios interactivos, docentes, estudiantes, tecnología educativa, rendimiento académico, aprendizaje personalizado">

    <meta name="author" content="EduPeruApp">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Signature Pad -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

    <title>EduPeruApp | IA Educativa para Primaria y Secundaria</title>

    <!-- SEO -->
    <link rel="canonical" href="https://eduperuapp.com">

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4R334WCQ6G"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'G-4R334WCQ6G');
    </script>

    <!-- Schema.org -->
    <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "EducationalOrganization",
    "name": "EduPeruApp",
    "url": "https://eduperuapp.com",
    "logo": "https://eduperuapp.com/img/logo/logo.png",
    "description": "Plataforma educativa inteligente para estudiantes de primaria y secundaria. Incluye clases en video, material educativo, evaluaciones online e Inteligencia Artificial para reforzar el aprendizaje.",
    "sameAs": [
        "https://www.facebook.com/",
        "https://www.instagram.com/",
        "https://www.tiktok.com/"
    ]
}
</script>

    <!-- Open Graph -->
    <meta property="og:title" content="EduPeruApp | Plataforma Educativa con Inteligencia Artificial">
    <meta property="og:description"
        content="Aprende con videos, evaluaciones interactivas y herramientas de Inteligencia Artificial. Educación moderna para estudiantes de primaria y secundaria.">
    <meta property="og:image" content="{{ asset('img/logo/logo.png') }}">
    <meta property="og:url" content="https://eduperuapp.com">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="EduPeruApp">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="EduPeruApp | Plataforma Educativa con Inteligencia Artificial">
    <meta name="twitter:description"
        content="Plataforma educativa con videos, evaluaciones e Inteligencia Artificial para mejorar el aprendizaje escolar.">
    <meta name="twitter:image" content="{{ asset('img/logo/logo.png') }}">


    <!-- CDN JQUERY -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    <!-- Agrega Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- links css mapa leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />


    {{-- links css generales --}}
    <link rel="stylesheet" href="{{ asset('css/generales.css') }}">
    <link rel="stylesheet" href="{{ asset('css/colores.css') }}">

    {{-- links css nav --}}
    <link rel="stylesheet" href="{{ asset('css/nav/nav.css') }}">


    {{-- links css responsive --}}
    <link rel="stylesheet" href="{{ asset('css/responsive/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive/course.css') }}">

    {{-- links css visitador --}}
    <link rel="stylesheet" href="{{ asset('css/visitador/home/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitador/home/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitador/home/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitador/home/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitador/home/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitador/home/jquery.flipster.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitador/home/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visitador/plan.css') }}">

    <link rel="stylesheet" href="{{ asset('css/visitador/course.css') }}">

    <!-- DATATABLES CSS -->
    <link rel="stylesheet" href="{{ asset('lib/datatable/dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/datatable/dataTables.min.css') }}">

    <!-- ICONO DEL PROYECTO -->
    <link rel="icon" type="image/png" href="{{ asset('img/logo/logo.png') }}">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS -->
    @yield('bosstrap.css')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400&display=swap" rel="stylesheet">

    <link href="{{ asset('css/login/login.css') }}" rel="stylesheet">
    <!-- Plyr CSS -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />

    <!-- Plyr JS -->
    <script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>

    <!--CSS SWEEALERT2-->
    <link rel="stylesheet" href="{{ asset('lib/sweetalert2/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <!-- ESTILOS LIVEWIRE -->
    @livewireStyles
</head>

<body>

    {{-- navegador --}}
    @yield('navegador')


    {{-- header --}}
    @yield('header')


    {{-- cuerpo --}}
    <main>
        @yield('main')
        @yield('scripts')
        <!-- SCRIPT LIVEWIRE -->
        @livewireScripts
    </main>



    <!--SDK MERCADOPAGO-->
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <!--API YOUTUBE
    <script src="https://www.youtube.com/iframe_api"></script>-->

    @yield('bosstrap.js')

    {{-- links js mapa leaflet --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>


    {{-- ALPINEJS --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- DATATABLES JS LIB-->
    <script src="{{ asset('lib/datatable/dataTables.js') }}"></script>
    <script src="{{ asset('lib/datatable/dataTables.min.js') }}"></script>


    <!--SCCRIPT GENERALES-->
    <script src="{{ asset('js/dataTables.js') }}"></script>
    <script src="{{ asset('js/post/solve.js') }}"></script>


    <script src="{{ asset('js/login/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/login/main.js') }}"></script>

    <!--JS SWEEALERT2-->
    <script src="{{ asset('lib/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('js/home/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('js/home/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/home/aos.js') }}"></script>
    <script src="{{ asset('js/home/jquery.flipster.min.js') }}"></script>
    <script src="{{ asset('js/home/template.js') }}"></script>

    <script src="{{ asset('js/bot/chatBot.js') }}"></script>


    <script src="{{ asset('js/mercadopagoSuscripcion.js') }}"></script>
    <script src="{{ asset('js/mercadopagoSuscripcionSeisMeses.js') }}"></script>
    <script src="{{ asset('js/mercadopagoSuscripcionaAnual.js') }}"></script>
    <script src="{{ asset('js/mercadopagoPlans.js') }}"></script>
    <!--<script src="{{ asset('js/mercadopagoSuscripcionSchool.js') }}"></script> -->
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->


</body>

</html>
