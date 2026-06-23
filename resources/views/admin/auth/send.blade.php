@extends('layouts.app')


@section('main')
    <section class="vh-100">
        <div class="wrapper">
            <div class="inner">
                <img src="{{ asset('images/login/image-1.png') }}" alt="" class="image-1">
                <form class="form" action="{{ route('admin.send') }}" method="POST">

                    {{-- token de seguridad --}}
                    @csrf

                    {{-- MENSAJE SI ESTAN MAL LAS CREDENCIALES --}}

                    <div class="text-center alert alert-dark">Por favor, introduzca la dirección de correo electrónico
                        utilizada durante el registro en la plataforma.</div>

                    @if (session('mensaje'))
                        {{-- MENSAJE SI ESTAN MAL LAS CREDENCIALES --}}
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Mensaje!</strong> {{ session('mensaje') }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <h3 class="h3-login">Recuperar</h3>
                        <div> <a class="btn-solid-sm" href="{{ route('visitador.home.index') }}">Casa</a></div>
                    </div>

                    <div class="form-holder">
                        <span><i class='bx bx-envelope'></i></i></span>
                        <input type="email" value="{{ old('email') }}" name="email" id="email" class="form-control"
                            placeholder="Tu Gmail" />
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>



                    <button class="button-login">
                        <span>Recuperar Mi Cuenta</span>
                    </button>
                </form>
                <img src="{{ asset('images/login/image-2.png') }}" alt="" class="image-2">
            </div>

        </div>
    </section>
@endsection
