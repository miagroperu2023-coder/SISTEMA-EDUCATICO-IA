@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">{{ auth()->user()->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">Mi Seguimiento</p>
        </div>
    </header>
@endsection



@section('main')
    <section>
        <div class="" id="contenido-bloques">
            <div class="contenedor">
                <div class="row">


                    <canvas id="progressChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>


       
        <script src="{{ asset('js/visitador/chart/progresoCursos.js') }}"></script>
    </section>

    @include('template.footer')
@endsection
