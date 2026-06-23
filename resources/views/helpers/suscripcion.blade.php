 <section class="our-services section-home" id="plans">
     <div class="container">
         <div class="row">
             <div class="col-sm-12">
                 <h5 class="text-dark font-weight-bold">cursos, exámenes y material educativo las 24 horas del día</h5>
                 <h3 class="font-weight mb-5 color-general">Nuestros Planes</h3>
             </div>
         </div>
         <div class="row" data-aos="fade-up">
             {{-- PLAN MENSUAL --}}
             <div class="col-sm-4">
                 <div class="pricing-box selected" id="curso-show">
                     {{--
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     --}}
                     <img src="https://cdn-icons-png.flaticon.com/512/10017/10017625.png"
                         style="width: 80px;height: 80px;" alt="starter">
                     <h6 class="font-weight-medium title-text text-white">Plan Mensual</h6>
                     <h1 class="text-amount mb-4 mt-2 text-white">
                         S/<strong> {{ env('PLAN_MENSUAL') }} </strong><small
                             style="font-size: 0.6em; vertical-align: super;"></small>
                     </h1>

                     <ul class="pricing-list">
                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-book-open'></i>
                                 <span>Ruta académica estructurada en 16 cursos clave</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-layer'></i>
                                 <span>Lecciones organizadas por temas para avanzar paso a paso</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-file'></i>
                                 <span>Material teórico y ejercicios de refuerzo por cada tema</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-edit-alt'></i>
                                 <span>Evaluaciones prácticas para fortalecer cada aprendizaje</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-task'></i>
                                 <span>Simulacros personalizados según tu ritmo de estudio</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-brain'></i>
                                 <strong><span>Refuerzo inteligente con IA tras cada evaluación</span></strong>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-bot'></i>
                                 <strong><span>Asistente académico disponible para resolver dudas</span></strong>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-chip'></i>
                                 <strong><span>Contenido educativo generado con IA para reforzar
                                         conocimientos</span></strong>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-line-chart'></i>
                                 <span>Seguimiento continuo de progreso académico</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-calendar-check'></i>
                                 <strong><span>1 mes de acompañamiento educativo completo</span></strong>
                             </div>
                         </li>
                     </ul>

                     @auth
                         @canany(['viewSubscription', 'viewSubscriptionSixMonth', 'viewSubscriptionYear'], auth()->user())
                             <i class='bx bx-star bx-tada mt-3' style="font-size: 38px;color: #ffffff"></i>
                         @else
                             <form action="{{ route('mercadopago.suscription.index') }}" id="form-suscription" method="POST">
                                 @csrf
                                 <input type="submit" class="btn-solid-sm p-4 text-center mt-3 w-100"
                                     value="Quiero estudiar ya">
                             </form>
                         @endcanany
                     @endauth

                     @guest
                         <a href="{{ route('admin.register.index') }}"
                             class="btn-solid-sm p-4 text-center mt-3 w-100">Impulsar mi aprendizaje</a>
                     @endguest
                 </div>
             </div>


             {{-- PLAN SEIS MESES --}}
             <div class="col-sm-4">
                 <div class="pricing-box selected" id="curso-show">
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <img src="https://cdn-icons-png.flaticon.com/512/1921/1921604.png"
                         style="width: 80px;height: 80px;" alt="starter">
                     <span class="ahorro-suscripcion">
                         💰 Ahorra S/ 30
                     </span>
                     <h6 class="font-weight-medium title-text text-white">Plan Semestral</h6>
                     <h1 class="text-amount mb-4 mt-2 text-white">
                         S/<strong> {{ env('PLAN_SEIS_MES') }} </strong><small
                             style="font-size: 0.6em; vertical-align: super;"></small>
                     </h1>

                     <ul class="pricing-list">
                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-book-open'></i>
                                 <span>Ruta académica estructurada en 16 cursos clave</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-layer'></i>
                                 <span>Lecciones organizadas por temas para avanzar paso a paso</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-file'></i>
                                 <span>Material teórico y ejercicios de refuerzo por cada tema</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-edit-alt'></i>
                                 <span>Evaluaciones prácticas para fortalecer cada aprendizaje</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-task'></i>
                                 <span>Simulacros personalizados según tu ritmo de estudio</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-brain'></i>
                                 <strong><span>Refuerzo inteligente con IA tras cada evaluación</span></strong>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-bot'></i>
                                 <strong><span>Asistente académico disponible para resolver dudas</span></strong>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-chip'></i>
                                 <strong><span>Contenido educativo generado con IA para reforzar
                                         conocimientos</span></strong>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-line-chart'></i>
                                 <span>Seguimiento continuo de progreso académico</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-calendar-check'></i>
                                 <strong><span>6 meses de acompañamiento educativo completo</span></strong>
                             </div>
                         </li>
                     </ul>

                     @auth
                         @canany(['viewSubscription', 'viewSubscriptionSixMonth', 'viewSubscriptionYear'], auth()->user())
                             <i class='bx bx-star bx-tada mt-3' style="font-size: 38px; color: #ffffff"></i>
                         @else
                             <form action="{{ route('mercadopago.suscription.six.index') }}" id="form-suscription-seis-meses"
                                 method="POST">
                                 @csrf
                                 <input type="submit" class="btn-solid-sm p-4 text-center mt-3 w-100"
                                     value="Quiero estudiar ya">
                             </form>
                         @endcanany
                     @endauth


                     @guest
                         <a href="{{ route('admin.register.index') }}"
                             class="btn-solid-sm p-4 text-center mt-3 w-100">Impulsar mi aprendizaje</a>
                     @endguest
                 </div>
             </div>

             {{-- PLAN 12 MESES --}}
             <div class="col-sm-4">
                 <div class="pricing-box selected" id="curso-show">
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <div class="cube"></div>
                     <img src="https://cdn-icons-png.flaticon.com/512/6807/6807175.png"
                         style="width: 80px;height: 80px;" alt="starter">
                     <span class="ahorro-suscripcion">
                         💰 Ahorra S/ 60
                     </span>
                     <h6 class="font-weight-medium title-text text-white">Plan Anual</h6>
                     <h1 class="text-amount mb-4 mt-2 text-white">
                         S/<strong> {{ env('PLAN_ANUAL') }} </strong><small
                             style="font-size: 0.6em; vertical-align: super;"></small>
                     </h1>

                     <ul class="pricing-list">
                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-book-open'></i>
                                 <span>Ruta académica estructurada en 16 cursos clave</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-layer'></i>
                                 <span>Lecciones organizadas por temas para avanzar paso a paso</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-file'></i>
                                 <span>Material teórico y ejercicios de refuerzo por cada tema</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-edit-alt'></i>
                                 <span>Evaluaciones prácticas para fortalecer cada aprendizaje</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-task'></i>
                                 <span>Simulacros personalizados según tu ritmo de estudio</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-brain'></i>
                                 <strong><span>Refuerzo inteligente con IA tras cada evaluación</span></strong>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-bot'></i>
                                 <strong><span>Asistente académico disponible para resolver dudas</span></strong>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-chip'></i>
                                 <strong><span>Contenido educativo generado con IA para reforzar
                                         conocimientos</span></strong>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-line-chart'></i>
                                 <span>Seguimiento continuo de progreso académico</span>
                             </div>
                         </li>

                         <li class="text-white">
                             <div class="d-flex">
                                 <i class='bx bx-calendar-check'></i>
                                 <strong><span>12 meses de acompañamiento educativo completo</span></strong>
                             </div>
                         </li>
                     </ul>

                     @auth
                         @canany(['viewSubscription', 'viewSubscriptionSixMonth', 'viewSubscriptionYear'], auth()->user())
                             <i class='bx bx-star bx-tada mt-3' style="font-size: 38px; color: #ffffff"></i>
                         @else
                             <form action="{{ route('mercadopago.suscription.year.index') }}" id="form-suscription-doce-meses"
                                 method="POST">
                                 @csrf
                                 <input type="submit" class="btn-solid-sm p-4 text-center mt-3 w-100"
                                     value="Quiero estudiar ya">
                             </form>
                         @endcanany
                     @endauth


                     @guest
                         <a href="{{ route('admin.register.index') }}"
                             class="btn-solid-sm p-4 text-center mt-3 w-100">Impulsar mi aprendizaje</a>
                     @endguest
                 </div>
             </div>
         </div>
     </div>
 </section>
