<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Notificacao extends Controller
{
    public function notificar(Request $request)
    {
        $mensagem = $request->input('mensagem');

        if (is_string($mensagem)) {
        	// $result = (new \App\Gcm())->send($mensagem);
        	// dd($result);
        }

        return redirect()->back();
    }
}