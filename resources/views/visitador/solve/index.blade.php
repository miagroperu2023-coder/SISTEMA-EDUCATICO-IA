@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('main')
    <section class="mt-4" id="contenido-bloques">
        <div class="contenedor">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @livewire('post-solve', ['post' => $post], key('post-solve-' . $post->id))
                </div>
            </div>

            {{-- PIZARRA --}}
            @include('helpers.pizarra')
        </div>
    </section>

    @include('template.footer')
@endsection
