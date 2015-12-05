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
            $gcm = \App::make('App\GcmModel');
            $gcm->registration_id = $regId;

            try {
                $result = $gcm->save();
            } catch (\Exception $e) {
                $result = false;
            }

            return [
                'feedback' => $result
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