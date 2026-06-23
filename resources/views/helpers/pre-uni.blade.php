@canany(['viewSubscription', 'viewSubscriptionSixMonth', 'viewSubscriptionYear'], auth()->user())
    {{-- PLAN CON SUSCRIPCIÓN --}}

    <li class="item">
        <a href="{{ route('visitador.panel') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-slideshow bx-sm'></i>
                <span>Mi Panel</span>
            </div>
        </a>
    </li>

    {{--
    <li class="item">
        <a href="{{ route('visitador.course.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-slideshow bx-sm'></i>
                <span>Cursos Premium</span>
            </div>
        </a>
    </li>
    --}}

    <li class="item">
        <a href="{{ route('visitador.course.list') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-mouse-alt bx-sm'></i>
                <span>Mis Cursos Premium</span>
            </div>
        </a>
    </li>

    <li class="item">
        <a href="{{ route('visitador.simulacrum.index') }}">
            <div class="d-flex align-items-center gap-2">
                <i class='bx bx-edit bx-sm'></i>
                <span>Crear mi Simulacro</span>
            </div>
        </a>
    </li>

    {{--
    <li class="item">
        <a href="{{ route('visitador.read.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-book-add bx-sm'></i>
                <span>Mis Recursos</span>
            </div>
        </a>
    </li>
    --}}


    {{--
    <li class="item">
        <a href="{{ route('visitador.examenes.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-book-reader bx-sm'></i>
                <span>Mis Exámenes</span>
            </div>
        </a>
    </li>
    --}}


    {{--
    <li class="item">
        <a href="{{ route('visitador.compendio.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-book-bookmark bx-sm'></i>
                <span>Mis Compendios</span>
            </div>
        </a>
    </li>
    --}}


    {{--
    <li class="item">
        <a href="{{ route('visitador.graficos.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bx-bar-chart-alt-2 bx-tada bx-sm'></i>
                <span>Mi Seguimiento</span>
            </div>
        </a>
    </li>
    --}}


    <li class="item">
        <a href="{{ route('visitador.bot.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bx-bot bx-burst bx-sm'></i>
                <span>Bot PreuniCursos</span>
            </div>
        </a>
    </li>


    {{-- SOLO PARA PLAN 12 MESES --}}
    <li class="item">
        <a href="{{ route('visitador.post.index') }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bx-message-dots bx-burst bx-sm'></i>
                <span>Publicaciones</span>
            </div>
        </a>
    </li>

    <li class="item">
        <a href="{{ route('profile.index', ['user' => auth()->user()]) }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-user-rectangle bx-sm'></i>
                <span>{{ auth()->user()->name }}</span>
            </div>
        </a>
    </li>
    
    <li class="item">
        <a href="{{ route('visitador.plan.index', ['user' => auth()->user()]) }}">
            <div class="d-flex align-items-center gap-1">
                <i class='bx bxs-cool bx-sm'></i>
                <span>Mi plan</span>
            </div>
        </a>
    </li>

    <li class="item">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <input type="submit" class="mi-boton general mt-2 w-100 btn-rounded" value="Salir">
        </form>
    </li>
@else
    {{-- SIN PLAN --}}
    @include('helpers.sin-plan')
@endcanany
