@extends('layouts.app')

@section('bosstrap.css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection

@section('main')

    <body class="vh-100 bg-white">

        <div class="container-fluid vh-100">
            <div class="row h-100">

                <!-- IZQUIERDA -->
                <div class="col-lg-4 d-flex align-items-center justify-content-center">

                    <div style="width:85%; max-width:420px;">

                        <!-- Logo -->
                        <div class="mb-4">
                            <img src="{{ asset('img/logo/logo.png') }}" width="150" alt="Logo">
                        </div>

                        <h3 class="fw-bold mb-2">
                            Recuperar cuenta
                        </h3>

                        <p class="text-muted mb-4">
                            Ingresa el correo electrónico con el que te registraste y te ayudaremos a recuperar tu cuenta.
                        </p>

                        @if (session('mensaje'))
                            <div class="alert alert-info">
                                {{ session('mensaje') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.send') }}" method="POST">

                            @csrf

                            <div class="mb-4">

                                <label class="form-label">
                                    Correo electrónico
                                </label>

                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="ejemplo@gmail.com">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <button class="btn btn-primary w-100 py-2">
                                Recuperar mi cuenta
                            </button>

                        </form>

                        <div class="row mt-4">

                            <div class="col-6 d-grid">
                                <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                    Ingresar
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
                <div class="col-lg-8 d-none d-lg-block p-0">

                    <img src="{{ asset('img/home/header.jpg') }}" class="w-100 h-100" style="object-fit:cover;"
                        alt="Imagen">

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
