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
            <h1 class="lead mt-5">lista de pagos por atender</h1>
            <div class="row">
                <div class="card">
                    <div class="card-header fondo-general">
                        <a class="text-white" href="#">#</a>
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
                                        <th>USUARIO</th>
                                        <th>PAGO</th>
                                        <th>ASIGNAR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pays as $pay)
                                        <tr>
                                            <td>{{ $pay->id }}</td>
                                            <td>{{ $pay->name }}</td>
                                            <td>{{ $pay->payment_id }}</td>
                                            <td>
                                                <a href="">Asignar</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>sin datos</td>
                                            <td>sin datos</td>
                                            <td>sin datos</td>
                                            <td>
                                                <a href="">sin datos</a>
                                            </td>
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
