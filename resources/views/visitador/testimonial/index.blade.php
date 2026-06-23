@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection



@section('main')

    <body data-spy="scroll" data-target=".navbar" data-offset="50">
        <div id="mobile-menu-overlay"></div>

        <div class="page-body-wrapper">

            <section class="testimonial section-home" id="testimonial">
                <div class="container">
                    <div class="row  mt-md-0 mt-lg-4">
                        <div class="col-sm-6 text-white" data-aos="fade-up">
                            <p class="font-weight-bold mb-3"><strong>Testimoniales</strong></p>
                            <h3 class="font-weight-medium">Comentarios <br>compatidos</h3>
                            <ul class="flipster-custom-nav">
                                <li class="flipster-custom-nav-item">
                                    <a href="javascript:;" class="flipster-custom-nav-link" title="0"></a>
                                </li>
                                <li class="flipster-custom-nav-item">
                                    <a href="javascript:;" class="flipster-custom-nav-link" title="1"></a>
                                </li>
                                <li class="flipster-custom-nav-item">
                                    <a href="javascript:;" class="flipster-custom-nav-link active" title="2"></a>
                                </li>
                                <li class="flipster-custom-nav-item">
                                    <a href="javascript:;" class="flipster-custom-nav-link" title="3"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6" data-aos="fade-up">
                            <div id="testimonial-flipster">
                                <ul>
                                    <li>
                                        <div class="testimonial-item">
                                            <img src="{{ asset('img/home/testimoniales.png') }}" alt="icon"
                                                class="testimonial-icons">
                                            <p>“La lista de temas son precisos y es muy útil para repasar lo esencial con
                                                los
                                                ejércitos en pdf.”
                                            </p>
                                            <h6 class="testimonial-author">Alonso</h6>
                                            <p class="testimonial-destination">Estudiante</p>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="testimonial-item">
                                            <img src="{{ asset('img/home/testimoniales.png') }}" alt="icon"
                                                class="testimonial-icons">
                                            <p>“Bien condensado, y la inclusión de archivos PDF al final de cada lección
                                                resulta muy útil.”
                                            </p>
                                            <h6 class="testimonial-author">Yerandy</h6>
                                            <p class="testimonial-destination">Estudiante</p>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="testimonial-item">
                                            <img src="{{ asset('img/home/testimoniales.png') }}" alt="icon"
                                                class="testimonial-icons">
                                            <p>“Buen curso sobre todo cada lección final de cada capítulo tiene el material
                                                de preguntas sobre el tema”
                                            </p>
                                            <h6 class="testimonial-author">solomaby</h6>
                                            <p class="testimonial-destination">Estudiante</p>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="testimonial-item">
                                            <img src="{{ asset('img/home/testimoniales.png') }}" alt="icon"
                                                class="testimonial-icons">
                                            <p>“Bien condensado, y la inclusión de archivos PDF al final de cada lección
                                                resulta muy útil.”
                                            </p>
                                            <h6 class="testimonial-author">Darly Rico</h6>
                                            <p class="testimonial-destination">Estudiante</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>


        @include('template.footer')

    </body>
@endsection
