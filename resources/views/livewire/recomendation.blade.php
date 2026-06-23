<div>
    <div class="text-center mb-3">
        <button wire:click="generar" class="btn btn-primary" wire:loading.attr="disabled">
            🔍 Generar recomendación personalizada con IA
        </button>
        <div wire:loading>
            <p class="mt-2 text-muted">⏳ Analizando tus resultados, por favor espera...</p>
        </div>
    </div>


    @if ($recomendacion)
        <div class="mi-card mt-3">
            <div class="mi-card-content">
                <h2 class="contenido-bloques-titulo">🧠 Recomendación Personalizada</h2>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p class="contenido-bloques-parrafo">{!! nl2br(e($recomendacion['texto'])) !!}</p>
                    </div>
                </div>

                @if ($recomendacion['videos']->isNotEmpty())
                    <h3 class="mt-4 contenido-bloques-titulo">🎥 Videos recomendados para repasar</h3>
                    <div class="row">
                        @foreach ($recomendacion['videos'] as $video)
                            <div class="col-md-6 mb-3">
                                <div class="card border-0 shadow-sm rounded-3 h-100">
                                    <h5 class="fw-bold text-primary">{{ $video['curso'] }} - {{ $video['seccion'] }}
                                    </h5>
                                    <p>{{ $video['titulo'] }}</p>

                                    @php
                                        // Extraer el ID del video de YouTube desde la URL o iframe original
                                        preg_match('/embed\/([a-zA-Z0-9_-]+)/', $video['iframe'], $matches);
                                        $youtubeId = $matches[1] ?? null;
                                    @endphp

                                    @if ($youtubeId)
                                        <div id="player-recomendacion-{{ $loop->index }}" class="plyr__video-embed">
                                            <iframe
                                                src="https://www.youtube.com/embed/{{ $youtubeId }}?rel=0&modestbranding=1"
                                                allowfullscreen allow="autoplay" style="width: 100%; height: 400px;">
                                            </iframe>
                                        </div>
                                    @else
                                        <small class="text-muted">Video no disponible.</small>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endif
            </div>
        </div>
    @endif

    @section('scripts')
        <!-- Plyr Initialization Script -->
        <script src="{{ asset('js/visitador/plyr/plyr.js') }}"></script>
    @endsection
</div>
