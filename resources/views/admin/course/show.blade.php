@extends('layouts.app')

@section('bosstrap.css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection

@section('navegador')
    @include('template.nav-admin')
@endsection




@section('main')
    {{-- DESCRIPCION DEL CURSO Y SUS CARACTERISTICAS --}}
    <section id="curso-show" class="">
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>


        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <figure>
                        <img src="{{ $course->image->url }}" class="" alt="...">
                    </figure>
                </div>
                <div class="col-md-6 curso-show-descripcion">
                    <div>
                        <h2 class="curso-show-titulo">{{ $course->title }}</h2>
                        <h3 class="curso-show-subtitulo">{{ $course->subtitle }}</h3>
                        <p><i class='bx bx-signal-5'></i>Nivel: {{ $course->level->name }}</p>
                        <p><i class='bx bxs-category-alt'></i>Categoria: {{ $course->category->name }}</p>
                        <p><i class='bx bxs-user-plus'></i>Matriculados: {{ $course->students_count }}</p>
                        <p><i class='bx bxs-star-half'></i>Calificación: {{ $course->rating }}</p>
                        <p><i class='bx bx-infinite'></i>Acceso de por vida</p>
                        <p><i class='bx bxs-file-pdf'></i>Recursos Descargables</p>
                        <p><i class='bx bx-devices'></i>Disponible en móviles como en PC</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- DESCRIPCION DEL CURSO Y SUS CARACTERISTICAS --}}


    <div id="curso-show-columna-ocho">
        <div class="contenedor">
            <div class="row">
                {{-- COLUMNA IZQUIERDA --}}
                <div class="col-md-8 mt-3">
                    {{-- INPRIMIENDO LAS METAS --}}
                    <section class="">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="color-general">Lo que aprenderás</h3>
                                <ul class="row">
                                    @foreach ($course->goals as $goal)
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <i class='bx bx-label color-general'
                                                    style='color:#4b22f4;margin-right: 3px'></i>

                                                <li class="">{{ $goal->name }}</li>
                                            </div>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </section>
                    {{-- INPRIMIENDO LAS METAS --}}




                    {{-- INPRIMIENDO LAS SECCIONES DE LOS CURSOS --}}
                    <section id="temario">
                        <h3 class="mt-4 mb-3 color-general">Temario</h3>
                        @foreach ($course->sections as $section)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $section->id }}">
                                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#{{ $section->id }}"
                                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                        aria-controls="{{ $section->id }}">
                                        {{ $section->name }}
                                    </button>
                                </h2>
                                <div id="{{ $section->id }}"
                                    class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                    aria-labelledby="heading{{ $section->id }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach ($section->lessons as $lesson)
                                                <li class="d-flex align-items-center my-1">
                                                    <i class='bx bxs-videos' style='color:#4b22f4 ; font-size: 22px'></i>
                                                    <p class="temario-parrafo">{{ $lesson->name }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </section>
                    {{-- INPRIMIENDO LAS SECCIONES DE LOS CURSOS --}}


                    {{-- INPRIMIENDO LOS REQUERIMIENTOS --}}
                    <section class="mt-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="mb-3 color-general">Requisitos</h3>
                                <ul>
                                    @foreach ($course->requirements as $requirement)
                                        <div class="d-flex align-items-center">
                                            <i class='bx bx-check' style='color:#4b22f4;margin-right: 3px'></i>
                                            <li>{{ $requirement->name }}</li>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </section>
                    {{-- INPRIMIENDO LOS REQUERIMIENTOS --}}


                    {{-- INPRIMIENDO LA DESCRIPCION DEL CURSO --}}
                    <section class="mt-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="mb-3 color-general">Descripción</h3>
                                <div class="d-flex align-items-center">
                                    <i class='bx bxs-hand-right' style='color:#4b22f4;margin-right: 3px'></i>
                                    <p class="">{!! $course->description !!}</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    {{-- INPRIMIENDO LA DESCRIPCION DEL CURSO --}}


                    {{-- RESEÑAS DE LOS CURSOS --}}
                    @livewire('courses-reviews', ['course' => $course], key($course->id))
                    {{-- RESEÑAS DE LOS CURSOS --}}
                </div>
                {{-- COLUMNA IZQUIERDA --}}



                {{-- COLUMNA DERECHA --}}
                <div class="col-md-4 mt-3">
                    <section>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex item-center">
                                    <img src="{{ $course->teacher->profile_photo_url }}" alt="">
                                    <div>
                                        <p>Calaborador:{{ $course->teacher->name }}</p>
                                        <a href="#">{{ '@' . Str::slug($course->teacher->name, '') }}</a>
                                    </div>
                                </div>

                                <form action="{{ route('admin.courses.approved', ['course' => $course]) }}" method="POST">
                                    @csrf
                                    <button class="mi-boton rojo mt-3 w-100" type="submit">Aprobar este curso</button>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
                {{-- COLUMNA DERECHA --}}
            </div>
        </div>
    </div>

@section('bosstrap.js')
    <!-- CDN JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
@endsection
