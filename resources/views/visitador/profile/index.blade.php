@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">Profile </h3>
            <p class="ultimos-cursos-parrafo text-white">{{ $user->name }}</p>
        </div>
    </header>
@endsection


@section('main')
    <section class="" id="contenido-bloques">
        <div class="contenedor">

            @livewire('profiles', ['user' => $user], key($user->id))

        </div>
    </section>
@endsection
