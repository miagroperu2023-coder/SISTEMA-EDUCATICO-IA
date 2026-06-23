@extends('layouts.app')


@section('main')
    <section class="vh-100">
        <div class="wrapper">
            <div class="inner">
                <img src="{{ asset('img/login/image-1.png') }}" alt="" class="image-1">
                <form class="form" action="{{ route('admin.login.store') }}" method="POST">

                    {{-- token de seguridad --}}
                    @csrf

                    {{-- MENSAJE SI ESTAN MAL LAS CREDENCIALES --}}
                    @if (session('mensaje'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-between mb-3">
                        <div> <a class="btn-solid-sm" href="{{ route('admin.register.index') }}">Registrarme</a></div>
                        <div> <a class="btn-solid-sm" href="{{ route('visitador.home.index') }}">Casa</a></div>
                    </div>

                    <div class="form-holder">
                        <span><i class='bx bx-envelope'></i></i></span>
                        <input type="email" value="{{ old('email') }}" name="email" id="email"
                            class="form-control-login" placeholder="Tu Gmail" />
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-holder">
                        <span><i class='bx bx-barcode'></i></span>
                        <input type="password" id="password" name="password" class="form-control-login"
                            placeholder="**********" />
                    </div>
                    {{-- validacon con validate --}}
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row my-2">
                        <div class="col d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check d-flex">
                                <label class="form-check-label" for="remember"> Recordarme </label>
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" />
                            </div>
                        </div>

                        <div class="col">
                            <!-- Simple link -->
                            <a href="{{ route('admin.recover') }}">mi Contraseña?</a>
                        </div>
                    </div>

                    <button class="button-login button-login-blue">
                        <span>Ingresar</span>
                    </button>

                    <div class="d-flex justify-content-center text-center mx-auto my-3">
                        <!-- Botón de Google -->
                        <div class="text-center">
                            <a href="{{ route('google.auth.redirect') }}">
                                <img src="https://cdn-icons-png.flaticon.com/64/5968/5968534.png" alt="Gmail">
                            </a>
                            <a class="mt-1 d-block fw-bold text-dark" href="{{ route('google.auth.redirect') }}">Iniciar
                                con Gmail</a>
                        </div>

                        <!-- Botón de Facebook
                                <div class="text-center">
                                    <a href="{{ route('facebook.auth.redirect') }}">
                                        <img src="https://cdn-icons-png.flaticon.com/64/5968/5968764.png" alt="Facebook">
                                    </a>
                                    <a class="mt-1 d-block fw-bold text-dark" href="{{ route('facebook.auth.redirect') }}">Iniciar
                                        con Facebook</a>
                                </div>
                                -->
                    </div>

                </form>

                <img src="{{ asset('img/login/image-2.png') }}" alt="" class="image-2">
            </div>

        </div>
    </section>
@endsection
