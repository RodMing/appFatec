<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Cliente extends Controller
{
    public function index(Request $request)
    {
        $jsonObject = $request->input('jsonObject_');

        if ($jsonObject['method'] == 'save-user') {
            $gcm = \App::make('App\GcmModel');
            $gcm->registration_id = $jsonObject['user']['registrationId'];
            try {
                $result = $gcm->save();
            } catch (\Exception $e) {
                $result = false;
            }
        }

        return response()->json(
            [
                'result' => $result
            ]
        );
    }
}
