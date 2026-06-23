<div>
    {{-- Be like water. --}}
    <section>
        <div class="contenedor pt-5">
            <h1 class="lead mt-5">Requerimientos del Curso</h1>
            <div class="row">
                <div class="col-md-4">
                    {{-- LLAMADA DEL COMPONENTE ASIDE --}}
                    @component('components.instructor.aside')
                        {{-- Puedes pasar datos al componente si es necesario --}}
                        @slot('course', $course)
                    @endcomponent

                    <div class="card mt-3">
                        <div class="card-body">
                            <!-- FORMULARIO PARA CREAR UNA META DEL CURSO -->
                            @if (!$requirement_id)
                                <form wire:submit.prevent="create">
                                    <div class="form-group my-2">
                                        <label for="">Agregar nuevo requerimiento:</label>
                                        <input wire:model="name" type="text" class="form-control"
                                            placeholder="Ingrese el nombre del requerimiento">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mi-boton azul w-100 mt-2">Crear</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA CREAR UNA META DEL CURSO -->


                            <!-- FORMULARIO PARA EDITAR UNA META DEL CURSO -->
                            @if ($requirement_id)
                                <form wire:submit.prevent="update">
                                    <div class="form-group my-2">
                                        <label for="">Requerimiento actual:</label>
                                        <input wire:model="name" type="text" class="form-control"
                                            placeholder="Ingrese el nombre de la meta">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit"
                                        class="mi-boton azul w-100 mt-2">Actualizar</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA EDITAR UNA META DEL CURSO -->
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card sombra">
                        <div class="card-header fondo-general">
                            <h2 class="lead text-white">Requerimientos del curso: {{ $course->title }}</h2>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>REQUERIMIENTO</th>
                                        <th>
                                            <i class='bx bx-edit-alt bx-tada'></i>
                                        </th>
                                        <th>
                                            <i class='bx bx-message-alt-x bx-burst'></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($course->requirements as $requirement)
                                        <tr>
                                            <td>{{ $requirement->id }}</td>
                                            <td>{{ $requirement->name }}</td>
                                            <td>
                                                <button wire:click="edit({{ $requirement->id }})"
                                                    class="mi-boton azul btn-sm"><i
                                                        class='bx bx-edit-alt bx-tada'></i></button>
                                            </td>
                                            <td>
                                                <button wire:click="delete({{ $requirement->id }})"
                                                    class="mi-boton rojo btn-sm"><i
                                                        class='bx bx-message-alt-x bx-burst'></i></button>
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
