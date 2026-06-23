<div>
    {{-- Be like water. --}}
    <section>
        <div class="contenedor pt-5">
            <h1 class="lead mt-5">Contenidos: </h1>
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <!-- FORMULARIO PARA CREAR UN RECURSO "en este caso un contenido" DEL CURSO -->
                            @if (!$resource_id)
                                <form wire:submit.prevent="create">
                                    <div class="form-group my-2">
                                        <label for="resourceable_id">Seccion</label>
                                        <select wire:model="resourceable_id" class="form-select">
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Contenido:</label>
                                        <textarea wire:model="url" style="width: 100%; height: 350px !important;" class="form-control" id="description"></textarea>

                                        @error('url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mi-boton azul w-100 mt-2">Crear</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA CREAR UN RECURSO "en este caso un contenido" DEL CURSO -->


                            <!-- FORMULARIO PARA EDITAR UN RECURSO "en este caso un contenido" DEL CURSO -->
                            @if ($resource_id)
                                <form wire:submit.prevent="update">
                                    <div class="form-group my-2">
                                        <label for="resourceable_id">Seccion</label>
                                        <select wire:model="resourceable_id" class="form-select">
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Contenido:</label>
                                        <textarea wire:model="url" style="width: 100%; height: 350px !important;" class="form-control" id="description"></textarea>

                                        @error('url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mi-boton azul w-100 mt-2">Actualizar</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA EDITAR UN RECURSO "en este caso un contenido" DEL CURSO -->

                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card sombra">
                        <div class="card-header fondo-general">
                            <h2 class="lead text-white">Contenido y Lecturas</h2>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>CONTENIDO</th>
                                        <th>
                                            <i class='bx bx-edit-alt bx-tada'></i>
                                        </th>
                                        <th>
                                            <i class='bx bx-message-alt-x bx-burst'></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resources as $resource)
                                        <tr>
                                            <td>{{ $resource->id }}</td>
                                            <td>{{ $resource->resourceable_type }}</td>
                                            <td>{{ Str::limit($resource->url, 20) }}</td>
                                            <td>
                                                <button wire:click="edit({{ $resource->id }})"
                                                    class="mi-boton azul btn-sm"><i
                                                        class='bx bx-edit-alt bx-tada'></i></button>
                                            </td>
                                            <td>
                                                <button wire:click="delete({{ $resource->id }})"
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
