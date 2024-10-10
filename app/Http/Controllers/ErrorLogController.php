<?php

namespace App\Http\Controllers;
use App\Models\ErrorLogs;


use Illuminate\Http\Request;

class ErrorLogController extends Controller
{
    public function store(Request $request)
    {    

        $errorLog = new ErrorLogs();
        $errorLog->clientId = $request->client['id'];
        $errorLog->clientName = $request->client['name'];
        $errorLog->clientLastname = $request->client['lastname'];
        $errorLog->clientCardnumber = $request->client['cardnumber'];
        $errorLog->clientPassportnumber = $request->client['passportnumber'];
        $errorLog->clientPhonenumber = $request->client['phonenumber'];
        $errorLog->clientEmail = $request->client['email'];
        $errorLog->clientConversacionId = $request->client['idConversacion'];
        $errorLog->tipoVehiculo = $request->tipo;
        $errorLog->modelo = $request->modelo;
        $errorLog->marca = $request->marca;
        $errorLog->vehicleYear = $request->year;
        $errorLog->placa = $request->placa;
        $errorLog->chasis = $request->chasis;
        $errorLog->error = $request->error;
        $errorLog->save();

        return response()->json(['message' => 'Datos Guardados correctamente','resp' => $errorLog],200);
         
    }
}