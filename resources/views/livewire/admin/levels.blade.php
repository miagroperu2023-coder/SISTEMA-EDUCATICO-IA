<div>
    {{-- Be like water. --}}
    <section>
        <div class="contenedor pt-5">
            <h1 class="lead mt-5">Niveles</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <!-- FORMULARIO PARA CREAR UNA CATEGORIA DEL CURSO -->
                            @if (!$level_id)
                                <form wire:submit.prevent="create">
                                    <div class="form-group my-2">
                                        <label for="">Nombre:</label>
                                        <input wire:model="name" type="text" class="form-control"
                                            placeholder="Ingrese el nombre">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mi-boton azul w-100 mt-2">Crear</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA CREAR UNA CATEGORIA DEL CURSO -->


                            <!-- FORMULARIO PARA EDITAR UNA CATEGORIA DEL CURSO -->
                            @if ($level_id)
                                <form wire:submit.prevent="update">
                                    <div class="form-group my-2">
                                        <label for="">Nivel actual:</label>
                                        <input wire:model="name" type="text" class="form-control"
                                            placeholder="Ingrese el nombre de la meta">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="mi-boton azul w-100 mt-2">Actualizar</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA EDITAR UNA CATEGORIA DEL CURSO -->
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card sombra">
                        <div class="card-header fondo-general">
                            <h2 class="lead text-white">Niveles</h2>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>
                                            <i class='bx bx-edit-alt bx-tada'></i>
                                        </th>
                                        <th>
                                            <i class='bx bx-message-alt-x bx-burst'></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($levels as $level)
                                        <tr>
                                            <td>{{ $level->id }}</td>
                                            <td>{{ $level->name }}</td>
                                            <td>
                                                <button wire:click="edit({{ $level->id }})"
                                                    class="mi-boton azul btn-sm"><i
                                                        class='bx bx-edit-alt bx-tada'></i></button>
                                            </td>
                                            <td>
                                                <button wire:click="delete({{ $level->id }})"
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
