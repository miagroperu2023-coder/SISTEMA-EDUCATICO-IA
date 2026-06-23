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
            <h1 class="lead mt-5">lista de Usuarios</h1>
            <div class="row">
                <div class="card sombra">
                    <div class="card-header fondo-general">
                        <a class="text-white" href="">nuevo enlace</a>
                    </div>
                    <div class="card-body">
                        @if (session('exito'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong>Mensaje!</strong> {{ session('exito') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>EMAIL</th>
                                        <th>GOOGLE</th>
                                        <th>INSCRITO</th>
                                        <th>EDITAR</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->google_id }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a class="mi-boton azul"
                                                    href="{{ route('admin.users.edit', ['user' => $user]) }}">edit</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>Sin Usuarios por ahora</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
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
