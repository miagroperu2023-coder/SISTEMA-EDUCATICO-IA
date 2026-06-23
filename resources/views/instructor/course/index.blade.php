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
            <h1 class="lead mt-5">Mi lista de Cursos</h1>
            <div class="row">
                <div class="card sombra">
                    <div class="card-header fondo-general">
                        <a class="text-white" href="{{ route('admin.instructor.course.create') }}">Crear Nuevo Curso</a>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>IMAGEN</th>
                                    <th>MATRICULADOS</th>
                                    <th>CALIFICACION</th>
                                    <th>STATUS</th>
                                    <th>EDITAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>{{ $course->id }}</td>
                                        <td>{{ $course->title }}</td>
                                        <td>
                                            {{-- VALIDA SI EXISTE LA VARIABLE CURSO --}}
                                            <figure>
                                                {{-- VALIDA SI EXISTE LA VARIABLE CURSO --}}
                                                @isset($course)
                                                    @if ($course->image)
                                                        <img style="width: 35px;height: 35px;" src="{{ $course->image->url }}"
                                                            class="" alt="...">
                                                    @endif
                                                @else
                                                    <img style="width: 35px;height: 35px;"
                                                        src="https://images.pexels.com/photos/7509366/pexels-photo-7509366.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                                        class="" alt="...">
                                                @endisset
                                            </figure>
                                        </td>
                                        <td>{{ $course->students_count }}</td>
                                        <td class="">
                                            <div class="d-flex align-items-center">
                                                <p>{{ round($course->rating) }}</p>
                                                <ul class="d-flex pt-1">
                                                    <li>
                                                        <i style="color:#da920f"
                                                            class='bx bx-star {{ $course->rating >= 1 ? 'bx bxs-star' : '' }}'></i>
                                                    </li>
                                                    <li>
                                                        <i style="color:#da920f"
                                                            class='bx bx-star {{ $course->rating >= 2 ? 'bx bxs-star' : '' }}'></i>
                                                    </li>
                                                    <li>
                                                        <i style="color:#da920f"
                                                            class='bx bx-star {{ $course->rating >= 3 ? 'bx bxs-star' : '' }}'></i>
                                                    </li>
                                                    <li>
                                                        <i style="color:#da920f"
                                                            class='bx bx-star {{ $course->rating >= 4 ? 'bx bxs-star' : '' }}'></i>
                                                    </li>
                                                    <li>
                                                        <i style="color:#da920f"
                                                            class='bx bx-star {{ $course->rating == 5 ? 'bx bxs-star' : '' }}'></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            @switch($course->status)
                                                @case(1)
                                                    <p>BORRADOR</p>
                                                @break

                                                @case(2)
                                                    <p>REVISION</p>
                                                @break

                                                @default
                                                    <p>PUBLICADO</p>
                                            @endswitch
                                        </td>
                                        <td>
                                            <a class="mi-boton azul"
                                                href="{{ route('admin.instructor.course.edit', ['course' => $course]) }}">editar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
