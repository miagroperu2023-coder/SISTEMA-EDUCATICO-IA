@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection



@section('main')

    <body data-spy="scroll" data-target=".navbar" data-offset="50">
        <div id="mobile-menu-overlay"></div>

        <div class="page-body-wrapper">

            <section class="contactus section-home" id="contact">
                <div class="container">
                    <div class="row mb-5 pb-5">
                        <div class="col-sm-5" data-aos="fade-up" data-aos-offset="-500">
                            <img src="{{ asset('img/home/contact.jpg') }}" alt="contact" class="img-fluid">
                        </div>
                        <div class="col-sm-7" data-aos="fade-up" data-aos-offset="-500">
                            <h3 class="font-weight-medium text-dark mt-5 mt-lg-0">¿Alguna Sugerencia?</h3>
                            <h5 class="text-dark mb-5">Envíanos tus sugerencias en el siguiente formulario</h5>
                            <form>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" placeholder="Nombre*">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="mail" placeholder="Gmail*">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea name="message" id="message" class="form-control" placeholder="Mensaje*" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button disabled class="btn-solid-sm">Enviar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>


        @include('template.footer')

    </body>
@endsection
