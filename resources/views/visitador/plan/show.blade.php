@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">Pasos </h3>
            <p class="ultimos-cursos-parrafo text-white">para tu suscripción</p>
        </div>
    </header>
@endsection


@section('main')
    <section class="" id="contenido-bloques">
        <div class="contenedor">

            <div class="row justify-content-center">
                @include('helpers.video', [
                    'video' => asset('videos/suscripción_preunicursos.mp4'),
                ])
            </div>

        </div>
    </section>

    <!-- Ahora incluimos la vista suscripcion.blade.php -->
    @include('helpers.suscripcion')

    @include('template.footer')
@endsection
