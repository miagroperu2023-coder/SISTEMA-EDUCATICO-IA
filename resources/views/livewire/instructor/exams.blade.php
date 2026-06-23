<div>
    {{-- Be like water. --}}
    <section>
        <div class="contenedor pt-5">
            <h1 class="lead mt-5">Exámenes</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mt-3">
                        <div class="card-body">
                            <!-- FORMULARIO PARA CREAR UN EXAMEN -->
                            @if (!$exam_id)
                                <form wire:submit.prevent="create">
                                    <div class="form-group my-2">
                                        <label for="">Nombre de la prueba a crear:</label>
                                        <input wire:model="nombre" type="text" class="form-control"
                                            placeholder="Geometría-T0001">
                                        @error('nombre')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">curso:</label>
                                        <select wire:model="course_id" class="form-select" id="course_id">
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->title }} - materia</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">duración:</label>
                                        <select wire:model="duracion" class="form-select" id="duracion">
                                            @for ($i = 10; $i <= 90; $i = $i + 10)
                                                <option value="{{ $i }}">{{ $i }} minutos</option>
                                            @endfor
                                        </select>
                                    </div>


                                    {{-- <div class="form-group my-2">
                                        <label for="">publicación:</label>
                                        <input wire:model="publicacion" type="datetime-local" class="form-control">
                                        @error('publicacion')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
                                    <button type="submit" class="mi-boton azul w-100 mt-2">Crear</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA CREAR UN EXAMEN -->


                            <!-- FORMULARIO PARA EDITAR UN EXAMEN -->
                            @if ($exam_id)
                                <form wire:submit.prevent="update">
                                    <div class="form-group my-2">
                                        <label for="">Materia o curso:</label>
                                        <input wire:model="nombre" type="text" class="form-control"
                                            placeholder="Geometría plana">
                                        @error('nombre')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="duracion">duración:</label>
                                        <select wire:model="duracion" class="form-select" id="duracion">
                                            @for ($i = 10; $i <= 90; $i = $i + 10)
                                                <option value="{{ $i }}">{{ $i }} minutos</option>
                                            @endfor
                                        </select>
                                    </div>

                                    {{-- <div class="form-group my-2">
                                        <label for="publicacion">publicación:</label>
                                        <input wire:model="publicacion" type="datetime-local" class="form-control">
                                        @error('publicacion')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
                                    <button type="submit" class="mi-boton azul w-100 mt-2">Actualizar</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA EDITAR UN EXAMEN -->
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card sombra">
                        <div class="card-header fondo-general">
                            <h2 class="lead text-white">Examen</h2>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>nombre</th>
                                        <th>duración</th>
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
                                    @foreach ($exams as $exam)
                                        <tr>
                                            <td>{{ $exam->id }}</td>
                                            <td>{{ $exam->nombre }}</td>
                                            <td>{{ $exam->duracion }}</td>
                                            <td>
                                                <button wire:click="edit({{ $exam->id }})"
                                                    class="mi-boton azul btn-sm"><i
                                                        class='bx bx-edit-alt bx-tada'></i></button>
                                            </td>
                                            <td>
                                                <button wire:click="delete({{ $exam->id }})"
                                                    class="mi-boton rojo btn-sm"><i
                                                        class='bx bx-message-alt-x bx-burst'></i></button>
                                            </td>

                                            <td>
                                                <button wire:click="activar({{ $exam->id }})"
                                                    class="mi-boton verde btn-sm">Publicar</button>
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

    <script>
        document.addEventListener('livewire:load', function() {
            let table = $('#datatable').DataTable();

            Livewire.hook('message.processed', (message, component) => {
                table.destroy();
                table = $('#myTable').DataTable();
            });
        });
    </script>
</div>
