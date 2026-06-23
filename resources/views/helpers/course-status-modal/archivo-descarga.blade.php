<div>
    @php
        // Extraer el ID del archivo de Google Drive de la URL
        $fileId = null;
        if ($current->resource && preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $current->resource->url, $matches)) {
            $fileId = $matches[1];
        }
    @endphp

    @if ($fileId)
        <a id="descargaArchivoCourseStatus" href="https://drive.google.com/uc?export=download&id={{ $fileId }}"
            class="mi-boton general mt-3" download>Descargar Archivo</a>
    @else
        <p class="mt-3">
            {{ $current->resource ? $current->resource->url : 'lección sin recurso' }}
        </p>
    @endif
</div>
