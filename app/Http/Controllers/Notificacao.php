<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Notificacao extends Controller
{
    public function notificar(Request $request)
    {
        $mensagem = $request->input('mensagem');
        $titulo = $request->input('titulo');

        if (is_string($mensagem) && is_string($titulo)) {
        	$gcm = \App::make('App\GcmModel');
        	$res = $gcm->all();
        	$ids = [];
        	foreach ($res as $key) {
        		$ids[] = $key->registration_id;
        	}
        	(new \App\Gcm())
        		->enviar(
        			$ids,
        			$titulo,
        			$mensagem
        		);
        }

        return redirect()->back()->with('status', 'SUCESSO');
    }
}