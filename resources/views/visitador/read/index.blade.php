@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">{{ auth()->user()->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">Recursos Descargables</p>
        </div>
    </header>
@endsection



@section('main')
    <section>
        <div class="" id="contenido-bloques">
            <div class="contenedor">
                <div class="row">

                    @foreach ($courses as $index => $course)
                        <div class="col-md-12 my-2">
                            <div id="accordion{{ $index }}">
                                <div class="card">
                                    <div class="card-header" id="heading{{ $index }}">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link text-decoration-none" data-toggle="collapse"
                                                data-target="#collapse{{ $index }}"
                                                aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $index }}">
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class='bx bx-link-alt color-general' style="font-size: 25px"></i>
                                                    <h1 class="lead color-general" style="font-size: 25px">Recurso del curso de {{ $course->title }}</h1>
                                                </div>
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse{{ $index }}" class="collapse {{ $index == 0 ? 'show' : '' }}"
                                        aria-labelledby="heading{{ $index }}"
                                        data-parent="#accordion{{ $index }}">
                                        @foreach ($course->archives as $archive)
                                            <a href="{{ route('visitador.read.show', ['archive' => $archive]) }}">
                                                <li class="d-flex align-items-center my-1">
                                                    <i class='bx bxs-file-pdf'
                                                        style='color: #1a1f71; font-size: 45px; border-radius: 50%'></i>
                                                    <p class="temario-parrafo" style="font-size: 18px;color: #1a1f71;">{{ $archive->name }}</p>
                                                </li>
                                            </a>
                                            <hr>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    @include('template.footer')
@endsection
