 <!-- Button trigger modal -->
 <button type="button" class="mi-boton general" data-bs-toggle="modal" data-bs-target="#MoldalReferenciaVideo">
     Referencia del vídeo:
 </button>

 <div class="modal fade" id="MoldalReferenciaVideo" tabindex="-1" aria-labelledby="MoldalReferenciaVideoLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="MoldalReferenciaVideoLabel">Referencia
                     del vídeo</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 @php
                     $url = $current->url;
                     $urlParts = parse_url($url);
                     $channelName = '';
                     $videoDate = '';

                     if (isset($urlParts['query'])) {
                         parse_str($urlParts['query'], $queryArray);
                         $channelName = $queryArray['ab_channel'] ?? '';
                         $videoDate = $queryArray['t'] ?? '';

                         if ($videoDate) {
                             $fecha = 'No disponible'; // Agrega el punto y coma aquí
                         } else {
                             $fecha = $videoDate;
                         }
                     }
                 @endphp

                 <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">

                     <strong class="d-block mb-2">🎥 Referencia audiovisual académica</strong>

                     <p class="mb-2">
                         <strong>{{ $current->name }}</strong><br>
                         Recurso publicado por el canal <strong>{{ $channelName }}</strong> en YouTube.
                     </p>

                     <p class="mb-2">
                         <strong>Fuente original:</strong>
                         <a target="_blank" href="{{ $current->url }}" title="{{ $channelName }}">
                             Ver recurso original
                         </a>
                     </p>

                     <p class="mb-0">
                         <em>
                             <strong>
                                 Este recurso pertenece a su fuente original y es referenciado dentro de la plataforma
                                 con fines exclusivamente educativos. EdPerú reconoce y respeta la autoría
                                 correspondiente,
                                 promoviendo el acceso responsable al conocimiento mediante la debida citación de la
                                 fuente.
                             </strong>
                         </em>
                     </p>

                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar">
                     </button>

                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="mi-boton general" data-bs-dismiss="modal">Cerrar</button>
             </div>
         </div>
     </div>
 </div>
