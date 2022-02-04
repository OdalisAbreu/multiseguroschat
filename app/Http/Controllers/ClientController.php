<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
        //
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
        $token = Http::post('http://multiseguros.com.do:5000/api/User/Authenticate',[
            'username' => 'sendiu_desarrollo',
            'password' => 'dev1234'
        ]);
        sleep(1);
        $token = $token->json();
        $seller = Http::withToken($token['token'])->get('http://multiseguros.com.do:5000/api/Seguros/InsuranceCarrier');

       $seller = $seller->json();

       $string = array("-"," ");
       $phone = str_replace($string,"",$phone); // Quita los espacios en blanco y los guiones

       // Falta validar si tiene 1

        $client = Client::where('phonenumber', $phone)->first();

        if($client){
            return Inertia::render('Clients/Index', [
                'client' => $client,
                'token' => $token,
                'sellers' => $seller
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

    public function seller(Request $request){

        $token = $request['token'];

            $tipos = Http::withToken($token)->get('http://multiseguros.com.do:5000/api/Seguros/Make');
            $tipos = $tipos->json();

            $marcas = Http::withToken($token)->get('http://multiseguros.com.do:5000/api/Seguros/Make');
            $marcas = $marcas->json();

            $modelos = Http::withToken($token)->get('http://multiseguros.com.do:5000/api/Seguros/Model');
            $modelos = $modelos->json();

            return Inertia::render('Vehiculo/index', [
                'tipos' => $tipos,
                'marcas' => $marcas,
                'modelos' => $modelos,
                'token' => $token
            ]);

    }
}
