<div>
    {{-- Be like water. --}}
    <section>
        <div class="contenedor pt-5">
            <h1 class="lead mt-5">Lecciones del Curso</h1>
            <div class="row">
                <div class="col-md-4">
                    {{-- LLAMADA DEL COMPONENTE ASIDE --}}
                    @component('components.instructor.aside')
                        {{-- Puedes pasar datos al componente si es necesario --}}
                        @slot('course', $course)
                    @endcomponent

                    <div class="card mt-3">
                        <div class="card-body">
                            <!-- FORMULARIO PARA CREAR UNA LECCION -->
                            @if (!$lesson_id)
                                <form wire:submit.prevent="create">
                                    <div class="form-group my-2">
                                        <label for="">Nombre:</label>
                                        <input wire:model="name" class="form-control" placeholder="nombre de la leccion"
                                            type="text" />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">URL:</label>
                                        <input wire:model="url" class="form-control" placeholder="url" type="text" />
                                        @error('url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Plataforma</label>
                                        <select wire:model="platform_id" class="form-select">
                                            @foreach ($platforms as $platform)
                                                <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="">Seccion</label>
                                        <select wire:model="section_id" class="form-select">
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-outline-primary mt-2 w-100">Guardar</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA CREAR UNA LECCION -->


                            <!-- FORMULARIO PARA EDITAR UNA LECCION -->
                            @if ($lesson_id)
                                <form wire:submit.prevent="update">
                                    <div class="form-group my-2">
                                        <label for="name">Nombre:</label>
                                        <input wire:model="name" class="form-control" placeholder="nombre de la leccion"
                                            type="text" />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="url">URL:</label>
                                        <input wire:model="url" class="form-control" placeholder="url" type="text" />
                                        @error('url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="platform_id">Plataforma</label>
                                        <select wire:model="platform_id" class="form-select">
                                            @foreach ($platforms as $platform)
                                                <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group my-2">
                                        <label for="section_id">Seccion</label>
                                        <select wire:model="section_id" class="form-select">
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit"
                                        class="btn btn-outline-primary mt-2 w-100">Actualizar</button>
                                </form>
                            @endif
                            <!-- FORMULARIO PARA EDITAR UNA LECCION -->
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header fondo-general">
                            <h2 class="lead text-white">Lecciones del curso: {{ $course->title }}</h2>
                        </div>
                        <div class="card-body">
                            {{-- INPRIMIENDO LAS SECCIONES DE LOS CURSOS --}}
                            <section>
                                @foreach ($course->sections as $section)
                                    <div class="card sombra mt-2">
                                        <div class="card-body">
                                            {{-- PARA QUE EL PRIMER SECTION ESTE ABIERTO --}}
                                            <article
                                                @if ($loop->first) x-data="{ open: true }"
                                               wire: @else x-data="{ open: false }" @endif>

                                                <header class="link-primary" x-on:click="open= !open">
                                                    <h4 class="cursor-show"> <i class="bx bx-chevron-down bx-flip-"></i>
                                                        {{ $section->name }}</h4>
                                                </header>

                                                {{-- INPRIMIENDO LAS LECCIONES DE DE CADA SECCION --}}
                                                <div class="bg-white pt-2 px-4" x-show="open">
                                                    <ul>
                                                        @foreach ($section->lessons as $lesson)
                                                            <li class="d-flex justify-content-between my-1">

                                                                <div class="d-flex">
                                                                    <i class='bx bx-circle'
                                                                        style='color:rgb(52, 152, 219) ; font-size: 22px'></i>
                                                                    <p> {{ $lesson->name }}</p>
                                                                </div>

                                                                <div>
                                                                    <button wire:click="edit({{ $lesson->id }})"
                                                                        class="mi-boton azul btn-sm"> <i
                                                                            class='bx bx-edit-alt bx-tada'></i></button>
                                                                    <button wire:click="delete({{ $lesson->id }})"
                                                                        class="mi-boton rojo btn-sm"><i
                                                                            class='bx bx-message-alt-x bx-burst'></i></button>
                                                                </div>
                                                            </li>

                                                            <div>
                                                                {{-- COMPONENTE LIVEWIRE DE LA DESCRIPCION DE CADA LECCION --}}
                                                                @livewire('instructor.descriptions', ['lesson' => $lesson], key('instructor.descriptions.' . $lesson->id))
                                                                {{-- COMPONENTE LIVEWIRE DE LA DESCRIPCION DE CADA LECCION --}}
                                                            </div>

                                                            <div>
                                                                {{-- COMPONENTE LIVEWIRE RECURSOS DE UNA LECCION --}}
                                                                @livewire('instructor.resources', ['lesson' => $lesson], key('instructor.resources.' . $lesson->id))
                                                                {{-- COMPONENTE LIVEWIRE RECURSOS DE UNA LECCION --}}
                                                            </div>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                {{-- INPRIMIENDO LAS LECCIONES DE DE CADA SECCION --}}
                                            </article>
                                            {{-- PARA QUE EL PRIMER SECTION ESTE ABIERTO --}}
                                        </div>
                                    </div>
                                @endforeach
                            </section>
                            {{-- INPRIMIENDO LAS SECCIONES DE LOS CURSOS --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
