@extends('layouts.app')

@section('bosstrap.css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endsection

@section('navegador')
    @include('template.nav-admin')
@endsection




@section('main')
    <section id="" class="">
        <div class="container pt-5">
            <h1 class="lead mt-5">Nuevo Permiso</h1>
            <div class="row">
                <div class="card">
                    <div class="card-header fondo-general">
                        <a class="text-white" href="{{ route('admin.roles.index') }}">Lista de Permisos</a>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.permissions.store']) !!}

                        @include('admin.role.partials.form')

                        {!! Form::submit('Crear Permisos', ['class' => 'btn btn-success mt-2']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@section('bosstrap.js')
    <!-- CDN JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
@endsection
