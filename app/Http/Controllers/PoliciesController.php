<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Http\Request;

class PoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $marcaid)
    {
        /*$car = array(
            'tipo' => $request->tipo,
            'modelo' => $request->modelo,
            'marca' => $marcaid,
            'placa' => $request->placa,
            'chasis' => $request->chasis,
        );*/
        $car = array(
            'tipo' => 2,
            'modelo' => 3,
            'marca' => "1",
            'placa' => "A101010101",
            'chasis' => "1231658164",
        );

       // $token = $request->token;
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJVc2VyTmFtZSI6InBhZ29zX3Rpdm9fZGVzIiwibmJmIjoxNjUxMTk5MTI4LCJleHAiOjE2NTE4MDM5MjgsImlhdCI6MTY1MTE5OTEyOH0.AmC6rqFtfk7UUpVGMNm7IZPtNPLOwEPAW78i17mKW1g';
        $tarifa = Http::withToken($token)->get('http://multiseguros.com.do:5050/api/Seguros/Tariff/'.$car['tipo']);
        $tarifa = $tarifa->json();

        $seller = Http::withToken($token)->get('http://multiseguros.com.do:5050/api/Seguros/InsuranceCarrier');
        $seller = $seller->json();

        return Inertia::render('Policy/index', [
            'car' => $car,
            'tarifa' => $tarifa,
            'token' => $token,
            'sellers' => $seller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function services(Request $request){
        $tarifaServices = $request->tarifa['availableServices'];
        $services = array();
        $token = $request->token;

        $servicios = Http::withToken($token)->get('http://multiseguros.com.do:5050/api/Seguros/Service');
        $servicios = $servicios->json();

        foreach($tarifaServices as $service){
            foreach($servicios as $servicio){
                if($servicio['id'] == $service){
                    $service2 = array(
                        'serviceName' => $servicio['serviceName'],
                        'policyTime' => $servicio[$request->policyTime],
                        'id' => $servicio['id']
                    );
                    array_push($services, $service2);
                }
            }
        }
        var_dump($services);

    }
}
