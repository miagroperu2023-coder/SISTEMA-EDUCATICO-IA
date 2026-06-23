<?php

namespace App\Http\Controllers\admin\whatsapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use phpseclib3\Crypt\RC2;
use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    //

    public function index()
    {
        return view('admin.whatsapp.index');
    }


    public function send(Request $request)
    {
        $request->validate([
            'telefono' => 'required',
            'pregunta' => 'required',
            'respuesta' => 'required',
        ]);

        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $from = env('TWILIO_WHATSAPP_FROM');

        $twilio = new Client($sid, $token);

        $mensaje = "*Pregunta médica:*\n{$request->pregunta}\n\n *Respuesta:*\n{$request->respuesta}";

        $twilio->messages->create("whatsapp:{$request->telefono}", [
            'from' => $from,
            'body' => $mensaje
        ]);

        return back()->with('success', '📤 Mensaje enviado correctamente a WhatsApp');
    }
}
