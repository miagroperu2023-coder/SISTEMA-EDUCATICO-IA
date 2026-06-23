@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('main')
    <section class="mt-4" id="contenido-bloques">
        <div class="contenedor">
            <div class="row justify-content-center">
                <div class="col-md-12">

                      @livewire('content-i-a', ['user' => $user], key($user->id)) 
                </div>
            </div>
        </div>
    </section>

    @include('template.footer')
@endsection
