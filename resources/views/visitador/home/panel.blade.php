@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection

@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">Acceso Rápido</h3>
            <p class="ultimos-cursos-parrafo text-white">{{ $user->name }}</p>
        </div>
    </header>
@endsection


@section('main')
    <div class="container py-5">
        <h2 class="mb-4 fw-bold text-center text-primary">Panel Principal</h2>

        <div class="row">

            <!-- Card 1 -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('visitador.course.index') }}" class="text-decoration-none">
                    <div class="card text-white shadow border-0 h-100 card-hover"
                        style="background: linear-gradient(135deg, #ff7eb3, #ff758c);">
                        <div class="card-body text-center py-5">
                            <i class='bx bxs-mouse-alt' style="font-size: 72px;"></i>
                            <h5 class="card-title fw-semibold mt-3">Cursos</h5>
                            <h2 class="fw-bold"> {{ $courses->count() }} </h2>
                            <p class="small opacity-75 mb-0">Cursos disponibles</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('visitador.read.index') }}" class="text-decoration-none">
                    <div class="card text-white shadow border-0 h-100 card-hover"
                        style="background: linear-gradient(135deg, #1de9b6, #1dc4e9);">
                        <div class="card-body text-center py-5">
                            <i class='bx bxs-book-add' style="font-size: 72px;"></i>
                            <h5 class="card-title fw-semibold mt-3">Recursos</h5>
                            <h2 class="fw-bold"> {{ $archivos->count() }} </h2>
                            <p class="small opacity-75 mb-0">Material descargable</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('visitador.examenes.index') }}" class="text-decoration-none">
                    <div class="card text-white shadow border-0 h-100 card-hover"
                        style="background: linear-gradient(135deg, #42a5f5, #478ed1);">
                        <div class="card-body text-center py-5">
                            <i class='bx bxs-book-reader' style="font-size: 72px;"></i>
                            <h5 class="card-title fw-semibold mt-3">Mis Exámenes</h5>
                            <h2 class="fw-bold"> {{ $examenes->count() }} </h2>
                            <p class="small opacity-75 mb-0">Exámenes disponibles</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 4 -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('visitador.compendio.index') }}" class="text-decoration-none">
                    <div class="card text-white shadow border-0 h-100 card-hover"
                        style="background: linear-gradient(135deg, #7b4397, #dc2430);">
                        <div class="card-body text-center py-5">
                            <i class='bx bxs-book-bookmark' style="font-size: 72px;"></i>
                            <h5 class="card-title fw-semibold mt-3">Compendios</h5>
                            <h2 class="fw-bold"> {{ $compendios->count() }} </h2>
                            <p class="small opacity-75 mb-0">Compendios académicos</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 5 -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('visitador.graficos.index') }}" class="text-decoration-none">
                    <div class="card text-white shadow border-0 h-100 card-hover"
                        style="background: linear-gradient(135deg, #ba68c8, #8e24aa);">
                        <div class="card-body text-center py-5">
                            <i class='bx bx-bar-chart-alt-2 bx-tada' style="font-size: 72px;"></i>
                            <h5 class="card-title fw-semibold mt-3">Progreso</h5>
                            <p class="small mb-0 opacity-75">Visualiza tu avance en cada curso.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Card 6 -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('visitador.bot.contenidoia') }}" class="text-decoration-none">
                    <div class="card text-white shadow border-0 h-100 card-hover"
                        style="background: linear-gradient(135deg, #ffb74d, #ff9800);">
                        <div class="card-body text-center py-5">
                            <i class='bx bx-brain bx-burst' style="font-size: 72px;"></i>
                            <h5 class="card-title fw-semibold mt-3">IA Educativa</h5>
                            <p class="small mb-0 opacity-75">Consulta temas, pide resúmenes o genera material adicional.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <hr>

        <div class="row g-4">

        </div>
    </div>

    <!-- Estilos extra -->
    <style>
        .card-hover {
            transition: all 0.3s ease;
            border-radius: 20px;
        }

        .card-hover:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }
    </style>


    @include('template.footer')
@endsection
