<div>
    <input type="checkbox" id="btn-menu">
    <label class="contenedor-menu" for="btn-menu"> {{-- ESTE DIV SE CAMBIO POR UN LABEL PARA TENER EL "for=""" --}}
        <div class="contenido-menu">
            <nav>
                <ul class="menu-item">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Cursos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="item"><a href="{{ route('admin.courses.index') }}">Cursos en Revisión</a></li>
                            <li class="item"><a href="{{ route('admin.prices.index') }}">Precios</a></li>
                            <li class="item"><a href="{{ route('admin.categories.index') }}">Categorias</a></li>
                            <li class="item"><a href="{{ route('admin.levels.index') }}">Niveles</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Permisos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="item"><a href="{{ route('admin.users.index') }}">Usuarios</a></li>
                            <li class="item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                        </ul>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Recursos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="item"><a href="{{ route('admin.resources.index') }}">Contenidos</a></li>
                            <li class="item"><a href="{{ route('admin.reads.index') }}">Lectura</a></li>
                            <li class="item"><a href="{{ route('admin.compendiums.index') }}">Compendios</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Publicaciones
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="item"><a href="{{ route('admin.posts.index') }}">Crear post</a></li>
                            <li class="item"><a href="{{ route('admin.posts.list') }}">Lista</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Pagos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="item"><a href="{{ route('admin.pays.index') }}">Pagos</a></li>
                            <li class="item"><a href="{{ route('admin.pays.list') }}">Lista por atender</a></li>
                        </ul>
                    </li>

                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Planes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="item"><a href="{{ route('admin.plan.index') }}">Planes</a></li>
                           
                        </ul>
                    </li>

                    <li class="item"><a
                            href="{{ route('admin.profile.index', ['user' => auth()->user()]) }}">Bienvenido:
                            {{ auth()->user()->name }}</a></li>

                    <li class="item">
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <input type="submit" class="btn btn-primary w-100 btn-rounded" value="Salir">
                        </form>
                    </li>
                </ul>
            </nav>
            <label for="btn-menu"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-x"
                    width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1a1f71" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                    <path d="M10 10l4 4m0 -4l-4 4" />
                </svg></label>
        </div>
    </label>{{-- ESTE DIV SE CAMBIO POR UN LABEL PARA TENER EL "for=""" --}}

    <nav id="navegador">
        <div class="contenedor">
            <div class="navegador-flex">

                <label for="btn-menu">
                    <div class="logo">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2"
                            width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00122d"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 6l16 0" />
                            <path d="M4 12l16 0" />
                            <path d="M4 18l16 0" />
                        </svg>
                        <p>ADM</p>
                    </div>
                </label>

                <div class="caja-img">
                    <a target="_blank" href="{{ route('visitador.home.index') }}">
                        <img src="{{ asset('img/logo/logo.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </nav>
</div>
