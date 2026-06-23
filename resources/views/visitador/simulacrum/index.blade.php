@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('main')
    <section class="" id="contenido-bloques">
        <div class="contenedor">
            <div class="row">
                <h2 class="contenido-bloques-titulo pt-4"></h2>

                @livewire('simulacrum')

                @forelse ($exams as $exam)
                    <div class="col-md-3 my-2">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">{{ $exam->nombre }}</h2>
                                <div class="text-center">
                                    <img class="img-fluid" src="{{ asset('img/home/pruebas.png') }}"
                                        alt="Imagene de la prueba">
                                </div>
                                <p class="contenido-bloques-parrafo mt-2">Tiempo estimado :
                                    {{ $exam->duracion }}
                                    minutos</p>

                                @can('enrolledExamUser', $exam)
                                    @can('ExamUserStatus', $exam)
                                        <a href="{{ route('visitador.examenes.status', ['exam' => $exam]) }}"
                                            class="btn btn-primary mt-2 w-100">Continuar el Examen</a>
                                    @else
                                        <a href="{{ route('visitador.examenes.show', ['exam' => $exam]) }}"
                                            class="btn btn-primary mt-2 w-100">Ver Resultados</a>
                                    @endcan
                                @else
                                    <form id="inscribirmeForm_{{ $exam->id }}"
                                        action="{{ route('visitador.examenes.enrolled', ['exam' => $exam]) }}" method="GET">
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
                @empty
                    <div class="col-md-12 my-4">
                        <div class="mi-card shadow-lg rounded-4 border-0">
                            <div class="mi-card-content p-4 text-center">

                                <!-- Título -->
                                <h2 class="contenido-bloques-titulo mb-3 fw-bold text-primary">
                                    Crea tu Simulacro y Ponte a Prueba
                                </h2>

                                <!-- Descripción breve opcional -->
                                <p class="text-muted mb-4">
                                    Selecciona tus cursos, define las preguntas y evalúa tus conocimientos de forma
                                    dinámica.
                                </p>

                                <!-- Imagen -->
                                <div class="d-flex justify-content-center">
                                    <img class="img-fluid rounded-3" src="{{ asset('img/home/pruebas.png') }}"
                                        alt="Imagen de simulacro" style="max-width: 350px;">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @include('template.footer')
@endsection
