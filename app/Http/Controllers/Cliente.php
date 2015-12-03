<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Cliente extends Controller
{
    public function register(Request $request)
    {
        try {
            $id = $request->input('id');
            $exec = DB::table('Cliente')->insertGetId(
                ['RegistrationId' => $id]
            );
            return response()->json(['id' => $exec]);
        } catch (\Exception $e) {
            return response()->json(['Erro' => $e->getMessage()]);
        }
    }
}