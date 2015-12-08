<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Cliente extends Controller
{
    public function index(Request $request)
    {
        $jsonObject = (object)$request->input('jsonObject_');

        if ($jsonObject->method == 'save-user') {
            $gcm = \App::make('App\GcmModel');
            $user = (object)$jsonObject->user;
            $gcm->registration_id = $user->registrationId;
            try {
                $result = $gcm->save();
            } catch (\Exception $e) {
                $result = false;
            }
        }

        return response()->json(
            [
                'result' => $result,
                'id' => '123568'
            ]
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
            $gcm = \App::make('App\GcmModel');
            $result = $gcm->all();
            $reg_id = [];

            foreach ($result as $value) {
                $reg_id[] = $value->registration_id;
            }

            return (new \App\Gcm())->enviar(
                $reg_id
            );
        }

        return [];
    }
}