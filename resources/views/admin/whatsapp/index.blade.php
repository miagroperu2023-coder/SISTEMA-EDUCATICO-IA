@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('main')
    <section class="mt-4" id="contenido-bloques">
        <div class="contenedor">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h2>📲 Enviar Pregunta Médica por WhatsApp</h2>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('admin.whatsapp.send') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Número de WhatsApp (con +51...)</label>
                            <input type="text" name="telefono" class="form-control" placeholder="+51999999999" required>
                        </div>

                        <div class="mb-3">
                            <label for="pregunta" class="form-label">Pregunta Médica</label>
                            <textarea name="pregunta" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="respuesta" class="form-label">Respuesta</label>
                            <textarea name="respuesta" class="form-control" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">📤 Enviar por WhatsApp</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('template.footer')
@endsection
