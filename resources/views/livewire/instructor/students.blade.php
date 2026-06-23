<div>
    {{-- Be like water. --}}
    <section>
        <div class="contenedor pt-5">
            <h1 class="lead mt-5">Estudiantes del Curso</h1>
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
                            <h2 class="lead text-white">estudiantes del curso: {{ $course->title }}</h2>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>
                                            <i class='bx bx-edit-alt bx-tada'></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($course->students as $student)
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>
                                                <button wire:click="edit({{ $student->id }})"
                                                    class="mi-boton primario btn-sm"><i
                                                        class='bx bx-edit-alt bx-tada'></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
