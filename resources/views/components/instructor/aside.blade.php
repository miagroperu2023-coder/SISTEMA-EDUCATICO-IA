<div>
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
    <aside class="sombra">
        <ul class="list-group z-index mt-1">
            <li class="list-group-item">
                <a class="cursor-status"
                    href="{{ route('admin.instructor.course.edit', ['course' => $course]) }}">Informacion
                    del curso</a>
            </li>
            <li class="list-group-item">
                <a class="cursor-status"
                    href="{{ route('admin.instructor.section.index', ['course' => $course]) }}">Secciones
                    del curso</a>
            </li>

            <li class="list-group-item">
                <a class="cursor-status"
                    href="{{ route('admin.instructor.lesson.index', ['course' => $course]) }}">Lecciones
                    del curso</a>
            </li>

            <li class="list-group-item">
                <a class="cursor-status" href="{{ route('admin.instructor.goal.index', ['course' => $course]) }}">Metas
                    del
                    curso</a>
            </li>

            <li class="list-group-item">
                <a class="cursor-status"
                    href="{{ route('admin.instructor.requirement.index', ['course' => $course]) }}">Requerimientos del
                    curso</a>
            </li>

            <li class="list-group-item">
                <a class="cursor-status"
                    href="{{ route('admin.instructor.audience.index', ['course' => $course]) }}">Audiencia</a>
            </li>

            <li class="list-group-item">
                <a class="cursor-status"
                    href="{{ route('admin.instructor.student.index', ['course' => $course]) }}">Estudiantes</a>
            </li>

            <li class="list-group-item">
                @switch($course->status)
                    @case(1)
                        <form action="{{ route('admin.instructor.course.status', ['course' => $course]) }}" method="POST">
                            @csrf
                            <button type="submit" class="mi-boton verde">Solicitar Revisión</button>
                        </form>
                    @break

                    @case(2)
                        <button class="mi-boton amarillo">Curso en Revisión</button>
                    @break

                    @default
                        <button class="mi-boton verde">Curso Publicado</button>
                @endswitch
            </li>
        </ul>
    </aside>
</div>
