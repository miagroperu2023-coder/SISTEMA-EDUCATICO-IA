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
    <section class="" id="contenido-bloques">
        <div class="contenedor">
            <h2>{{ $course->title }}</h2>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 my-3">
                            <div class="text-center">
                                <img src="{{ $course->image->url }}" class="card-img-top" alt="...">
                            </div>
                        </div>
                        <div class="col-md-6 my-3">
                            <p style="text-align: justify">{{ $contenido->url }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('footer')
    @include('template.footer')
@endsection