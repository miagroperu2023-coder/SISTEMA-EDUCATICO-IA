<?php

namespace App\Policies;

use App\Models\Pay;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserSubscriptionPolicy
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

    //SUSCRIPCION PRE UNIVERSITARIO
    public function viewSubscription(User $user)
    {
        $subscription = Pay::where('user_id', $user->id)
            ->where('collection_status', 'PLAN-PRE-UNI')
            ->where('estado', 'SUSCRITO')
            ->first();

        return $subscription ? true : false;
    }

    //SUSCRIPCION DE 6 MESES
    public function viewSubscriptionSixMonth(User $user)
    {
        $subscription = Pay::where('user_id', $user->id)
            ->where('collection_status', 'PLAN-SEIS-MESES')
            ->where('estado', 'SUSCRITO')
            ->first();

        return $subscription ? true : false;
    }

    //SUSCRIPCION DE 12 MESES
    public function viewSubscriptionYear(User $user)
    {
        $subscription = Pay::where('user_id', $user->id)
            ->where('collection_status', 'PLAN-DOCE-MESES')
            ->where('estado', 'SUSCRITO')
            ->first();

        return $subscription ? true : false;
    }

    //SUSCRIPCION UNIVERSITARIO
    public function viewSubscriptionUniversitario(User $user)
    {
        $subscription = Pay::where('user_id', $user->id)
            ->where('collection_status', 'PLAN-UNI')
            ->where('estado', 'SUSCRITO')
            ->first();

        return $subscription ? true : false;
    }

    //SUSCRIPCION ESCOLAR
    public function viewSubscriptionEscolar(User $user)
    {
        $subscription = Pay::where('user_id', $user->id)
            ->where('collection_status', 'PLAN-ESCOLAR')
            ->where('estado', 'SUSCRITO')
            ->first();

        return $subscription ? true : false;
    }

    //NO TIENE NINGUNA SUSCRIPCION
    public function notSubscription(User $user)
    {
        $subscription = Pay::where('user_id', $user->id)
            ->whereIn('collection_status', ['PLAN-PRE-UNI', 'PLAN-DOCE-MESES', 'PLAN-SEIS-MESES'])
            ->where('estado', 'SUSCRITO')
            ->first();

        return $subscription ? false : true;
    }
}
