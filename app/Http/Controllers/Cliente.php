<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Cliente extends Controller
{
    public function index(Request $request)
    {
        $jsonObject = json_decode(json_encode($request->all()));
        \Log::info(
            json_encode($jsonObject)
        );
        $jsonObject = json_decode($jsonObject->jsonObject_, true);
        $jsonObject['user'] = array_values($jsonObject['user']);
        
        if ($jsonObject['method'] == 'save-user') {
            $gcm = \App::make('App\GcmModel');
            $gcm->registration_id = $jsonObject['user'][1];
            try {
                $result = $gcm->save();
                $id = (string)$gcm->id;
            } catch (\Exception $e) {
                $result = false;
                $id = (string)'';
            }
            \Log::info(
                json_encode($result)
            );
            dd($result);
            return response()->json(
                [
                    'id' => $id,
                    'result' => "{'id':$id, 'registrationId': $gcm->registration_id}"
                ]
            );
        }
        return response()->json(false);
    }
}
