<?php

namespace App\Http\Controllers;

use App\Models\AccesToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AccesTokenController extends Controller
{
    public function generateToken()
    {

        $url = 'http://multiseguros.com.do:5050';

        try {
            //----------------Generar Token----------------------------------------------------
            $token = Http::post($url . '/api/User/Authenticate', [
                'username' => 'sendiu_desarrollo',
                'password' => 'Admin1234'
            ]);
            sleep(2);
            $token = $token->json();
            //------------------------------------------------------------------------------
        } catch (\Exception $e) {
            $error = $e->getMessage();
            Log::error("Generar token  ", ['error' => $error]);
            try {
                //----------------Generar Token----------------------------------------------------
                $token = Http::post($url . '/api/User/Authenticate', [
                    'username' => 'sendiu_desarrollo',
                    'password' => 'Admin1234'
                ]);
                sleep(2);
                $token = $token->json();
                //------------------------------------------------------------------------------
            } catch (\Exception $e) {
                $error = $e->getMessage();
                Log::error("Generar token 2 ", ['error' => $error]);
                $this->enviarMensaje('18294428902', 'text', '*ERROR AL GENERAR TOKEN Automatico* ');
            }
        }

        //Guardar en access_token
        AccesToken::create(['token' => $token['token']]);
        Log::debug("Token generado: ", ['token' => $token['token']]);
        //retornar un estatus ok
        return response()->json(['status' => 'ok'], 200);
    }
}
