<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Client;
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

       return $client;

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
        if(is_null($client)){
            return ['status' => '01', 'message' => 'El cliente no se encuentra registrado'];
        }
        return $client;

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
}
