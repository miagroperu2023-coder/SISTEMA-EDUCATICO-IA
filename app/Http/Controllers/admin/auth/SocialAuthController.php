<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\MailUserBienvenida;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Two\InvalidStateException;

class SocialAuthController extends Controller
{
    // Redirige a Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Buscar o crear usuario
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(16)),
                ]
            );

            // Verificar si el usuario es nuevo (solo si se acaba de crear)
            $isNewUser = $user->wasRecentlyCreated;

            // Autenticar usuario
            Auth::login($user);

            // Si es nuevo, enviar correo de bienvenida
            if ($isNewUser) {
                Mail::to($user->email)->send(new MailUserBienvenida($user));
            }

            // Redirige según el rol
            return $user->redirectToDashboard();
        } catch (InvalidStateException $e) {
            return redirect()->route('login')->with('error', 'Error de autenticación con Google.');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Ocurrió un error inesperado.');
        }
    }
}
