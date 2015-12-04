<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Notificacao extends Controller
{
    public function notificar(Request $request)
    {
        return $request->input('mensagem');
    }
}