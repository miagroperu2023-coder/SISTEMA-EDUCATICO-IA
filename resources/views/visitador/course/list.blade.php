@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">{{ auth()->user()->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">Mis Cursos premium</p>
        </div>
    </header>
@endsection


@section('main')

    @if ($courseUsers->count())
        <section id="contenido-bloques">
            <div class="container">
                <div class="row">
                    @foreach ($courseUsers as $course)
                        <div class="col-md-3 mb-3">
                            <div class="mi-card">
                                <div class="mi-card-content">
                                    <div class="text-center">
                                        <a href="{{ route('visitador.course.show', ['course' => $course]) }}">
                                            <img class="imagen" src="{{ $course->image->url }}" alt="">
                                        </a>
                                    </div>
                                    <h4 class="contenido-bloques-titulo">{{ $course->title }}</h4>
                                    @can('enrolled', $course)
                                        <a href="{{ route('visitador.course.status', ['course' => $course]) }}"
                                            class="btn btn-primary w-100">Continuar con el curso</a>
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
                    @if (auth()->user()->userSuscriptionUrl())
                        <x-course-card :courses="$courses" url="premium"></x-course-card>
                    @else
                        <x-course-card :courses="$courses" url="gratis"></x-course-card>
                    @endif
                @else
                    <x-course-card :courses="$courses" url="premium"></x-course-card>
                @endif
            </div>
        </section>
    @endif

    @include('template.footer')
@endsection
