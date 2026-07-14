@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection



@section('main')

    <body data-spy="scroll" data-target=".navbar" data-offset="50">
        <div id="mobile-menu-overlay"></div>

        <div class="page-body-wrapper">

            <section id="home" class="home">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12" data-aos="fade-up">

                            <h1 class="fw-bold text-white mb-3 mt-5" style="font-size: 40px !important">
                                🚀 Potencia tu aprendizaje con Inteligencia Artificial.
                            </h1>

                            <p class="lead text-white mb-4">
                                <strong class="text-warning">EduPeruApp</strong> combina cursos, ejercicios, simulacros e
                                Inteligencia Artificial para ayudar a estudiantes de colegios públicos a aprender mejor y
                                mejorar su rendimiento académico.
                            </p>

                            <div class="d-flex flex-wrap mt-4">

                                @guest
                                    <a href="{{ route('admin.register.index') }}" class="btn btn-primary mt-1">
                                        🚀 Comenzar a aprender
                                    </a>

                                    <a href="#plans" class="ml-4 btn btn-primary mt-1">
                                        📖 Nuestros Planes
                                    </a>
                                @endguest

                                @auth
                                    @canany(['viewSubscription', 'viewSubscriptionSixMonth', 'viewSubscriptionYear'],
                                        auth()->user())
                                        <div class="d-flex flex-wrap">
                                            <a href="{{ route('visitador.course.list') }}"
                                                class="btn btn-gradient btn-lg fw-bold mr-3 mt-2 mt-sm-0">
                                                🌟 Continuar aprendiendo
                                            </a>

                                            <form action="{{ route('admin.logout') }}" method="POST">
                                                @csrf
                                                <input type="submit" class="btn-solid-sm p-4 text-center" value="🚪 Salir">
                                            </form>
                                        </div>
                                    @else
                                        <div class="d-flex flex-wrap">
                                            <a href="{{ route('visitador.plan.show') }}" class="btn-solid-sm p-4 text-center">
                                                💎 Potenciar mi aprendizaje
                                            </a>

                                            <form action="{{ route('admin.logout') }}" method="POST">
                                                @csrf
                                                <input type="submit" class="btn-solid-sm p-4 ml-3 text-center" value="🚪 Salir">
                                            </form>
                                        </div>
                                    @endcanany
                                @endauth

                            </div>

                        </div>
                    </div>
                </div>
            </section>


            {{-- CURSOS GRATIS 
            <section class="our-services section-home" id="services">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="text-dark font-weight-bold">Inscríbete en nuestros cursos gratuitos</h5>
                            <h3 class="font-weight-bold mb-5 color-general">PreuniCursos</h3>
                        </div>

                        {{-- MENSAJE DE ALERTA CUANDO TE SUSCRIBES
                        <div class="contenedor">
                            @if (session('mensaje'))
                                <div class="alert alert-info mt-2 alert-dismissible fade show" role="alert">
                                    <strong>Importante!:</strong> {{ session('mensaje') }}.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- LLAMADA DEL COMPONENTE COURSE CARD FREE 
                <x-course-card :courses="$coursesFree" url="gratis"></x-course-card>
            </section>
            --}}



            {{-- video con contenidos de la plataforma --}}
            <section class="our-services section-home" id="services">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="text-dark font-weight-bold">Temario UNFV</h5>
                            <h3 class="font-weight mb-5 color-general">Aprendizaje continuo con IA</h3>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up">
                        <div class="col-md-12">
                            @include('helpers.video', [
                                'video' => asset('videos/Contenido.mp4'),
                            ])
                        </div>

                        {{--
                        <div class="col-md-6">
                            @include('helpers.video', [
                                'video' => asset('videos/IA.mp4'),
                            ])
                        </div>

                        <div class="col-md-6 mt-3">
                            @include('helpers.video', [
                                'video' => asset('videos/suscripción_preunicursos.mp4'),
                            ])
                        </div>
                        --}}

                    </div>
                </div>
            </section>



            <!-- Ahora incluimos la vista suscripcion.blade.php -->
            @include('helpers.suscripcion')


            {{-- BENEFICIOS 
            <section class="our-services section-home" id="services">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="text-dark font-weight-bold">Beneficios en</h5>
                            <h3 class="font-weight mb-5 color-general">PreuniCursos</h3>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up">
                        <div class="col-sm-4 text-lg-left">
                            <div class="services-box" data-aos="fade-down" data-aos-easing="linear"
                                data-aos-duration="1500">
                                <div class="text-center">
                                    <img src="{{ asset('img/home/ilimitado.png') }}" data-aos="zoom-in">
                                </div>
                                <h6 class="text-dark mb-3 mt-4 font-weight-medium">Aprendizaje Ilimitado</h6>
                                <p>Accede sin límites a clases, videos, guías y evaluaciones diseñadas para reforzar tus
                                    conocimientos y mejorar tu rendimiento escolar.</p>
                            </div>
                        </div>

                        <div class="col-sm-4 text-lg-left">
                            <div class="services-box pb-lg-0" data-aos="fade-down" data-aos-easing="linear"
                                data-aos-duration="1500">
                                <div class="text-center">
                                    <img src="{{ asset('img/home/pdf.png') }}" data-aos="zoom-in">
                                </div>
                                <h6 class="text-dark mb-3 mt-4 font-weight-medium">Material de Estudio Interactivo</h6>
                                <p>Descarga guías, resúmenes y ejercicios en formato PDF para practicar en casa o en el
                                    colegio. Ideal para reforzar tus clases y prepararte mejor.</p>
                            </div>
                        </div>

                        <div class="col-sm-4 text-lg-left">
                            <div class="services-box" data-aos="fade-down" data-aos-easing="linear"
                                data-aos-duration="1500">
                                <div class="text-center">
                                    <img src="{{ asset('img/home/examen.png') }}" data-aos="zoom-in">
                                </div>
                                <h6 class="text-dark mb-3 mt-4 font-weight-medium">Evaluaciones Inteligentes</h6>
                                <p>Practica con exámenes por curso y nivel. Nuestro sistema analiza tus resultados y te
                                    recomienda los temas que debes reforzar. 📊</p>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            --}}






            {{-- video con los pasos de suscripcion
            <section class="our-process section-home" id="">
                <div class="container">
                    <div class="row mb-3" data-aos="fade-up" data-aos-offset="-500">
                        <div class="col-sm-12">
                            <div class="d-sm-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h3 class="font-weight-medium color-general mb-3">Pasos
                                        para tu Suscripción</h3>
                                    <h5 class="text-dark ">Acceso ilimitado a cursos, exámenes y material educativo
                                        las 24 horas del día</h5>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center" data-aos="fade-up" data-aos-offset="-300">
                        @include('helpers.video', [
                            'video' => asset('videos/suscripción_preunicursos.mp4'),
                        ])
                    </div>
                </div>
            </section>
            video con los pasos de suscripcion --}}






            <section class="our-process section-home" id="about">
                <div class="container">
                    <div class="row align-items-center" data-aos="fade-up">
                        <div class="col-sm-6">
                            <h5 class="text-dark font-weight-bold">Únete a nuestra comunidad educativa</h5>
                            <h3 class="font-weight-medium color-general">🎓 ¡Descubre EduperuApp!</h3>
                            <h5 class="text-dark mb-3 font-weight-bold">Tu aliado académico para reforzar y
                                aprender mejor
                            </h5>

                            <p class="font-weight-medium mb-4 text-dark">
                                Aprende a tu ritmo, refuerza tus conocimientos y alcanza tus metas con nuestra
                                plataforma de acompañamiento escolar. 🌟
                            </p>

                            <div class="d-flex justify-content-start mb-3">
                                <img src="{{ asset('img/home/item.png') }}" alt="tick" class="mr-3 tick-icon">
                                <p class="text-dark font-weight-bold mb-0">Materiales interactivos y guías en
                                    PDF</p>
                            </div>

                            <div class="d-flex justify-content-start mb-3">
                                <img src="{{ asset('img/home/item.png') }}" alt="tick" class="mr-3 tick-icon">
                                <p class="text-dark font-weight-bold mb-0">Evaluaciones por áreas y simulacros
                                    preuniversitarios</p>
                            </div>

                            <div class="d-flex align-items-start mb-3">
                                <img src="{{ asset('img/home/item.png') }}" alt="ícono de IA" class="mr-3 tick-icon">
                                <p class="text-dark font-weight-bold mb-0">
                                    Asistencia personalizada con <span class="text-primary"><strong>Inteligencia
                                            Artificial</strong></span> 🤖
                                    para ayudarte a resolver tus dudas y mejorar tu rendimiento.
                                </p>
                            </div>

                            <div class="d-flex justify-content-start">
                                <img src="{{ asset('img/home/item.png') }}" alt="tick" class="mr-3 tick-icon">
                                <p class="text-dark font-weight-bold mb-0">Acceso de por vida y soporte continuo
                                    para
                                    estudiantes</p>
                            </div>
                        </div>

                        <div class="col-sm-6 text-right" data-aos="flip-left" data-aos-easing="ease-out-cubic"
                            data-aos-duration="2000">
                            <img src="{{ asset('img/home/idea.png') }}" alt="idea" class="img-fluid ">
                        </div>
                    </div>

                </div>
            </section>


            <section class="our-projects section-home" id="projects">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-sm-12">
                            <div class="d-sm-flex justify-content-between align-items-center mb-2">
                                <h3 class="text-dark mb-3 mt-4 font-weight-medium">Lista de
                                    Cursos</h3>
                                <div><a href="{{ route('visitador.course.index') }}" class="btn btn-primary">Ver
                                        todos los cursos</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-5" data-aos="fade-up">
                    <div class="owl-carousel-projects owl-carousel owl-theme">
                        @foreach ($courses as $course)
                            <div class="item">
                                <a href="{{ route('visitador.course.show', ['course' => $course]) }}">
                                    <img class="imagen" src="{{ $course->image->url }}" alt="slider">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="container">
                    <div class="row pt-5 mt-5 pb-5 mb-5">
                        <div class="col-sm-3">
                            <div class="d-flex py-3 my-3 my-lg-0 justify-content-center" data-aos="fade-down">
                                <img src="{{ asset('img/home/usuarios.png') }}" alt="satisfied-client" class="mr-3">
                                <div>
                                    <h4 class="font-weight-bold text-dark mb-0"><span class="scVal">0</span>+
                                    </h4>
                                    <h5 class="text-dark mb-0">Estudiantes</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="d-flex py-3 my-3 my-lg-0 justify-content-center" data-aos="fade-up">
                                <img src="{{ asset('img/home/pruebas.png') }}" alt="satisfied-client" class="mr-3">
                                <div>
                                    <h4 class="font-weight-bold text-dark mb-0"><span class="fpVal">0</span>+
                                    </h4>
                                    <h5 class="text-dark mb-0">Exámenes</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="d-flex py-3 my-3 my-lg-0 justify-content-center" data-aos="fade-down">
                                <img src="{{ asset('img/home/videos.png') }}" alt="Team Members" class="mr-3">
                                <div>
                                    <h4 class="font-weight-bold text-dark mb-0"><span class="tMVal">0</span>+
                                    </h4>
                                    <h5 class="text-dark mb-0">Lista de Videos</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="d-flex py-3 my-3 my-lg-0 justify-content-center" data-aos="fade-up">
                                <img src="{{ asset('img/home/recursos.png') }}" alt="Our Blog Posts" class="mr-3">
                                <div>
                                    <h4 class="font-weight-bold text-dark mb-0"><span class="bPVal">0</span>+
                                    </h4>
                                    <h5 class="text-dark mb-0">Recursos PDF</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>


        @include('template.footer')

    </body>
@endsection
