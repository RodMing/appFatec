<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Notificacao extends Controller
{
    public function notificar(Request $request)
    {
        $mensagem = $request->input('mensagem');

        if (is_string($mensagem)) {
        	$gcm = \App::make('App\GcmModel');
        	$res = $gcm->all()->get();
        	dd($res);
        	(new \App\Gcm())->enviar();
        }

        return redirect()->back();
    }
}