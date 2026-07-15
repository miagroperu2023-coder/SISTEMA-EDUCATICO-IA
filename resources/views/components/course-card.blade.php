<div class="container py-4">

    <div class="row g-4">

        @foreach ($courses as $course)
            <div class="col-sm-6 col-md-4 col-lg-3">

                <div class="card h-100 shadow-sm border-0">

                    {{-- Imagen --}}
                    @if ($url == 'gratis')
                        <a href="{{ route('visitador.course.free.show', $course) }}">
                            <img src="{{ $course->image->url }}" class="card-img-top"
                                style="height:220px; object-fit:cover;" alt="{{ $course->title }}">
                        </a>
                    @else
                        <a href="{{ route('visitador.course.show', $course) }}">
                            <img src="{{ $course->image->url }}" class="card-img-top"
                                style="height:220px; object-fit:cover;" alt="{{ $course->title }}">
                        </a>
                    @endif

                    <div class="card-body d-flex flex-column">

                        <h5 class="card-title fw-bold text-center">
                            {{ $course->title }}
                        </h5>

                        <div class="d-flex justify-content-between align-items-center mt-3">

                            <small class="text-muted">
                                <i class='bx bxs-user-plus'></i>
                                {{ $course->students_count }}00 estudiantes
                            </small>

                            <span class="badge bg-warning text-dark">
                                ⭐ {{ number_format($course->rating, 1) }}
                            </span>

                        </div>

                        <div class="text-warning text-center my-3">

                            @for ($i = 1; $i <= 5; $i++)
                                <i class='bx {{ $course->rating >= $i ? 'bxs-star' : 'bx-star' }}'></i>
                            @endfor

                        </div>

                        <div class="mt-auto">

                            @if ($url == 'gratis')
                                <a href="{{ route('visitador.course.free.show', $course) }}"
                                    class="btn btn-primary w-100">

                                    Ver curso

                                </a>
                            @else
                                <a href="{{ route('visitador.course.show', $course) }}" class="btn btn-primary w-100">

                                    Ver curso

                                </a>
                            @endif

                        </div>

                    </div>

                </div>

            </div>
        @endforeach

    </div>

</div>
