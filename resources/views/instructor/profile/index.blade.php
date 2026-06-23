@extends('layouts.app')


@section('navegador')
    @include('template.nav-instructor')
@endsection



@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">Profile {{ $user->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">actualiza tus datos y redes sociales</p>
        </div>
    </header>
@endsection


@section('main')
    <section class="" id="contenido-bloques">
        <div class="contenedor">
            <div>
                @livewire('profiles', ['user' => $user], key($user->id))
            </div>
        </div>
    </section>
@endsection
