@extends('layouts.app')


@section('main')
    <section class="vh-100">
        <div class="wrapper">
            <div class="inner">
                <img src="{{ asset('img/login/image-1.png') }}" alt="" class="image-1">
                <form class="form" id="formRegister" action="{{ route('admin.register.store') }}" method="POST">

                    {{-- token de seguridad --}}
                    @csrf

                    {{-- MENSAJE SI ESTAN MAL LAS CREDENCIALES --}}
                    @if (session('mensaje'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-between mb-3">
                        <div> <a class="btn-solid-sm" href="{{ route('login') }}">Ingresar</a></div>
                        <div> <a class="btn-solid-sm" href="{{ route('visitador.home.index') }}">Casa</a></div>
                    </div>

                    <div class="form-holder">
                        <span><i class='bx bx-user-check'></i></span>
                        <input type="text" id="name" name="name" class="form-control-login"
                            value="{{ old('name') }}" placeholder="Tu nombre o nombre de usuario" />
                    </div>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="form-holder">
                        <span><i class='bx bx-envelope'></i></i></span>
                        <input type="email" name="email" value="{{ old('email') }}" id="email"
                            class="form-control-login" placeholder="Tu Gmail" />
                    </div>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="form-holder">
                        <span><i class='bx bx-barcode'></i></span>
                        <input type="password" id="password" name="password" class="form-control-login"
                            placeholder="contraseña" />
                    </div>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="form-holder">
                        <span><i class='bx bx-barcode'></i></span>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control-login" placeholder="repetir contraseña" />
                    </div>
                    @error('password_confirmation')
                        {{-- alerta de error --}}
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <button class="button-login button-login-blue" id="btn-register">
                        <span>Registrarme</span>
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
                    </div>

                </form>
                <img src="{{ asset('img/login/image-2.png') }}" alt="" class="image-2">
            </div>

        </div>
    </section>

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



    <!-- ... Código HTML posterior ... -->
@endsection
