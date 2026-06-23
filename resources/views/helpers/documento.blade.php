<div class="mi-card">
    <div class="mi-card-content">
        <div class="row">

            <div class="col-md-8 my-1">
                <div id="flipbook">
                    <iframe style="width: 100%;height: 550px;" src="{{ $archive->url }}" title="Material educativo">
                    </iframe>
                </div>
            </div>

            <div class="col-md-4">
                <div class="mi-card">
                    <div class="mi-card-content">
                        <div class="text-center">
                            @php
                                // Extraer el ID del archivo de Google Drive de la URL
                                $fileId = null;
                                if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $archive->url, $matches)) {
                                    $fileId = $matches[1];
                                }
                            @endphp

                            @if ($fileId)
                                <a id="downloadLink"
                                    href="https://drive.google.com/uc?export=download&id={{ $fileId }}"
                                    class="btn btn-primary" download>Descargar Archivo</a>
                            @else
                                <p>No se pudo generar el enlace de descarga.</p>
                            @endif
                        </div>
                        <div class="text-center mt-3">
                            <img src="{{ $course->image->url }}" style="width: 120px;height: 120px;"
                                alt="{{ $archive->course->title }}"
                                style="width: 100%;height: 240px;border-radius: 10px;object-fit: scale-down">
                        </div>

                        <div class="card-footer">
                            <p>{{ $archive->name }}</p>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $('#downloadLink').on('click', function(event) {
                                    var $button = $(this);

                                    // Cambiar texto para indicar que se está descargando
                                    $button.text('Descargando archivo...');

                                    // Añadir clase 'disabled-link' para desactivar el enlace visualmente y funcionalmente
                                    $button.addClass('disabled-link');

                                    // Deshabilitar más clics previniendo la acción predeterminada
                                    event.preventDefault();

                                    // Iniciar la descarga manualmente después de un breve retraso
                                    setTimeout(function() {
                                        window.location.href = $button.attr('href');
                                    }, 500); // Inicia la descarga después de 0.5 segundos

                                    // Rehabilitar el enlace después de 6 segundos
                                    setTimeout(function() {
                                        // Restaurar el texto original y remover la clase 'disabled-link' para volver a habilitar el enlace
                                        $button.text('Descargar Archivo');
                                        $button.removeClass('disabled-link');
                                    }, 7000); // 6 segundos
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="mi-card">
                    <div class="mi-card-content">
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Referencia del Material:</strong>
                            <p>
                                Material extraído de la Web
                                {{ $archive->cita }}.
                                <strong>Recuperado de:</strong>
                                <a target="_blank" href="{{ $archive->cita }}" title="{{ $archive->cita }}">
                                    {{ $archive->cita }}
                                </a>
                            </p>
                            <p class="mb-0">
                                <em>
                                    <strong>Este material no es de propiedad de esta plataforma. Se cita la fuente para
                                        reconocer la veracidad y autenticidad del documento, con fines exclusivamente
                                        educativos y en beneficio de la comunidad estudiantil de
                                        <a href="https://eduperuapp.com/">https://eduperuapp.com/</a>.</strong>
                                </em>
                            </p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
