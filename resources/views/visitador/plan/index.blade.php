@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">Tu Plan </h3>
            <p class="ultimos-cursos-parrafo text-white">{{ $user->name }}</p>
        </div>
    </header>
@endsection


@section('main')
    <section class="" id="contenido-bloques">
        <div class="contenedor">

            <div class="row">
                {{-- ACTUALIZAR USUARIO --}}
                <div class="mi-card">
                    <div class="mi-card-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" value="{{ $user->name }}" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Correo</label>
                                    <input type="email" readonly value="{{ auth()->user()->email }}"
                                        class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mi-card mt-4">
                    <div class="mi-card-content">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">TIPO PLAN ({{ $suscription->id }})</label>
                                    <input type="text" class="form-control" value="{{ $suscription->collection_status }}"
                                        placeholder="plan del estudiante" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">DESCRIPCIÓN</label>
                                    <input type="text" value="{{ $suscription->status }}" class="form-control"
                                        placeholder="resumen" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">FORMA</label>
                                    <input type="text" value="{{ $suscription->processing_mode }}" class="form-control"
                                        placeholder="elemento" />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">PROCESO</label>
                                    <input type="text" value="{{ $suscription->estado }}" class="form-control"
                                        placeholder="categoria de pago" />
                                </div>
                            </div>
                        </div>

                        @if ($suscription->collection_status == 'PLAN-PRE-UNI')
                            <div class="mt-3">
                                <form action="{{ route('mercadopago.suscription.cancel') }}" method="POST">
                                    @csrf
                                    <input type="submit" class="btn btn-outline-danger" value="Cancelar Plan">
                                </form>
                            </div>
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <p> {{ $suscription->collection_status }} </p>
                                </div>
                            </div>
                            <div class="mt-3">
                                {{--
                                <form action="{{ route('mercadopago.suscription.school.cancel') }}" method="POST">
                                    @csrf
                                    <input type="submit" class="btn btn-outline-danger" value="Cancelar Plan">
                                </form>
                                --}}
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
