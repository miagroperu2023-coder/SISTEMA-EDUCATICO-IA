<div>
    {{-- Be like water. --}}
    <section>
        <div class="contenedor pt-5">
            <h1 class="lead mt-5">Compendios: </h1>
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <!-- FORMULARIO PARA CREAR UN RECURSO "en este caso un contenido" DEL CURSO -->
                            @if (!$archive_id)
                                <form wire:submit.prevent="create">
                                    <div class="form-group my-2">
                                        <label for="">Curso:</label>
                                        <select class="form-select" wire:model="course_id">
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Nombre del compendio:</label>
                                        <input type="text" wire:model="name" class="form-control"
                                            placeholder="nombre lectura">

                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Imagen del compendio(Url):</label>
                                        <input type="text" wire:model="image" class="form-control"
                                            placeholder="url de la imagen">

                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Cita:</label>
                                        <input type="text" wire:model="cita" class="form-control"
                                            placeholder="cita del documento">

                                        @error('cita')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Url del compendio:</label>
                                        <textarea wire:model="url" class="form-control" placeholder="url"></textarea>

                                        @error('url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Desccription:</label>
                                        <textarea wire:model="description" class="form-control" placeholder="descripción"></textarea>

                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="mi-boton azul w-100 mt-2">Crear</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA CREAR UN RECURSO "en este caso un contenido" DEL CURSO -->


                            <!-- FORMULARIO PARA EDITAR UN RECURSO "en este caso un contenido" DEL CURSO -->
                            @if ($archive_id)
                                <form wire:submit.prevent="update">
                                    <div class="form-group my-2">
                                        <label for="">Curso:</label>
                                        <select class="form-select" wire:model="course_id">
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Nombre del compendio:</label>
                                        <input type="text" wire:model="name" class="form-control"
                                            placeholder="nombre lectura">

                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Imagen del compendio(Url):</label>
                                        <input type="text" wire:model="image" class="form-control"
                                            placeholder="url de la imagen">

                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Cita:</label>
                                        <input type="text" wire:model="cita" class="form-control"
                                            placeholder="cita del documento">

                                        @error('cita')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Url del compendio:</label>
                                        <textarea wire:model="url" class="form-control" placeholder="url"></textarea>

                                        @error('url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Desccription:</label>
                                        <textarea wire:model="description" class="form-control" placeholder="descripción"></textarea>

                                        @error('description')
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
                            <h2 class="lead text-white">Compendios Descargables</h2>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>CURSO</th>
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
                                    @foreach ($archives as $archive)
                                        <tr>
                                            <td>{{ $archive->id }}</td>
                                            <td>{{ $archive->title }}</td>
                                            <td>{{ $archive->name }}</td>
                                            <td>{{ Str::limit($archive->url, 20) }}</td>
                                            <td>
                                                <button wire:click="edit({{ $archive->id }})"
                                                    class="mi-boton azul btn-sm"><i
                                                        class='bx bx-edit-alt bx-tada'></i></button>
                                            </td>
                                            <td>
                                                <button wire:click="delete({{ $archive->id }})"
                                                    class="mi-boton rojo btn-sm"><i
                                                        class='bx bx-message-alt-x bx-burst'></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if ($archives)
                                <div class="d-flex justify-content-center">
                                    {{ $archives->links('vendor.pagination.bootstrap-4') }}
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

