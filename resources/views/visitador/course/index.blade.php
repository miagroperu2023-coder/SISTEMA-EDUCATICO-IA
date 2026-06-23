@extends('layouts.app')



@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-course-fondo" id="header-home">
        <div class="contenedor">
            {{-- COMPONENTE LIVEWIRE BUSCADOR --}}
            @livewire('search')
        </div>
    </header>
@endsection


@section('main')
    <section id="ultimos-cursos" class="text-center">
        <h3 class="ultimos-cursos-titulo color-general">Cursos Premium</h3>
        <p class="ultimos-cursos-parrafo color-general"></p>

        {{-- MENSAJE DE ALERTA CUANDO TE SUSCRIBES --}}
        <div class="contenedor">
            @if (session('mensaje'))
                <div class="alert alert-info mt-2 alert-dismissible fade show" role="alert">
                    <strong>Importante!:</strong> {{ session('mensaje') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="">
            {{-- LLAMADA DEL COMPONENTE COURSE CARD PREMIUM--}}
            @if (auth()->check())
                <x-course-card :courses="$courses" url="premium"></x-course-card>
            @else
                <x-course-card :courses="$courses" url="premium"></x-course-card>
            @endif
        </div>
    </section>

    @include('template.footer')


@endsection
