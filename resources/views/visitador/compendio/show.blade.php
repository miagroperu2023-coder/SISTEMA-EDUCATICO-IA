@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('main')
    <section class="" id="contenido-bloques">
        <div class="contenedor">
            <h2 class="contenido-bloques-titulo pt-4"></h2>

            @include('helpers.documento')
        </div>
    </section>

    @include('template.footer')
@endsection
