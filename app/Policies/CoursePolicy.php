<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;



class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //PARA VERIFICAR SI EL ALUMNO ESTA MATRICULADO EN EL CURSO
    //EN UNA POLICY EL USER ESTA POR DEFECTO
    public function enrolled(User $user, Course $course)
    {
        //VERIFICAMOS SI EL USUARIO ESTA CONTENIDO DENTRO DE LA TABLA "course_user"
        //DEVUELVE TRUE O FALSE - SI ES TRUE MOSTRAMOS "Continuar con el curso"
        return $course->students->contains($user->id);
    }

    public function enrolledFree(User $user, Course $course)
    {
        //VERIFICAMOS SI EL USUARIO ESTA CONTENIDO DENTRO DE LA TABLA "course_user"
        //DEVUELVE TRUE O FALSE - SI ES TRUE MOSTRAMOS "Continuar con el curso"
        return $course->freeStudents->contains($user->id);
    }

    public function insideCourse(User $user, Course $course)
    {
        return $course->freeStudents->contains($user->id) || $course->students->contains($user->id);
    }

    //PARA QUE EL USUARIO NO ABRA CURSO DE ESTADO DIFERENTE DE PUBLICADO
    public function published(?User $user, Course $course)
    {
        if ($course->status == 3) {
            return true;
        } else {
            return false;
        }
    }

    //PARA VERIFICAR QUE EL CURSO LE PERTENECE A UN INSTRUCTOR
    public function dicatated(User $user, Course $course)
    {
        if ($course->user_id == $user->id) {
            return true;
        } else {
            return false;
        }
    }

    //PARA VERIFICAR QUE EL INSTRUCTOR NO PUEDA APROBAR SU CURSO COMO ADMIN
    public function revision(User $user, Course $course)
    {
        if ($course->status == 2) {
            return true;
        } else {
            return false;
        }
    }

    //PARA VERIFICAR SI YA AGREGO UNA RESEÑA AL CURSO
    public function valued(User $user, Course $course)
    {
        if (Review::where('user_id', '=', $user->id)->where('course_id', $course->id)->count()) {
            return false;
        } else {
            return true;
        }
    }
}
