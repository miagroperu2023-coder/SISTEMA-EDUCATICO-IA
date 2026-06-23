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

class SocialFacebookAuthController extends Controller
{
    // Redirige a Google
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            // Buscar usuario por Facebook ID primero
            $user = User::where('facebook_id', $facebookUser->getId())->first();

            // Si no se encontró por Facebook ID, buscar por email (si tiene)
            if (!$user && $facebookUser->getEmail()) {
                $user = User::where('email', $facebookUser->getEmail())->first();

                // Si encontró usuario con el mismo email, asociarle el Facebook ID
                if ($user) {
                    $user->update(['facebook_id' => $facebookUser->getId()]);
                }
            }

            // Si el usuario aún no existe, crearlo
            if (!$user) {
                $user = User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(), // Puede ser NULL
                    'facebook_id' => $facebookUser->getId(),
                    'password' => Hash::make(Str::random(16)), // Generar contraseña segura
                ]);

                $isNewUser = true;
            } else {
                $isNewUser = false;
            }

            // Autenticar usuario
            Auth::login($user);

            // Si es nuevo, enviar correo de bienvenida (si tiene email)
            if ($isNewUser && $user->email) {
                Mail::to($user->email)->send(new MailUserBienvenida($user));
            }

            // Redirigir según el rol
            return $user->redirectToDashboard();
        } catch (InvalidStateException $e) {
            return redirect()->route('login')->with('error', 'Error de autenticación con Facebook.');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Ocurrió un error inesperado.');
        }
    }
}
