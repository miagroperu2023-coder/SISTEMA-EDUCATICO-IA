<div>
    {{-- Stop trying to control. --}}
    <article x-data="{ open: false }">
        <div>
            <header>
                <h3 class="cursor-status" x-on:click="open =!open" style="font-size: 12px">Recurso de la Lección (opcional)
                </h3>
            </header>

            <div x-show="open">
                {{-- FORMULARIO PARA CREAR UNA RECURSO DE LA LECCION --}}
                @if (!$resource_id)
                    <form wire:submit.prevent="create">
                        <div class="d-flex item-center">
                            <input wire:model="url" type="text" class="form-control flex-1 text-sm">
                            <button type="submit" class="mi-boton azul btn-sm">Crear</button>
                        </div>
                        @error('url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </form>
                @endif
                {{-- FORMULARIO PARA CREAR UNA RECURSO DE LA LECCION --}}


                {{-- FORMULARIO PARA EDITAR UNA RECURSO DE LA LECCION --}}
                @if ($resource_id)
                    <form wire:submit.prevent="update">
                        <div class="d-flex item-center">
                            <input wire:model="url" type="text" class="form-control flex-1 text-sm">
                            <button class="mi-boton azul btn-sm"> <i
                                    class='bx bx-edit-alt bx-tada'></i></button>
                            <button wire:click="delete({{ $resource_id }})" class="mi-boton rojo btn-sm"><i
                                    class='bx bx-message-alt-x bx-burst'></i></button>
                        </div>
                        @error('url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </form>
                @endif
                {{-- FORMULARIO PARA EDITAR UNA RECURSO DE LA LECCION --}}
                <hr class="mt-2">
            </div>
        </div>
    </article>
</div>
