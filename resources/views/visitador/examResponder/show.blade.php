@extends('layouts.app')



@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">{{ auth()->user()->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">Tu Record de : {{ $exam->nombre }}</p>
        </div>
    </header>
@endsection


@section('main')
    <section class="" id="contenido-bloques">
        <div class="contenedor">
            <div class="row">

                <div class="col-md-12">
                    {{-- @if (!empty($recomendacion['texto']))
                <div class="mi-card mt-3">
                    <div class="mi-card-content">
                        <h2 class="contenido-bloques-titulo">🧠 Recomendación Personalizada</h2>
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <p class="contenido-bloques-parrafo">{!! nl2br(e($recomendacion['texto'])) !!}</p>
                            </div>
                        </div>

                        @if ($recomendacion['videos']->isNotEmpty())
                        <h3 class="mt-4 contenido-bloques-titulo">🎥 Videos recomendados para repasar</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            @foreach ($recomendacion['videos'] as $video)
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="fw-bold text-primary">{{ $video['curso'] }} -
                                        {{ $video['seccion'] }}</h5>
                                    <p>{{ $video['titulo'] }}</p>
                                    @if ($video['url'])
                                    <iframe width="100%" height="200" src="{{ $video['url'] }}" frameborder="0"
                                        allowfullscreen></iframe>
                                    <iframe src="https://www.youtube.com/embed/{{ $video['iframe'] }}" allowfullscreen
                                        allowtransparency allow="autoplay"
                                        style="width: 100%; height: 450px !important;"></iframe>
                                    @else
                                    <small class="text-muted">Video no disponible.</small>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                --}}

                    @livewire(
                        'recomendation',
                        [
                            'exam' => $exam,
                            'examUser' => $examUser,
                            'userExamAnswers' => $userExamAnswers,
                        ],
                        key($user->id)
                    )
                </div>


                @if (session('mensaje'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>¡Atención!</strong> {{ session('mensaje') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="col-md-3 my-2">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">{{ $exam->nombre }}</h2>

                            <div class="card">
                                <div class="card-body">
                                    <p class="contenido-bloques-parrafo mt-2">Duración:
                                        <strong>{{ $exam->duracion }} minutos</strong>
                                    </p>
                                    <p class="contenido-bloques-parrafo mt-2">Estado: <strong>{{ $exam->estado }}</strong>
                                    </p>
                                    <p class="contenido-bloques-parrafo mt-2">
                                        Creación: <strong>{{ $exam->created_at->diffForHumans() }}</strong>
                                    </p>

                                    {{-- <p class="contenido-bloques-parrafo mt-2">
                                    Publicación: {{ \Carbon\Carbon::parse($exam->publicacion)->diffForHumans() }}
                                </p> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mi-card mt-2">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">Calificación!</h2>

                            <div class="card">
                                <div class="card-body">
                                    <p class="contenido-bloques-parrafo mt-2">Puntos Obtenidos:
                                        <strong>{{ $examUser->calificacion }} puntos</strong>
                                    </p>
                                    <p class="contenido-bloques-parrafo mt-2">Estado:
                                        <strong>{{ $examUser->status }}</strong>
                                    </p>
                                    <p class="contenido-bloques-parrafo mt-2">
                                        Inscrito: <strong>{{ $examUser->created_at->diffForHumans() }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- para poder realizar otra vez el examen --}}
                    @if ($examUser->status == 'Culminado')
                        <div class="mi-card mt-2">
                            <div class="mi-card-content">
                                @if (auth()->user()->userSuscriptionUrl()->exists())
                                    <form
                                        action="{{ route('visitador.examenes.reset', ['exam' => $exam, 'examUser' => $examUser]) }}"
                                        method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-primary w-100" value="Retomar">
                                    </form>
                                @else
                                    <form
                                        action="{{ route('visitador.examenes.free.reset', ['exam' => $exam, 'examUser' => $examUser]) }}"
                                        method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-primary w-100" value="Retomar">
                                    </form>
                                @endif
                            </div>
                        </div>
                    @else
                        <a href="{{ route('visitador.examenes.index') }}" class="btn btn-outline-danger mt-2 w-100">Mis
                            exámenes</a>
                    @endif

                </div>

                <div class="col-md-9 my-2">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">Tus Respuestas!</h2>

                            @foreach ($userExamAnswers as $index => $userExamAnswer)
                                <div class="card-block">
                                    <div class="message-box contact-box">
                                        <div class="message-widget contact-widget">
                                            <div class="accordion" id="accordionExample">
                                                <div class="card">
                                                    <div class="card-header text-center" id="heading{{ $index }}">
                                                        <h2 class="mb-0 d-flex flex-column align-items-center">

                                                            <!-- Botón centrado -->
                                                            <div class="w-100 mb-2">
                                                                <button class="btn btn-outline-primary w-100" type="button"
                                                                    data-toggle="collapse"
                                                                    data-target="#collapse{{ $index }}"
                                                                    aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                                    aria-controls="collapse{{ $index }}">
                                                                    Pregunta {{ $index + 1 }}
                                                                </button>
                                                            </div>

                                                            <!-- Pregunta abajo -->
                                                            <div class="mt-2 w-100 text-left">
                                                                <p class="mb-0">{!! $userExamAnswer->examQuestion->question->titulo !!}</p>
                                                            </div>
                                                        </h2>
                                                    </div>

                                                    <!-- Respuestas -->
                                                    <div id="collapse{{ $index }}"
                                                        class="collapse {{ $index == 0 ? 'show' : '' }}"
                                                        aria-labelledby="heading{{ $index }}"
                                                        data-parent="#accordionExample">
                                                        <div class="card-body">
                                                            <ul class="list-group">
                                                                <li class="list-group-item">
                                                                    <strong>Respuestas:</strong>
                                                                    <ul class="mt-2">
                                                                        @foreach ($userExamAnswer->examQuestion->question->answers as $answer)
                                                                            <li>
                                                                                <strong>{{ $answer->titulo }}</strong>
                                                                                @if ($answer->es_correcta)
                                                                                    <span class="text-success">
                                                                                        <small>(Correcta)</small>
                                                                                    </span>
                                                                                @endif

                                                                                @if ($userExamAnswer->answer->id == $answer->id)
                                                                                    <span
                                                                                        class="{{ $answer->es_correcta ? 'text-success' : 'text-danger' }}">
                                                                                        <small>(Seleccionada)</small>
                                                                                    </span>
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('template.footer')

@section('bosstrap.js')
    <!-- CDN JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
@endsection
