<div class="mi-card">
    <div class="mi-card-content">

        <form wire:submit.prevent="saveQuestion">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group my-2">
                        <label for="exam_id">Nombre del Simulacro:</label>
                        <input type="text" wire:model="nameSimulacrum" class="form-control"
                            placeholder="Escriba el nombre de su simulacro por ejemplo: SIMULACRO 1">
                        @error('nameSimulacrum')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Cursos:</label>
                        <select wire:model='course_id' wire:change='filterCourseBySection' class="form-control">
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="section_id">Secciones del curso seleccionado:</label>
                        @if ($course_id)
                            <select wire:model='section_id' class="form-control" id="section_id">
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <select class="form-control" id="section_id">
                                <option value="" disabled selected>
                                    SELECCIONE SECCION
                                </option>
                            </select>
                        @endif

                        @error('section_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cantidad_pregunta">Escoja la cantidad de Preguntas por Tema:</label>
                        <select class="form-control" wire:model="cantidad_pregunta" id="cantidad_pregunta">
                            <option value="">-- Seleccione cantidad --</option>
                            @for ($i = 1; $i <= $count; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>

                        @error('cantidad_pregunta')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="duracion">Escoja la duración del Simulacro:</label>
                        <select class="form-control" wire:model='duracion' id="duracion">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                            <option value="50">50</option>
                            <option value="60">60</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <button type="button" class="btn btn-outline-primary mt-3 w-100" wire:click="addAnswer">Agregar
                        Preguntas</button>
                </div>

                <div class="col-md-6">
                    <button class="btn btn-primary mt-3 w-100" type="submit">Crear
                        Simulacro</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-12 pb-3">
        <div class="card sombra">
            <div class="card-header fondo-general">
                <h2 class="lead text-white">Lista de Preguntas para tu Simulacro</h2>
            </div>
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Curso</th>
                            <th>Preguntas</th>
                            <th>Sección</th>
                            <th>
                                <i class='bx bx-message-alt-x bx-burst'></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->simulacrum_questions as $block)
                            <tr>
                                <td> {{ $block['curso'] }} </td>
                                <td> {{ $block['cantidad_preguntas'] }} </td>
                                <td> {{ $block['section_name'] }} </td>
                                <td>
                                    <button wire:click="deleteSimulacrum({{ $block['section_id'] }})"
                                        class="mi-boton rojo btn-sm"><i
                                            class='bx bx-message-alt-x bx-burst'></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
