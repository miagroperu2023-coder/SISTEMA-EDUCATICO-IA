<div class="mt-5">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="" id="curso-status">
        <div class="row">
            <div class="col-md-8 mb-2">
                <!-- Plyr Video Embed -->
                <div class="plyr__video-embed" id="player">
                    <iframe src="https://www.youtube.com/embed/{{ $current->iframe }}" allowfullscreen allowtransparency
                        allow="autoplay" style="width: 100%; height: 450px !important;"></iframe>
                </div>

                {{-- NAVEGACiON DE LECCIONES --}}
                <section id="contenido-bloques" style="padding-top: 0px !important; padding-bottom: 0px !important;">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h1 class="color-general curso-status-title">{{ $current->name }}</h1>
                            <div class="mt-3 d-flex justify-content-between">
                                @if ($this->index == 0)
                                    <a class="mi-boton azul" wire:click="changeLesson({{ $current }})">Primero</a>
                                @else
                                    <a class="mi-boton general"
                                        wire:click="changeLesson({{ $this->previous }})">Anterior</a>
                                @endif

                                @if ($this->next)
                                    <a class="mi-boton general"
                                        wire:click="changeLesson({{ $this->next }})">Siguiente</a>
                                @else
                                    <a class="mi-boton rojo" wire:click="changeLesson({{ $current }})">Último</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
                {{-- NAVEGACiON DE LECCIONES --}}

                {{-- RECURSOS DE LA LECCION --}}
                @if ($current->resource)
                    <iframe style="width: 100%;height: 550px;" src="{{ $current->resource->url }}"
                        title="W3Schools Free Online Web Tutorials">
                    </iframe>
                @endif
                {{-- RECURSOS DE LA LECCION --}}
            </div>


            <div class="col-md-4">
                <div class="card ">
                    <div class="card-body">
                        <h1 class="lead mb-3 color-general curso-status-title">Curso de {{ $course->title }}</h1>

                        {{-- BARRA DE PROGRESO --}}
                        <div class="d-flex justify-content-between">
                            <p style='color: #1a1f71;'><strong>{{ $this->advance . '%' }}</strong> Completado</p>

                            {{-- MARCAR COMO CULMINADA LA LECCION --}}
                            <div class="d-flex align-items-center cursor" wire:click="completed">
                                @if ($current->completed)
                                    <i class='bx bxs-toggle-right'
                                        style='color: #1a1f71;  font-size: 28px'></i>
                                    <p class="cursor-status" style='font-size: 18px'>culminado</p>
                                @else
                                    <i class='bx bx-toggle-left' style="font-size: 28px"></i>
                                    <p class="cursor-status" style='font-size: 18px'>culminar</p>
                                @endif
                            </div>
                            {{-- MARCAR COMO CULMINADA LA LECCION --}}
                        </div>
                        <div class="progress mt-2" style="width: 100% !important;">
                            <div class="progress-bar" role="progressbar"
                                style="width: {{ $this->advance . '%' }}; background-color: color: #1a1f71;"
                                aria-valuenow="{{ $this->advance }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        {{-- BARRA DE PROGRESO --}}


                        {{-- INPRIMIENDO LAS SECCIONES DE LOS CURSOS --}}
                        <div class="accordion accordion-flush" id="accordionFlushExample"
                            data-section-id="{{ $current->section_id }}" style="max-height: 300px; overflow-y: auto;">
                            @foreach ($course->sections as $section)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading{{ $section->id }}">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapse{{ $section->id }}" aria-expanded="false"
                                            aria-controls="flush-collapse{{ $section->id }}">
                                            <p class="color-general">{{ $section->name }}</p>
                                        </button>
                                    </h2>
                                    <div id="flush-collapse{{ $section->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="flush-heading{{ $section->id }}"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul>
                                                @foreach ($section->lessons as $lesson)
                                                    <li class="d-flex my-1">
                                                        {{-- ver si esta completada la leccion --}}
                                                        <div>
                                                            @if ($lesson->completed)
                                                                {{-- SI EL CURSO ESTA COMPLETO Y ESTAMOS EN ESA POSICION BORDEAMOS EL CIRCULO --}}
                                                                @if ($current->id == $lesson->id)
                                                                    <i class='bx bx-play-circle bx-burst'
                                                                        style='color: #1a1f71; font-size: 22px'></i>
                                                                @else
                                                                    {{-- DE LO CONTRARIO QUE  ME PINTE DE VERDE --}}
                                                                    <i class='bx bx-check-circle'
                                                                        style='color: #1a1f71; font-size: 22px'></i>
                                                                @endif
                                                            @else
                                                                @if ($current->id == $lesson->id)
                                                                    <i class='bx bx-play-circle bx-burst'
                                                                        style='color:#1a1f71; font-size: 22px'></i>
                                                                @else
                                                                    <i class='bx bx-bolt-circle'
                                                                        style='color:#99a29b; font-size: 22px'></i>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        {{-- NOMBRE DE LA LECCION --}}
                                                        <a style="margin-top: 2px" class="cursor-status"
                                                            wire:click="changeLesson({{ $lesson }})">{{ $lesson->name }}
                                                            @if ($lesson->resource)
                                                                <i class='bx bxs-file-pdf bx-burst'
                                                                    style='color: #1a1f71'></i>
                                                            @endif
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- INPRIMIENDO LAS SECCIONES DE LOS CURSOS --}}



                        {{-- CITA DEL VIDEO --}}
                        <div class="card my-3">
                            <div class="card-body">

                                <!-- MODAL REFERENCIA VIDEO-->
                                @include('helpers.course-status-modal.cita-video')
                                <!-- MODAL REFERENCIA VIDEO-->

                                {{-- MODAL REFERENCIA DE LA LECCION --}}
                                @include('helpers.course-status-modal.cita-material')
                                {{-- MODAL REFERENCIA DE LA LECCION --}}

                                {{-- link caido para dar aviso --}}
                                @include('helpers.course-status-modal.link-caido')

                                {{-- Archivo del curso para la descarga --}}
                                @include('helpers.course-status-modal.archivo-descarga')

                            </div>
                        </div>
                        {{-- CITA DEL VIDEO --}}


                        @section('scripts')
                            <script src="{{ asset('js/visitador/livewire/link-caido.js') }}"></script>

                            <!-- Plyr Initialization Script -->
                            <script src="{{ asset('js/visitador/livewire/lessonChangedPlyr.js') }}"></script>

                            <!--Acordeon en donde me encuentro-->
                            <script src="{{ asset('js/visitador/livewire/lessonAcordeon.js') }}"></script>
                        @endsection
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
