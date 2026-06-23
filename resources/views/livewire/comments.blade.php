<div>
    {{-- Be like water. --}}
    <div class="mt-4">
        {{-- FORMULARIO PARA LOS COMENTARIOS GENERALES DEL POST --}}
        @if (auth()->check())
            <form wire:submit.prevent='addComment'>
                <textarea wire:model.defer="newComment" class="form-control" placeholder="Agregar comentario"></textarea>
                <button type="submit" class="btn btn-primary mt-2 ">Comentar</button>
            </form>
            @error('newComment')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        @endif
        {{-- FORMULARIO PARA LOS COMENTARIOS GENERALES DEL POST --}}

        <h1 class="mt-4 lead">Comentarios</h1>

        <div>
            {{-- LISTA DE LOS COMENTARIOS GENERALES HACIA LA PUBLICACION --}}
            @foreach ($comments as $comment)
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong
                                        style="display: inline-block; width: 25px; height: 25px; background-color: orange; color: white; border-radius: 50%; text-align: center; line-height: 25px; font-weight: bold;">
                                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                    </strong>
                                    {{ $comment->user->name }}
                                </div>

                                <small>- <strong>{{ $comment->created_at->diffForHumans() }}</strong></small>
                            </div>
                            <button wire:click='setParentComment({{ $comment->id }})'
                                class="mi-boton amarillo btn-sm">Responder</button>
                        </div>

                        <div class="d-flex align-items-center">
                            <i class='bx bx-comment-dots bx-tada' style='color: #1a1f71'></i>
                            <p style="padding-left: 7px">
                                @if (Str::startsWith($comment->content, 'data:image'))
                                    {{-- Mostrar como imagen --}}
                                    <img src="{{ $comment->content }}" alt="Imagen">
                                @else
                                    {{-- Mostrar como texto --}}
                                    <strong>{{ $comment->content }}</strong>
                                @endif
                            </p>
                        </div>

                        {{-- COMPONENTE DE REACTIONS PARA LOS COMENTARIOS GENERALES --}}
                        @livewire('reactions', ['commentId' => $comment->id], key($comment->id))
                        <hr>
                        {{-- COMPONENTE DE REACTIONS PARA LOS COMENTARIOS GENERALES --}}


                        {{-- FORMULARIO PARA PODER COMENTAR A ALGUN USUARIO QUE PUBLICO ALGUN COMENTARIO --}}
                        @if ($this->parentCommentId === $comment->id)
                            <form wire:submit.prevent='addComment'>
                                <textarea wire:model.defer="newComment" class="form-control mt-2" placeholder="Agregar comentario"></textarea>
                                <button type="submit" class="mi-boton azul mt-1 btn-sm">Comentar</button>
                                <button type="submit" wire:click='cancel'
                                    class="mi-boton amarillo mt-1 btn-sm">Cancelar</button>
                            </form>
                            @error('newComment')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @endif
                        {{-- FORMULARIO PARA PODER COMENTAR A ALGUN USUARIO QUE PUBLICO ALGUN COMENTARIO --}}


                        {{-- BUCLE PARA LISTAR LOS COMENTARIOS DE LOS USUARIOS --}}
                        @foreach ($comment->replies as $reply)
                            <div class="card mt-2 ml-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong
                                                style="display: inline-block; width: 25px; height: 25px; background-color: orange; color: white; border-radius: 50%; text-align: center; line-height: 25px; font-weight: bold;">
                                                {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                            </strong>
                                            {{ $comment->user->name }}
                                        </div>

                                        <small> <strong>{{ $comment->created_at->diffForHumans() }}</strong></small>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <i class='bx bx-message-rounded-dots bx-tada' style='color: #1a1f71'></i>
                                        <p><strong>{{ $reply->content }}</strong></p>
                                    </div>

                                    {{-- COMPONENTE DE REACTIONS PARA LOS COMENTARIOS DE LOS REPLIES --}}
                                    @livewire('reactions', ['commentId' => $reply->id], key($reply->id))
                                    {{-- COMPONENTE DE REACTIONS PARA LOS COMENTARIOS DE LOS REPLIES --}}

                                </div>
                            </div>
                        @endforeach
                        {{-- BUCLE PARA LISTAR LOS COMENTARIOS DE LOS USUARIOS --}}
                    </div>
                </div>
            @endforeach
            {{-- LISTA DE LOS COMENTARIOS GENERALES HACIA LA PUBLICACION --}}
        </div>
    </div>
</div>
