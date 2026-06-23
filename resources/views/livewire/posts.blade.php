<div>
    @foreach ($posts as $post)
        <div class="mi-card mt-2">
            <div class="mi-card-content">
                <div class="d-flex justify-content-between align-items-center">
                    <small>Por:
                        <strong
                            style="display: inline-block; width: 25px; height: 25px; background-color: orange; color: white; border-radius: 50%; text-align: center; line-height: 25px; font-weight: bold;">
                            {{ strtoupper(substr($post->user->name, 0, 1)) }}
                        </strong>
                    </small>
                </div>

                <a href="{{ route('visitador.post.comment', ['post' => $post]) }}">
                    <div class="d-flex align-items-center">
                        <i class='bx bx-link-alt color-general' style="font-size: 30px"></i>
                        <h1 class="lead color-general" style="font-size: 30px"><strong>{{ $post->title }}</strong></h1>
                    </div>
                </a>

                @if (in_array($post->id, $expandedPosts))
                    <p class="mt-3">{!! $post->content !!}</p>
                @else
                    <p class="mt-3">{!! Str::limit($post->content, 150) !!}</p> <!-- Muestra solo los primeros 200 caracteres -->
                @endif
                <a href="#" wire:click.prevent="toggleExpand({{ $post->id }})">
                    @if (in_array($post->id, $expandedPosts))
                        Leer menos
                    @else
                        Leer más
                    @endif
                </a>

                {{-- COMPONETE LIVEWIRE DE REACCIONES --}}
                <div class="d-flex justify-content-between align-items-center mt-2">
                    @livewire('reactions', ['postId' => $post->id], key($post->id))
                    <p class="text-bold"><strong>{{ $post->created_at->diffForHumans() }}</strong></p>
                </div>
                {{-- COMPONENTE LIVEWIRE DE REACCIONES --}}
            </div>
        </div>
    @endforeach

    @if ($posts->count() < $this->perPage)
        <div class="d-block text-center mt-2">
            <div class="spinner-grow" role="status">
                <span class="visually-hidden">...</span>
            </div>
        </div>
    @else
        {{-- <div wire:loading wire:target='loadMore' class="d-block text-center mt-2">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div> --}}
        <div class="text-center mt-2">
            <button wire:click="loadMore" class="btn btn-primary">Cargar más</button>
        </div>
    @endif

    {{-- <script>
        document.addEventListener('livewire:load', function() {
            window.addEventListener('scroll', function() {
                if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                    @this.call('loadMore');
                }
            });
        });
    </script> --}}
</div>
