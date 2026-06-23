<div>
    {{-- Be like water. --}}
    <section>
        <div class="contenedor pt-5">
            <h1 class="lead mt-5">Temas de los Exámenes</h1>
            <div class="row">
                <div class="col-md-4">

                    <div class="card mt-3">
                        <div class="card-body">
                            <!-- FORMULARIO PARA CREAR UN NUEVO TEMA-->
                            @if (!$topic_id)
                                <form wire:submit.prevent="create">
                                    <div class="form-group my-2">
                                        <label for="">Tema del Examen:</label>
                                        <input wire:model="nombre" type="text" class="form-control"
                                            placeholder="Circunferencia">
                                        @error('nombre')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mi-boton azul w-100 mt-2">Crear</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA CREAR UN NUEVO TEMA-->


                            <!-- FORMULARIO PARA EDITAR UN NUEVO TEMA-->
                            @if ($topic_id)
                                <form wire:submit.prevent="update">
                                    <div class="form-group my-2">
                                        <label for="">Tema actual:</label>
                                        <input wire:model="nombre" type="text" class="form-control"
                                            placeholder="Ingrese el nombre de la meta">
                                        @error('nombre')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mi-boton azul w-100 mt-2">Actualizar</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA EDITAR UN NUEVO TEMA-->
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card sombra">
                        <div class="card-header fondo-general">
                            <h2 class="lead text-white">Lista de Temas</h2>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tema</th>
                                        <th>Estado</th>
                                        <th>
                                            <i class='bx bx-edit-alt bx-tada'></i>
                                        </th>
                                        <th>
                                            <i class='bx bx-message-alt-x bx-burst'></i>
                                        </th>
                                        <th>
                                            <i class='bx bxs-folder-minus'></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topics as $topic)
                                        <tr>
                                            <td>{{ $topic->id }}</td>
                                            <td>{{ $topic->nombre }}</td>
                                            <td>{{ $topic->estado }}</td>
                                            <td>
                                                <button wire:click="edit({{ $topic->id }})"
                                                    class="mi-boton azul btn-sm"><i
                                                        class='bx bx-edit-alt bx-tada'></i></button>
                                            </td>
                                            <td>
                                                <button wire:click="delete({{ $topic->id }})"
                                                    class="mi-boton rojo btn-sm"><i
                                                        class='bx bx-message-alt-x bx-burst'></i></button>
                                            </td>

                                            <td>
                                                <button wire:click="inactivar({{ $topic->id }})"
                                                    class="mi-boton amarillo btn-sm">culminar Tema</button>
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
