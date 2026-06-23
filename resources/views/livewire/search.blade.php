<div>
    {{-- Success is as dangerous as failure. --}}

    <div class="card mt-2">
        <div class="card-body">
                <input wire:model="search" class="form-control" type="search" name="search" placeholder="Buscar mis cursos"
                    autocomplete="off">
        </div>
    </div>

    <div class="">
        @if ($search)
            <ul class="list-group z-index mt-1">
                {{-- PINTANDO LOS DATOS CON METODO "getResultsProperty" --}}
                @forelse ($this->results as $result)
                    <a href="{{ route('visitador.course.show', ['course' => $result]) }}">
                        <li class="list-group-item">
                            <img src="{{ $result->image->url }}" style="width: 30px;height: 30px;border-radius: 50%;"
                                alt="...">
                            {{ $result->title }}
                        </li>
                    </a>
                @empty
                    <li class="list-group-item">No hubo resultados</li>
                @endforelse
            </ul>
        @endif
    </div>
</div>
