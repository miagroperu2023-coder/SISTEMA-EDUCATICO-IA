<div>
    <div class="" id="contenido-bloques">
        <div class="contenedor">
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-md-3 my-2">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="text-dark mb-1 text-center font-weight-bold lead">{{ $course->title }}</h2>
                                <div class="text-center">
                                    @if ($url === 'gratis')
                                        <a href="{{ route('visitador.course.free.show', ['course' => $course]) }}">
                                            <img class="imagen" src="{{ $course->image->url }}" alt="">
                                        </a>
                                    @else
                                        <a href="{{ route('visitador.course.show', ['course' => $course]) }}">
                                            <img class="imagen" src="{{ $course->image->url }}" alt="">
                                        </a>
                                    @endif
                                </div>

                                {{-- <p class="contenido-bloques-parrafo">{!! Str::limit($course->description, 50) !!}</p> --}}

                                <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <i class='bx bxs-user-plus' style="font-size: 24px"></i>
                                        <p>({{ $course->students_count }}0)</p>
                                    </div>

                                    <ul class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p>{{ round($course->rating) }}</p>
                                        </div>

                                        <div class="d-flex">
                                            <li>
                                                <i style='color:#da920f'
                                                    class='bx bx-star {{ $course->rating >= 1 ? 'bx bxs-star' : '' }}'></i>
                                            </li>
                                            <li>
                                                <i style='color:#da920f'
                                                    class='bx bx-star {{ $course->rating >= 2 ? 'bx bxs-star' : '' }}'></i>
                                            </li>
                                            <li>
                                                <i style='color:#da920f'
                                                    class='bx bx-star {{ $course->rating >= 3 ? 'bx bxs-star' : '' }}'></i>
                                            </li>
                                            <li>
                                                <i style='color:#da920f'
                                                    class='bx bx-star {{ $course->rating >= 4 ? 'bx bxs-star' : '' }}'></i>
                                            </li>
                                            <li>
                                                <i style='color:#da920f'
                                                    class='bx bx-star {{ $course->rating == 5 ? 'bx bxs-star' : '' }}'></i>
                                            </li>
                                        </div>
                                    </ul>
                                </div>
                                {{-- PARA VALIDAR QUE EL USUARIO ESTE AUTENTICADO Y CON ELLO PODER DIRIGIRLE A SU RESPECTIVA RUTA DE TIPO DE PAGOS --}}
                                @if (auth()->check())
                                    @if ($url == 'gratis')
                                        <a href="{{ route('visitador.course.free.show', ['course' => $course]) }}"
                                            class="btn-solid-sm p-4 mt-2 w-100 text-center">Detalles</a>
                                    @else
                                        <a href="{{ route('visitador.course.show', ['course' => $course]) }}"
                                            class="btn-solid-sm p-4 mt-2 w-100 text-center">Detalles</a>
                                    @endif
                                @else
                                    @if ($url == 'gratis')
                                        <a href="{{ route('visitador.course.free.show', ['course' => $course]) }}"
                                            class="btn-solid-sm p-4 mt-2 w-100  text-center">Detalles</a>
                                    @else
                                        <a href="{{ route('visitador.course.show', ['course' => $course]) }}"
                                            class="btn-solid-sm p-4 mt-2 w-100  text-center">Detalles</a>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
