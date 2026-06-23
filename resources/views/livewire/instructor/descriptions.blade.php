<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <article x-data="{ open: false }">
        <div>
            <header>
                <h3 class="cursor-status" x-on:click="open =!open" style="font-size: 12px">Descripcion de la lección
                    (opcional):</h3>
            </header>

            <div x-show="open">
                {{-- FORMULARIO PARA CREAR UNA DESCRIPCION DE LA LECCION --}}
                @if (!$description_id)
                    <form wire:submit.prevent="create">
                        <div class="d-flex item-center">
                            <input type="text" class="form-control flex-1" wire:model="name">
                            <button class="mi-boton azul btn-sm">Crear</button>
                        </div>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </form>
                @endif
                {{-- FORMULARIO PARA CREAR UNA DESCRIPCION DE LA LECCION --}}


                {{-- FORMULARIO PARA ACTUALIZAR UNA DESCRIPCION DE LA LECCION --}}
                @if ($description_id)
                    <form wire:submit.prevent="update">
                        <div class="d-flex item-center">
                            <input type="text" class="form-control flex-1" wire:model="name">
                            <button class="mi-boton azul btn-sm"> <i
                                    class='bx bx-edit-alt bx-tada'></i></button>
                            <button wire:click="delete({{ $description_id }})" class="mi-boton rojo btn-sm"><i
                                    class='bx bx-message-alt-x bx-burst'></i></button>
                        </div>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </form>
                @endif
                {{-- FORMULARIO PARA ACTUALIZAR UNA DESCRIPCION DE LA LECCION --}}
                <hr class="mt-2">
            </div>
        </div>
    </article>
</div>
