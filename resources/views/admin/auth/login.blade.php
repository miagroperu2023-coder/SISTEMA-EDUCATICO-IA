@extends('layouts.app')

@section('bosstrap.css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection

@section('main')

    <body class="vh-100 bg-white">

        <div class="container-fluid h-100">
            <div class="row h-100">

                <!-- IZQUIERDA -->
                <div class="col-lg-5 d-flex align-items-center justify-content-center">

                    <div class="w-75">

                        <!-- Logo -->
                        <div class="mb-4 mt-3">
                            <img src="{{ asset('img/logo/logo.png') }}" width="150" alt="Logo">
                        </div>

                        <h3 class="fw-bold mb-2">
                            Inicia sesión en tu cuenta
                        </h3>

                        <p class="text-muted mb-4">
                            Accede a la plataforma
                        </p>

                        {{-- Error --}}
                        @if (session('mensaje'))
                            <div class="alert alert-danger">
                                {{ session('mensaje') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.login.store') }}" method="POST">

                            @csrf

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">
                                    Correo electrónico
                                </label>

                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="ejemplo@correo.com">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">

                                <label class="form-label">
                                    Contraseña
                                </label>

                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="********">

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <!-- Recordarme -->
                            <div class="d-flex justify-content-between align-items-center mb-4">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">

                                    <label class="form-check-label" for="remember">
                                        Recordarme
                                    </label>
                                </div>

                                <a href="{{ route('admin.recover') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>

                            </div>

                            <!-- Botón -->
                            <button class="btn btn-primary w-100 py-2">
                                Iniciar sesión
                            </button>

                        </form>

                        <!-- Google -->
                        <div class="mt-3">

                            <a href="{{ route('google.auth.redirect') }}"
                                class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center">

                                <img src="https://cdn-icons-png.flaticon.com/64/5968/5968534.png" width="22"
                                    class="me-2">

                                Continuar con Google

                            </a>

                        </div>

                        <!-- Botones inferiores -->

                        <div class="row mt-4">

                            <div class="col-6 d-grid">

                                <a href="{{ route('admin.register.index') }}" class="btn btn-outline-primary">

                                    Registrarme

                                </a>

                            </div>

                            <div class="col-6 d-grid">

                                <a href="{{ route('visitador.home.index') }}" class="btn btn-outline-dark">

                                    Inicio

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- DERECHA -->

                <div class="col-lg-7 d-none d-lg-block p-0">

                    <div class="h-100 w-100"
                        style="
                        background-image:url('{{ asset('img/home/header.jpg') }}');
                        background-size:cover;
                        background-position:center;
                    ">
                    </div>

                </div>

            </div>
        </div>

    </body>

@section('bosstrap.js')
    <!-- CDN JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
@endsection
