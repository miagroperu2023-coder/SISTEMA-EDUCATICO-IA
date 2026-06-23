@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('main')
    <section class="mt-4" id="contenido-bloques">
        <div class="contenedor">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <div class="card mb-4 animate__animated animate__bounceIn">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="card-body text-secondary">
                                    <h3 class="mb-3 text-dark lead text-center">Resuelve tus dudas al instante con nuestra IA
                                        🤖✨</h3>


                                    <div id="chat-container">
                                        <!--DIALOGOS DEL CHAT-->
                                        <div id="chat-log"></div>
                                        <!--DIALOGOS DEL CHAT-->

                                        <!--FORMULARIO DE PREGUNTAS-->
                                        <form action="{{ route('visitador.bot.conversation') }}" id="chat-form"
                                            method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="message" class="form-control" id="message"
                                                    placeholder="Escriba tu pregunta aquí..." required>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">Enviar</button>
                                        </form>
                                        <!--FORMULARIO DE PREGUNTAS-->
                                    </div>


                                </div>
                            </div>


                        </div>
                    </div>
                    {{--  @livewire('chat-bot') --}}
                </div>
            </div>
        </div>
    </section>

    @include('template.footer')
@endsection
