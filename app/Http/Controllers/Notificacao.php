<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Notificacao extends Controller
{
    public function notificar(Request $request)
    {
        $mensagem = $request->input('mensagem');

        if (is_string($mensagem)) {
        	(new \App\Gcm())->send($mensagem);
        }

        return redirect()->route('/'); 
    }
}