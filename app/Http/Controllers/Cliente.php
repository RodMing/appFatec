<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class Cliente extends Controller
{
    public function index(Request $request)
    {
        $metodo = $request->input('method');
        $regId = $request->input('reg-id');

        return response()->json(
            $this->call($metodo, $regId)
        );
    }

    private function call($metodo, $regId = '')
    {
        if (preg_match('/^(save-gcm-registration-id){1}$/', $metodo) && $regId) {
            return [
                'feedback' => (new AplGcm())
                    ->save(new GcmModel($regId))
            ];
        }

        if (preg_match('/^(send-gcm-message){1}$/', $metodo)) {
            // Enviar mensagem
            return (new Gcm())->enviar(
                (new AplGcm())->getAll()
            );
        }

        return [];
    }
}