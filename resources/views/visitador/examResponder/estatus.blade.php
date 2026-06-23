@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">{{ auth()->user()->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">{{ $exam->nombre }}</p>
        </div>
    </header>
@endsection


@section('main')
    <section class="" id="contenido-bloques">
        <div class="contenedor">
            <div>
                @livewire('exam-responder', ['exam' => $exam, 'examUser' => $examUser], key($exam->id))
            </div>
        </div>
    </section>
@endsection
