@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">{{ auth()->user()->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">Lista de Exámenes</p>
        </div>
    </header>
@endsection



@section('main')
    <section>
        <div class="" id="contenido-bloques">
            <div class="contenedor">
                @foreach ($courses as $course)
                    <div class="col-md-12 my-2">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">Exámenes de {{ $course->title }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($course->exams->where('type', 'NORMAL') as $exam)
                            <div class="col-md-3 my-2">
                                <div class="mi-card">
                                    <div class="mi-card-content">
                                        <h2 class="contenido-bloques-titulo">{{ $exam->nombre }}</h2>
                                        <div class="text-center">
                                            <img class="img-fluid" src="{{ asset('img/home/pruebas.png') }}"
                                                alt="Imagene de la prueba">
                                        </div>
                                        <p class="contenido-bloques-parrafo mt-2">Tiempo estimado : {{ $exam->duracion }}
                                            minutos</p>

                                        @can('enrolledExamUser', $exam)
                                            @can('ExamUserStatus', $exam)
                                                <a href="{{ route('visitador.examenes.free.status', ['exam' => $exam]) }}"
                                                    class="btn btn-primary mt-2 w-100">Continuar el Examen</a>
                                            @else
                                                <a href="{{ route('visitador.examenes.free.show', ['exam' => $exam]) }}"
                                                    class="btn btn-outline-danger mt-2 w-100">Ver Resultados</a>
                                            @endcan
                                        @else
                                            <form id="inscribirmeForm_{{ $exam->id }}"
                                                action="{{ route('visitador.examenes.free.enrolled', ['exam' => $exam]) }}"
                                                method="GET">
                                                <button type="submit"
                                                    class="btn btn-outline-primary mt-2 w-100 inscribirme-btn">Inscribirme</button>
                                            </form>
                                        @endcan
                                    </div>

                                    <!-- Script para desactivar el botón después de hacer clic -->
                                    <script>
                                        $(document).ready(function() {
                                            $('#inscribirmeForm_{{ $exam->id }}').on('submit', function() {
                                                // Desactivar el botón inmediatamente después de hacer clic
                                                var $button = $(this).find('button');
                                                $button.prop('disabled', true).text('Inscribiendo...');
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('helpers.link-suscripcion')


    @include('template.footer')
@endsection
