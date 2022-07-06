<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Vehicle_brands;
use App\Models\Vehicle_models;
use App\Models\Vehicle_type_tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use PhpParser\Node\Stmt\TryCatch;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Esto no va
       $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJVc2VyTmFtZSI6InNlbmRpdV9kZXNhcnJvbGxvIiwibmJmIjoxNjU1NDgwODg5LCJleHAiOjE2NTYwODU2ODksImlhdCI6MTY1NTQ4MDg4OX0.z0KshbCzm9aQiFR7rDYp3sqJacbZ7R6aKZ6zcq2w8Ok';
        /*$token = Http::post('http://multiseguros.com.do:5050/api/User/Authenticate',[
            'username' => 'sendiu_desarrollo',
            'password' => 'Admin1234'
        ]);*/
        $tipos = Http::withToken($token)->get('http://multiseguros.com.do:5050/api/Seguros/VehicleType');
        $tipos = $tipos->json();

        $marcas = Http::withToken($token)->get('http://multiseguros.com.do:5050/api/Seguros/Make');
        $marcas = $marcas->json();

        $modelos = Http::withToken($token)->get('http://multiseguros.com.do:5050/api/Seguros/Model');
        $modelos = $modelos->json();

        return Inertia::render('Vehiculo/index', [
            'tipos' => $tipos,
            'marcas' => $marcas,
            'modelos' => $modelos,
            'token' => $token
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($phone)
    {

       $string = array("-"," ");
       $phone = str_replace($string,"",$phone); // Quita los espacios en blanco y los guiones

       // Falta validar si tiene 1

        $client = Client::where('phonenumber', $phone)->first();

        if($client){
            return Inertia::render('Clients/Edit', [
                'client' => $client,
            ]);

        }else{
            return 'No hay na';
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $request->validate([
            'name' => 'required'
        ]);

        $client = Client::find($id);
        $client->name = $request->name;
        $client->lastname = $request->lastname;
        $client->email = $request->email;
        $client->adrress = $request->adrress;
        $client->cardnumber = $request->cardnumber;
        $client->city = $request->city;
        $client->passportnumber = $request->passportnumber;
        $client->phonenumber = $request->phonenumber;
        $client->save();


        $tipos = Vehicle_type_tarif::all();
        $marcas = Vehicle_brands::all();
        $modelos = Vehicle_models::all();
       return Inertia::render('Vehiculo/index', [
            'tipos' => $tipos,
            'marcas' => $marcas,
            'modelos' => $modelos,
            'clien_id' => $id
        ]);

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

    public function seller(Request $request){

        $token = $request['token'];

            $tipos = Http::withToken($token)->get('http://multiseguros.com.do:5050/api/Seguros/Make');
            $tipos = $tipos->json();

            $marcas = Http::withToken($token)->get('http://multiseguros.com.do:5050/api/Seguros/Make');
            $marcas = $marcas->json();

            $modelos = Http::withToken($token)->get('http://multiseguros.com.do:5050/api/Seguros/Model');
            $modelos = $modelos->json();

            return Inertia::render('Vehiculo/index', [
                'tipos' => $tipos,
                'marcas' => $marcas,
                'modelos' => $modelos,
                'token' => $token
            ]);

    }
}
