@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">{{ auth()->user()->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">Mis Cursos Gratis</p>
        </div>
    </header>
@endsection


@section('main')

    @if ($courseUsers->count())
        <section id="contenido-bloques">
            <div class="container">
                <div class="row">
                    @foreach ($courseUsers as $course)
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">

                            <div class="card h-100 shadow-sm border-0">

                                <a href="{{ route('visitador.course.free.show', $course) }}">
                                    <img src="{{ $course->image->url }}" class="card-img-top"
                                        style="height:220px; object-fit:cover;" alt="{{ $course->title }}">
                                </a>

                                <div class="card-body d-flex flex-column">

                                    <h5 class="card-title fw-bold text-center mb-4">
                                        {{ $course->title }}
                                    </h5>

                                    @can('enrolledFree', $course)
                                        <div class="mt-auto">
                                            <a href="{{ route('visitador.course.status', $course) }}"
                                                class="btn btn-primary w-100">

                                                <i class='bx bx-play-circle me-1'></i>
                                                Continuar curso

                                            </a>
                                        </div>
                                    @endcan

                                </div>

                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        {{-- LLAMADA DEL COMPONENTE COURSE CARD --}}
        <section id="ultimos-cursos" class="text-center">
            <h3 class="ultimos-cursos-titulo color-general">Aún no tienes cursos. Matricúlate ahora!</h3>
            <p class="ultimos-cursos-parrafo color-general"></p>
            <div class="">
                {{-- LLAMADA DEL COMPONENTE COURSE CARD --}}
                @if (auth()->check())
                    <x-course-card :courses="$courses" url="gratis"></x-course-card>
                @else
                    <x-course-card :courses="$courses" url="premium"></x-course-card>
                @endif
                {{-- @if (auth()->check())
                    @if (auth()->user()->userSuscriptionUrl())
                        <x-course-card :courses="$courses" url="premium"></x-course-card>
                    @else
                        <x-course-card :courses="$courses" url="gratis"></x-course-card>
                    @endif
                @else
                    <x-course-card :courses="$courses" url="premium"></x-course-card>
                @endif
                --}}
            </div>
        </section>

        @include('helpers.link-suscripcion')
    @endif

    @include('template.footer')
@endsection
