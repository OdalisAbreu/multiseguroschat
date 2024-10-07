<?php

namespace App\Http\Controllers;
use App\Models\BlockedClient;

use Illuminate\Http\Request;

class BlockedClientController extends Controller
{
    public function SavePhoneNumber(Request $request){

        if (BlockedClient::where('phoneNumber', $request->phonenumber)->exists()) {
            
            return response()->json(['message' => 'Ya este numero esta bloqueado'],200);
        }

        $blockedClient = new BlockedClient();
        $blockedClient->phoneNumber = $request->phonenumber;
        $blockedClient->save();
        return response()->json(['message' => 'Datos Guardados correctamente','resp'],200);
    }

    public function IsRestricted(Request $request){

        if (BlockedClient::where('phoneNumber', $request->phonenumber)->exists()) {
            
            return response()->json(true,200);
        }
        return response()->json(false,200);
    }

}
