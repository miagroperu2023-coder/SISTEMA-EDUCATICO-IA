<div>
    <input type="checkbox" id="btn-menu">
    <label class="contenedor-menu" for="btn-menu"> {{-- ESTE DIV SE CAMBIO POR UN LABEL PARA TENER EL "for=""" --}}
        <div class="contenido-menu">
            <nav>
                <ul class="menu-item">
                    @auth
                        {{-- PLAN PRE UNI --}}
                        @include('helpers.pre-uni')

                        {{-- PLAN ESCOLAR 
                        @include('helpers.escolar') --}}


                    @endauth

                    @guest
                        <li class="item">
                            <a href="{{ route('visitador.home.index') }}">
                                <div class="d-flex align-items-center gap-1">
                                    <i class='bx bxs-home bx-sm'></i>
                                    <span>Casa</span>
                                </div>
                            </a>
                        </li>
                        <li class="item">
                            <a href="{{ route('visitador.course.index') }}">
                                <div class="d-flex align-items-center gap-1">
                                    <i class='bx bxs-slideshow bx-sm'></i>
                                    <span>Cursos</span>
                                </div>
                            </a>
                        </li>
                        <li class="item">
                            <a href="{{ route('visitador.contact.index') }}">
                                <div class="d-flex align-items-center gap-1">
                                    <i class='bx bxs-contact bx-sm'></i>
                                    <span>Contacto</span>
                                </div>
                            </a>
                        </li>
                        <li class="item">
                            <a href="{{ route('visitador.testimonial.index') }}">
                                <div class="d-flex align-items-center gap-1">
                                    <i class='bx bxs-user-pin bx-sm'></i>
                                    <span>Testimoniales</span>
                                </div>
                            </a>
                        </li>
                        <li class="item">
                            <a href="{{ route('visitador.plan.show') }}">
                                <div class="d-flex align-items-center gap-1">
                                    <i class='bx bxl-paypal bx-sm'></i>
                                    <span>Pasos Suscripción</span>
                                </div>
                            </a>
                        </li>
                        <li class="item">
                            <a href="{{ route('login') }}">
                                <div class="d-flex align-items-center gap-1">
                                    <i class='bx bxs-log-in bx-sm'></i>
                                    <span>Ingresar</span>
                                </div>
                            </a>
                        </li>
                        <li class="item">
                            <a href="{{ route('admin.register.index') }}">
                                <div class="d-flex align-items-center gap-1">
                                    <i class='bx bxs-registered bx-sm'></i>
                                    <span>Registrarme</span>
                                </div>
                            </a>
                        </li>
                    @endguest
                </ul>
            </nav>
            <label for="btn-menu"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-x"
                    width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
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
                            width="44" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#1a1f71"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 6l16 0" />
                            <path d="M4 12l16 0" />
                            <path d="M4 18l16 0" />
                        </svg>
                        <p class="escoder-responsive">MENÚ</p>
                    </div>
                </label>

                @guest
                    <div class="caja-img">
                        <a href="{{ route('visitador.home.index') }}">
                            <img src="{{ asset('img/logo/logo.png') }}" alt="">
                        </a>
                    </div>
                @endguest

                @auth
                    <div class="caja-img">
                        <a href="{{ route('visitador.panel') }}">
                            <i class='bx bxs-slideshow' style="font-size: 52px; color: #1a1f71"></i>
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
</div>
