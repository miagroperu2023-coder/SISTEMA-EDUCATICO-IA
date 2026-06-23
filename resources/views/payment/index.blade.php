@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">Lo que aprendere {{ $course->title }}</h3>
            <p class="ultimos-cursos-parrafo text-white">no hay limites para aprender, eso está en ti</p>
        </div>
    </header>
@endsection


@section('main')
    <section class="" id="contenido-bloques">
        <div class="contenedor">
            <div class="row">

                <div class="col-md-3 my-2">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>IMPORTANTE!</strong>
                                <p style="text-align: justify">Después de enviar el número de operación, el sistema
                                    verificará el pago en 24 horas. Se enviará un correo al estudiante con el estado del
                                    cobro. <strong>Si el número de operación es incorrecto, se revocará el acceso al
                                        curso</strong>.</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 my-2" title=" {!! Str::limit($course->description, 150) !!}">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">{{ $course->title }}</h2>
                            <div class="text-center">
                                <a href="{{ route('visitador.course.show', ['course' => $course]) }}">
                                    <img class="imagen" src="{{ $course->image->url }}" alt="">
                                </a>
                            </div>

                            {{-- <p class="contenido-bloques-parrafo mt-3">
                                {!! Str::limit($course->description, 150) !!}
                            </p> --}}

                            <div class="d-flex justify-content-between mt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <i class='bx bxs-user-plus' style="font-size: 24px"></i>
                                    <p>({{ $course->students_count }})</p>
                                </div>
                                <ul class="d-flex">
                                    <li>
                                        <i style='color:#da920f'
                                            class='bx bx-star {{ $course->rating >= 1 ? 'bx bxs-star' : '' }}'></i>
                                    </li>
                                    <li>
                                        <i style='color:#da920f'
                                            class='bx bx-star {{ $course->rating >= 2 ? 'bx bxs-star' : '' }}'></i>
                                    </li>
                                    <li>
                                        <i style='color:#da920f'
                                            class='bx bx-star {{ $course->rating >= 3 ? 'bx bxs-star' : '' }}'></i>
                                    </li>
                                    <li>
                                        <i style='color:#da920f'
                                            class='bx bx-star {{ $course->rating >= 4 ? 'bx bxs-star' : '' }}'></i>
                                    </li>
                                    <li>
                                        <i style='color:#da920f'
                                            class='bx bx-star {{ $course->rating == 5 ? 'bx bxs-star' : '' }}'></i>
                                    </li>
                                </ul>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                @if ($course->price->value == 0)
                                    <p style="font-size: 22px;font-weight:bold" class="color-general">
                                        {{ $course->price->name }}
                                        S/.0</p>
                                @else
                                    <p style="font-size: 22px; font-weight:bold" class="color-general">
                                        {{ $course->price->value }}
                                        S/.</p>
                                @endif

                                @if (optional($course->teacher->profile)->website)
                                    <a href="{{ $course->teacher->profile->website }}" target="_blank">
                                        <p class="contenido-bloques-parrafo color-general">
                                            {{ $course->teacher->name }}</p>
                                    </a>
                                @else
                                    <p class="contenido-bloques-parrafo color-general">
                                        {{ $course->teacher->name }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 my-2">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">Qr Yape</h2>
                            <div class="text-center">
                                <img src="https://i.postimg.cc/FHQ3LsyM/Captura.png" style="width: 200px;height: 200px;"
                                    alt="qr" border="0">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 my-2">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <div class="">
                                <h2 class="contenido-bloques-titulo">Costo: {{ $course->price->value }} S/.</h2>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('yape.index', ['course' => $course]) }}" method="POST"
                                        id="paymentForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="number" class="form-label">N° de operación:</label>
                                            <input type="number" class="form-control" name="payment_id" id="payment_id"
                                                min="0" placeholder="N° de operación: 00099521" required>
                                            <div id="emailHelp" class="form-text">
                                                <p># de operación.</p>
                                            </div>
                                        </div>
                                        <button type="submit" id="btn-pago-yape" class="mi-boton general mt-2 w-100">Enviar
                                            Datos</button>
                                    </form>


                                    <script src="{{ asset('js/pay/pay.js') }}"></script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="{{ asset('js/mercadopago.js') }}"></script>
@endsection
