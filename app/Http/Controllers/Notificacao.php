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
        	$ids = [];
        	foreach ($res as $key) {
        		$ids[] = $key->registration_id;
        	}
        	dd((new \App\Gcm())->enviar($ids, 'Titulo', $mensagem));
        }

        return redirect()->back();
    }
}