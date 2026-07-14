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
                            Crea tu cuenta
                        </h3>

                        <p class="text-muted mb-4">
                            Regístrate para comenzar a utilizar la plataforma.
                        </p>

                        @if (session('mensaje'))
                            <div class="alert alert-danger">
                                {{ session('mensaje') }}
                            </div>
                        @endif

                        <form id="formRegister" action="{{ route('admin.register.store') }}" method="POST">

                            @csrf

                            <!-- Nombre -->
                            <div class="mb-3">
                                <label class="form-label">Nombre completo</label>

                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Tu nombre">

                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Correo electrónico</label>

                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="ejemplo@gmail.com">

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Contraseña -->
                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>

                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="********">

                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirmar -->
                            <div class="mb-4">
                                <label class="form-label">Confirmar contraseña</label>

                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="********">

                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-primary w-100 py-2" id="btn-register">
                                Registrarme
                            </button>

                        </form>

                        <!-- Google -->
                        <div class="mt-3">

                            <a href="{{ route('google.auth.redirect') }}"
                                class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center">

                                <img src="https://cdn-icons-png.flaticon.com/64/5968/5968534.png" width="22"
                                    class="me-2">

                                Registrarme con Google

                            </a>

                        </div>

                        <!-- Botones -->
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

    <!-- Agrega esto al final de tu página antes de cerrar el cuerpo -->
    <!-- ... Código HTML anterior ... -->

    <style>
        .is-invalid {
            border: 1px solid red !important;
            /* Borde rojo */
        }
    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');
            const form = document.getElementById('formRegister');
            const registerButton = document.getElementById('btn-register');

            emailInput.addEventListener('change', function() {
                if (!isValidEmail(emailInput.value)) {
                    // Agregar la clase 'is-invalid' si el correo es inválido
                    emailInput.classList.add('is-invalid');
                } else {
                    // Quitar la clase 'is-invalid' si el correo es válido
                    emailInput.classList.remove('is-invalid');
                }

                updateButtonState();
            });

            form.addEventListener('submit', function(event) {
                if (!isValidEmail(emailInput.value)) {
                    event.preventDefault();
                    alert(
                        'Por favor, ingresa una dirección de correo electrónico válida con una extensión permitida (gmail, hotmail).'
                    );
                } else {
                    registerButton.disabled = true;
                }
            });

            function isValidEmail(email) {
                const allowedDomains = ['gmail.com', 'hotmail.com'];
                const emailParts = email.split('@');

                if (emailParts.length === 2) {
                    const domain = emailParts[1].toLowerCase();
                    return allowedDomains.includes(domain);
                }

                return false;
            }

            function updateButtonState() {
                console.log('botón desactivado');
                registerButton.disabled = !isValidEmail(emailInput.value);
            }
        });
    </script>


@section('bosstrap.js')
    <!-- CDN JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
@endsection
