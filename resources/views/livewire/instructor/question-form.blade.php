<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="contenedor pt-5">
        <h1 class="mt-5 text-center">Creación de Preguntas</h1>


        <div class="d-flex justify-content-between mb-3">
            <div>
                {{-- null: es que no hay tema con estado activo --}}
                @if ($this->section_id != null)
                    <a class="mi-boton rojo"
                        wire:click="deleteExamen({{ $this->section_id }},{{ $this->exam_id }})">Eliminar
                        Examen</a>
                @else
                    <p>id topic {{ $this->section_id }}</p>
                @endif
            </div>

            <div>
                {{-- null: es que no hay examen con estado pendiente --}}
                @if ($this->exam_id != null)
                    <a class="mi-boton verde"
                        wire:click="publishExam({{ $this->section_id }},{{ $this->exam_id }})">Publicar
                        Examen</a>
                @else
                    <p>id examen {{ $this->exam_id }}</p>
                @endif
            </div>
        </div>
        <div class="row">
            <form wire:submit.prevent="saveQuestion">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group my-2">
                                            <label for="exam_id">Exámen:</label>
                                            <select wire:model="exam_id" class="form-select" id="exam_id">
                                                @foreach ($exams as $exam)
                                                    <option value="{{ $exam->id }}">{{ $exam->nombre }}</option>
                                                @endforeach
                                            </select>
                                            @error('exam_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group my-2">
                                            <label for="dificultad">Dificultad:</label>
                                            <select wire:model="dificultad" class="form-select" id="dificultad">
                                                @foreach (['facil', 'intermedio', 'dificil'] as $nivel)
                                                    <option value="{{ $nivel }}">{{ ucfirst($nivel) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group my-2">
                                            <label for="puntos">Puntos:</label>
                                            <select wire:model="puntos" class="form-select" id="puntos">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">cursos</label>
                                            <select wire:model='course_id' wire:change='filterCourseBySection'
                                                class="form-control">
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
                                                <select wire:model="section_id" class="form-select" id="section_id">
                                                    <option value="" disabled selected>SELECCIONE</option>
                                                    @foreach ($sections as $section)
                                                        <option value="{{ $section->id }}">{{ $section->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <select class="form-select" id="section_id">
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
                                </div>

                                <div wire:ignore>
                                    <label for="titulo">Titulo de la pregunta:</label>
                                    <textarea wire:model="titulo" id="description" cols="30" rows="5"></textarea>
                                    @error('titulo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Posibles Respuestas:</label>
                                    @foreach ($respuestas as $index => $respuesta)
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input class="form-control"
                                                    wire:model="respuestas.{{ $index }}.titulo" type="text"
                                                    placeholder="Escriba la posible respuesta">
                                            </div>

                                            <div class="col-md-4">
                                                <div class="d-flex gap-3 justify-content-between">
                                                    <div class="d-flex">
                                                        <input wire:model="respuestas.{{ $index }}.es_correcta"
                                                            class="form-check-input" type="checkbox"
                                                            id="respuestas_{{ $index }}">
                                                        <label for="respuestas_{{ $index }}">Es Correcta</label>
                                                    </div>

                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        wire:click="removeAnswer({{ $index }})">X</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Mensaje de error para respuestas -->
                                    @error('respuestas.*')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="mi-boton azul mt-3 w-100"
                                                wire:click="addAnswer">Generar Respuesta</button>
                                        </div>

                                        <div class="col-md-6">
                                            <button class="mi-boton rojo mt-3 w-100" type="submit">Guardar
                                                Pregunta</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>



            <div class="col-md-12">
                <div class="card sombra">
                    <div class="card-header fondo-general">
                        <h2 class="lead text-white">Lista de Preguntas</h2>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pregunta</th>
                                    <th>
                                        <i class='bx bx-message-alt-x bx-burst'></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td>{{ $question->id }}</td>
                                        <td>{{ Str::slug(substr($question->titulo, 0, 60)) }}</td>
                                        <td>
                                            <button wire:click="delete({{ $question->id }})"
                                                class="mi-boton rojo btn-sm"><i
                                                    class='bx bx-message-alt-x bx-burst'></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Recordar!</strong> Una vez hayas creado el tema y el examen, necesitarás publicar el
                            examen y culminar el tema.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
        <script>
            document.addEventListener('livewire:load', function() {
                ClassicEditor
                    .create(document.querySelector('#description'), {
                        toolbar: [
                            'heading', '|', 'bold', 'italic', 'link', 'blockQuote', 'imageUpload'
                        ],
                        heading: {
                            options: [{
                                    model: 'paragraph',
                                    title: 'Paragraph',
                                    class: 'ck-heading_paragraph'
                                },
                                {
                                    model: 'heading1',
                                    view: 'h1',
                                    title: 'Heading 1',
                                    class: 'ck-heading_heading1'
                                },
                                {
                                    model: 'heading2',
                                    view: 'h2',
                                    title: 'Heading 2',
                                    class: 'ck-heading_heading2'
                                }
                            ]
                        },
                        // Integración del adaptador de carga de archivos personalizado
                        extraPlugins: [MyCustomUploadAdapterPlugin],
                    })
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            @this.set('titulo', editor.getData());
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });

                // Función para el adaptador personalizado de carga de archivos
                function MyCustomUploadAdapterPlugin(editor) {
                    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                        return new MyUploadAdapter(loader);
                    };
                }

                // Adaptador personalizado para la carga de archivos
                class MyUploadAdapter {
                    constructor(loader) {
                        this.loader = loader;
                    }

                    upload() {
                        return this.loader.file
                            .then(file => new Promise((resolve, reject) => {
                                const reader = new FileReader();
                                reader.readAsDataURL(file);
                                reader.onload = () => resolve({
                                    default: reader.result
                                });
                                reader.onerror = error => reject(error);
                            }));
                    }

                    abort() {
                        // Manejo de la cancelación de carga
                    }
                }

                Livewire.on('ckeditorReady', () => {
                    if (typeof ClassicEditor !== 'undefined') {
                        ClassicEditor.instances.forEach(instance => {
                            instance.destroy();
                        });

                        ClassicEditor.create(document.querySelector('#description'), {
                                toolbar: [
                                    'heading', '|', 'bold', 'italic', 'link', 'blockQuote',
                                    'imageUpload'
                                ],
                                heading: {
                                    options: [{
                                            model: 'paragraph',
                                            title: 'Paragraph',
                                            class: 'ck-heading_paragraph'
                                        },
                                        {
                                            model: 'heading1',
                                            view: 'h1',
                                            title: 'Heading 1',
                                            class: 'ck-heading_heading1'
                                        },
                                        {
                                            model: 'heading2',
                                            view: 'h2',
                                            title: 'Heading 2',
                                            class: 'ck-heading_heading2'
                                        }
                                    ]
                                },
                                extraPlugins: [MyCustomUploadAdapterPlugin],
                            })
                            .then(editor => {
                                editor.model.document.on('change:data', () => {
                                    @this.set('titulo', editor.getData());
                                });
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    }
                });
            });
        </script>
    @endsection
</div>
