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
        $car = array(
            'tipo' => $request->tipo,
            'modelo' => $request->modelo,
            'marca' => $marcaid,
            'placa' => $request->placa,
            'chasis' => $request->chasis,
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
            'sellers' => $seller,
            'clien_id' => $request->clien_id,
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
    public function show(Request $request)
    {
        $serviciosActivos = $request->servicios;
        $servicos = $request->services;
        $totalServicios = 0;
        $token = $request->token;
        echo $request->clien_id;
        exit();

        $marca = Http::withToken($token)->get('http://multiseguros.com.do:5050/api/Seguros/Make/'.$request->car['marca']);
        $marca = $marca->json();
    //   echo $marca['makeName'];

        $modeloMarca = Http::withToken($token)->get('http://multiseguros.com.do:5050/api/Seguros/Model/Make/'.$request->car['marca']);
        $modeloMarca = $modeloMarca->json();


        $tipo = Http::withToken($token)->get('http://multiseguros.com.do:5050/api/Seguros/VehicleType/'.$request->car['tipo']);
        $tipo = $tipo->json();
   //     echo $tipo['vehicleTypeName'];

        foreach($modeloMarca as $modelos){
            if($modelos['id'] == $request->car['modelo']){
                $modelo = $modelos['modelName'];
            }
        }


        foreach($serviciosActivos as $serviciosActivo){
            foreach($servicos as $servicio){
               if($servicio['id'] == $serviciosActivo){
                   $totalServicios = $totalServicios + $servicio['servicePrice'];
               }
            }
        }
        $totalGeneral = $totalServicios + $request->tarifa[$request->policyTime];
        if($request->policyTime == 'threeMonths'){
            $policyTime = '3 Meses';
        }elseif($request->policyTime == 'sixMonths'){
            $policyTime = '6 Meses';
        }else{
            $policyTime = '12 Meses';
        }

        return Inertia::render('Policy/approve', [
            'car' => $request->car,
            'tarifa' => $request->tarifa,
            'token' => $request->token,
            'sellers' => $request->seller,
            'totalGeneral' => $totalGeneral,
            'policyTime' => $policyTime,
            'marca' => $marca['makeName'],
            'tipo' => $tipo['vehicleTypeName'],
            'modelo' => $modelo,
        ]);

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
                        'servicePrice' => $servicio[$request->policyTime],
                        'id' => $servicio['id']
                    );
                    array_push($services, $service2);
                }
            }
        }


        return Inertia::render('Policy/create', [
            'car' => $request->car,
            'tarifa' => $request->tarifa,
            'token' => $token,
            'sellers' => $request->seller,
            'services' => $services,
            'policyTime' => $request->policyTime,
            'clien_id' => $request->clien_id
        ]);

    }
}
