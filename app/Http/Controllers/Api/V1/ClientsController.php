<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Invoices;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $client = new Client();
       $client->name = $request->name;
       $client->lastname = $request->lastname;
       $client->cardnumber = $request->cardnumber;
       $client->passportnumber = $request->passportnumber;
       $client->phonenumber = $request->phonenumber;
       $client->adrress = $request->adrress;
       $client->city = $request->city;
       $client->email = $request->email;
       $client->save();

       if($client){
            return ['status' => '00', 'message' => 'Usuario creado correctamente'];
        }else{
            return ['status' => '01', 'message' => 'No tiene póliza registrada'];
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::where('cardnumber', $id)->first();
        if($client){
            return [
                    'status' => '00', 
                    'id' => $client->id,
                    'name' => $client->name,
                    'lastname' => $client->lastname,
                    'cardnumber' => $client->cardnumber,
                    'passportnumber' => $client->passportnumber,
                    'phonenumber' => $client->phonenumber,
                    'adrress' => $client->adrress,
                    'city' => $client->city,
                    'email' => $client->email,
                  ];
        }else{
            return ['status' => '01', 'message' => 'El cliente no se encuentra registrado'];
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }

    public function clientPilicy($cedula)
    {
        $invoince = Invoices::where([['client_id', $cedula],['payment_status', 'ACCEPT']])->get()->last();

        if($invoince){
            return ['status' => '00', 'url' => 'https://multiseguros.com.do/Seg_V2Dev/Admin/Sist.Administrador/Revisiones/Imprimir/Accion/Imprimir.php?polizaNum='.$invoince->police_number];
        }else{
            return ['status' => '01', 'message' => 'No tiene póliza registrada'];
        }
    }



}
