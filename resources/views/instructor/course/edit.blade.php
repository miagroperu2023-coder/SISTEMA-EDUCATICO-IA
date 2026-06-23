@extends('layouts.app')

@section('bosstrap.css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection

@section('navegador')
    @include('template.nav-instructor')
@endsection




@section('main')
    <section>
        <div class="contenedor pt-5">
            <h1 class="lead mt-5">Edición del Curso</h1>
            <div class="row">
                <div class="col-md-4">
                    {{-- LLAMADA DEL COMPONENTE ASIDE --}}
                    @component('components.instructor.aside')
                        {{-- Puedes pasar datos al componente si es necesario --}}
                        @slot('course', $course)
                    @endcomponent
                </div>

                <div class="col-md-8">
                    <div class="card sombra">
                        <div class="card-header fondo-general">
                            <h2 class="lead text-white">información del curso</h2>
                        </div>
                        <div class="card-body">
                            {!! Form::model($course, [
                                'route' => ['admin.instructor.course.update', $course],
                                'method' => 'put',
                                'files' => true,
                            ]) !!}

                            @include('instructor.course.partials.form')

                            <div class="mt-2">
                                {!! Form::submit('Actualizar Información', ['class' => 'mi-boton azul w-100']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script src="{{ asset('js/instructor/ckeditor.js') }}"></script>

    @section('bosstrap.js')
        <!-- CDN JS BOOTSTRAP -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
    @endsection
@endsection
