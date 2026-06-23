@extends('layouts.app')

@section('bosstrap.css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection

@section('navegador')
    @include('template.nav-visitador')
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
                    <div class="curso-detalle">
                        <h2 class="curso-show-titulo">{{ $course->title }}</h2>
                        <h3 class="curso-show-subtitulo">{{ $course->subtitle }}</h3>

                        <p><i class='bx bx-signal-5'></i> Nivel: <strong>{{ $course->level->name }}</strong></p>
                        <p><i class='bx bxs-category-alt'></i> Categoría: <strong>{{ $course->category->name }}</strong></p>
                        <p><i class='bx bxs-user-plus'></i> Curso inteligente con apoyo de <strong>IA</strong></p>
                        <p><i class='bx bxs-star-half'></i> Calificación promedio: <strong>{{ $course->rating }}</strong>
                        </p>
                        <p><i class="bx bx-infinite"></i> Disfruta de acceso <strong>ilimitado 24/7</strong> a todo el contenido</p>
                        <p><i class='bx bxs-file-pdf'></i> Material descargable en <strong>PDF</strong> y videos</p>
                        <p><i class='bx bx-brain'></i> Recomendaciones personalizadas con <strong>IA</strong></p>
                        <p><i class='bx bx-devices'></i> Compatible con <strong>móvil, tablet y PC</strong></p>
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
                                            <div class="d-flex ">
                                                <div>
                                                    <i class='bx bx-label color-general'
                                                        style='margin-right: 3px; margin-top:5px'></i>
                                                </div>

                                                <li class=""><strong>{{ $goal->name }}</strong></li>
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
                                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                        style="color: #1a1f71 !important;" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#{{ $section->id }}"
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
                                                <li class="d-flex my-1">
                                                    <i class='bx bxs-videos' style='color:#1a1f71 ; font-size: 22px'></i>
                                                    <p class="temario-parrafo font-weight-bold">{{ $lesson->name }}</p>
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
                                        <div class="d-flex">
                                            <i class='bx bx-check'
                                                style='color:#1a1f71;margin-right: 3px; margin-top:5px;'></i>
                                            <li class="font-weight-bold">{{ $requirement->name }}</li>
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
                                    <i class='bx bxs-hand-right' style='color:#1a1f71;margin-right: 3px'></i>
                                    <p class="font-weight-bold">{!! $course->description !!}</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    {{-- INPRIMIENDO LA DESCRIPCION DEL CURSO --}}


                    {{-- INPRIMIENDO LA AUDIENCIA DEL CURSO --}}
                    <section class="mt-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="mb-3 color-general">Audiencia</h3>
                                <ul>
                                    @foreach ($course->audiences as $audience)
                                        <div class="d-flex">
                                            <i class='bx bxs-pin'
                                                style='color:#1a1f71;margin-right: 3px; margin-top:5px'></i>
                                            <li class="font-weight-bold">{{ $audience->name }}</li>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </section>
                    {{-- INPRIMIENDO LA AUDIENCIA DEL CURSO --}}


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
                                <div class="d-flex item-center pb-2">
                                    <img src="{{ $course->teacher->profile_photo_url }}" alt="">
                                    <div>
                                        <p style="font-size: 20px">Colaborador:{{ $course->teacher->name }}</p>
                                        @if (optional($course->teacher->profile)->website)
                                            <a style="color: #1a1f71 !important;"
                                                href="{{ $course->teacher->profile->website }}" target="_blank">
                                                {{ '@' . Str::slug($course->teacher->name, '') }}
                                            </a>
                                        @else
                                            <a style="color: #1a1f71 !important;"
                                                href="#">{{ '@' . Str::slug($course->teacher->name, '') }}</a>
                                        @endif
                                    </div>
                                </div>

                                {{-- POLICY PARA VERIFICAR SI YA ESTOY MATRICULADO EN EL CURSO --}}
                                @auth
                                    {{-- VERIFICAMOS SI TIENE UNA SUSCRIPCION --}}
                                    @canany(['viewSubscription', 'viewSubscriptionSixMonth', 'viewSubscriptionYear'],
                                        auth()->user())
                                        {{-- Aquí verificamos la suscripción regular --}}
                                        {{-- VERIFICAMOS SI ESTA MATRICULADO EN EL CURSO QUE ESTA VIENDO --}}
                                        @can('enrolled', $course)
                                            <a href="{{ route('visitador.course.status', ['course' => $course]) }}"
                                                class="btn-solid-sm p-4 text-center mt-3 w-100">CONTINUAR CURSO</a>
                                        @else
                                            {{-- SI NO LO ESTA LLEVA EL CURSO POR SER PREMIUM --}}
                                            <form id="matricularmeFrm"
                                                action="{{ route('visitador.course.enrolled', ['course' => $course]) }}"
                                                method="POST">
                                                @csrf
                                                <button class="btn-solid-sm p-4 text-center mt-3 w-100" type="submit">INGRESAR
                                                    AHORA</button>
                                            </form>

                                            {{--
                                            @if ($course->price->value == 0)
                                                <p style="font-size: 22px;font-weight: bold" class="color-general">
                                                    {{ $course->price->name }} S/.0</p>
                                                <form id="matricularmeFrm"
                                                    action="{{ route('visitador.course.enrolled', ['course' => $course]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn-solid-sm p-4 text-center mt-3 w-100" type="submit">INGRESAR
                                                        AHORA</button>
                                                </form>
                                            @else
                                                {{-- SI NO LO ESTA LLEVA EL CURSO POR SER PREMIUM 
                                                <form id="matricularmeFrm"
                                                    action="{{ route('visitador.course.enrolled', ['course' => $course]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button class="btn-solid-sm p-4 text-center mt-3 w-100" type="submit">INGRESAR
                                                        AHORA</button>
                                                </form>
                                            @endif
                                            --}}
                                        @endcan
                                    @else
                                        {{-- VERIFICAMOS SI ESTA MATRICULADO EN EL CURSO QUE ESTA VIENDO --}}
                                        @can('enrolledFree', $course)
                                            <a href="{{ route('visitador.course.status', ['course' => $course]) }}"
                                                class="btn-solid-sm p-4 text-center mt-3 w-100">CONTINUAR CURSO</a>
                                        @else
                                            {{-- SI NO LO ESTA LLEVA EL CURSO POR SER PREMIUM --}}
                                            <form id="matricularmeFrm"
                                                action="{{ route('visitador.course.free.enrolled', ['course' => $course]) }}"
                                                method="POST">
                                                @csrf
                                                <button class="btn-solid-sm p-4 text-center mt-3 w-100" type="submit">INGRESAR
                                                    AHORA</button>
                                            </form>
                                        @endCan
                                    @endcanany
                                @endauth

                                @guest
                                    <a href="{{ route('admin.register.index') }}"
                                        class="btn-solid-sm p-4 text-center mt-1 w-100">MATRICULATE AHORA</a>
                                @endguest
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $('#matricularmeFrm').on('submit', function() {
                                    //Desactivar el boton inmediatamente despue sde hacer click
                                    var $button = $(this).find('button');
                                    $button.prop('disabled', true).text('MATRICULANDOME');
                                })
                            })
                        </script>
                    </section>


                    {{-- CURSOS SIMILARS --}}
                    <aside class="mt-3">
                        @foreach ($similares as $similar)
                            <article class="d-flex mb-3">
                                <a href="{{ route('visitador.course.show', ['course' => $similar]) }}">
                                    <img style="height: 100px;object-fit: cover" src="{{ $similar->image->url }}"
                                        alt="">
                                </a>

                                <div style="margin-left: 12px">
                                    <h3 style="font-size: 15px; text-align: justify;"><a
                                            style="color: #1a1f71 !important;"
                                            href="{{ route('visitador.course.show', ['course' => $similar]) }}">{{ Str::limit($similar->title, 40) }}</a>
                                    </h3>

                                    <div class="d-flex align-items-center">
                                        <img style="width: 30px;height: 30px;border-radius: 50%;"
                                            src="{{ $similar->image->url }}" alt="">
                                        <p style="font-size: 10.6px;margin-left: 5px">{{ $similar->teacher->name }}</p>
                                    </div>

                                    <p class="mt-2"><i class='bx bxs-star'
                                            style='color:#1a1f71'></i>{{ $similar->rating }}</p>
                                </div>
                            </article>
                        @endforeach
                    </aside>
                    {{-- CURSOS SIMILARS --}}
                </div>
                {{-- COLUMNA DERECHA --}}
            </div>
        </div>
    </div>

    <div class="mt-5">
        @include('template.footer')
    </div>

@section('bosstrap.js')
    <!-- CDN JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
@endsection
