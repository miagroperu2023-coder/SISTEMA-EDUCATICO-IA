<div>
    {{-- Be like water. --}}
    <section>
        <div class="contenedor pt-5">
            <h1 class="lead mt-5">Metas del Curso</h1>
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
                            @if (!$goal_id)
                                <form wire:submit.prevent="create">
                                    <div class="form-group my-2">
                                        <label for="">Agregar nueva meta:</label>
                                        <input wire:model="name" type="text" class="form-control"
                                            placeholder="Ingrese el nombre de la meta">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mi-boton azul w-100 mt-2">Crear</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA CREAR UNA META DEL CURSO -->


                            <!-- FORMULARIO PARA EDITAR UNA META DEL CURSO -->
                            @if ($goal_id)
                                <form wire:submit.prevent="update">
                                    <div class="form-group my-2">
                                        <label for="">Meta actual:</label>
                                        <input wire:model="name" type="text" class="form-control"
                                            placeholder="Ingrese el nombre de la meta">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mi-boton azul w-100 mt-2">Actualizar</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA EDITAR UNA META DEL CURSO -->
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card sombra">
                        <div class="card-header fondo-general">
                            <h2 class="lead text-white">metas del curso: {{ $course->title }}</h2>
                        </div>

                        <div class="table-responsive">
                            <div class="card-body table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>META</th>
                                            <th>
                                                <i class='bx bx-edit-alt bx-tada'></i>
                                            </th>
                                            <th>
                                                <i class='bx bx-message-alt-x bx-burst'></i>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($course->goals as $goal)
                                            <tr>
                                                <td>{{ $goal->id }}</td>
                                                <td>{{ $goal->name }}</td>
                                                <td>
                                                    <button wire:click="edit({{ $goal->id }})"
                                                        class="mi-boton azul btn-sm"><i
                                                            class='bx bx-edit-alt bx-tada'></i></button>
                                                </td>
                                                <td>
                                                    <button wire:click="delete({{ $goal->id }})"
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
        </div>
    </section>
</div>
