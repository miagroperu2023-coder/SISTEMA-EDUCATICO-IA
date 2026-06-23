<?php

namespace App\Policies;

use App\Models\Exam;
use App\Models\ExamUser;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExamUserPolicy
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

    //PARA VERIFICAR SU ESTA INSCRITO AL EXAMEN
    public function enrolledExamUser(User $user, Exam $exam)
    {
        // Devuelve true si el usuario está inscrito en el examen, false si NO está inscrito
        return ExamUser::where('user_id', $user->id)->where('exam_id', $exam->id)->exists();
    }


    //PARA VER SI YA CULMINO SU EXAMEN O AUN ESTA PENDIENTE
    public function ExamUserStatus(User $user, Exam $exam)
    {
        $ExamStatus = ExamUser::where('user_id', $user->id)->where('exam_id', $exam->id)->first();

        if ($ExamStatus->status == 'Pendiente') {
            return true;
        } else {
            return false;
        }
    }
}
