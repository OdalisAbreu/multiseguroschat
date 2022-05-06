<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Carbon\Carbon;
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
            'year' => $request->year,
        );
        $token = $request->token;
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
        $servicios = [];
        $token = $request->token;
        if($request->policyTime == '3 Meses'){
            $policyTime = 3;
        }elseif($request->policyTime == '6 Meses'){
            $policyTime = 6;
        }else{
            $policyTime = 12;
        }

        foreach($request->services as $service){
            array_push($servicios, $service['id']);
        }


        $poliza = Http::withToken($token)->post('http://multiseguros.com.do:5050/api/Seguros/Policy', [
            'sellerInternalId' => '89',
            'policyStartDate' => Carbon::now(),
            'policyValidity' => $policyTime,
            'total' => $request->totalGeneral,
            'insuranceCarrierId' => $request->sellers['id'],
            'vehicle' => [
                "vehicleTypeId" => $request->car['tipo'],
                "vehicleMakeId" => $request->car['marca'],
                "vehicleModelId" => $request->car['modelo'],
                "year" => $request->car['year'],
                "chassis" => '"'.$request->car['chasis'].'"',
                "licensePlate" => '"'.$request->car['placa'].'"'
            ],
            'insured' => [
                "name" => '"'.$request->cliente['name'].'"',
                "lastName" => '"'.$request->cliente['lastname'].'"',
                "identificationCardNumber" => '"'.$request->cliente['cardnumber'].'"',
                "passportNumber" => '"'.$request->cliente['passportnumber'].'"',
                "emailAddress" => '"'.$request->cliente['email'].'"',
                "phoneNumber" => $request->cliente['phonenumber'],
                "residenceAddress" => '"'.$request->cliente['adrress'].'"',
                "cityOfResidence" => '"'.$request->cliente['city'].'"',
                "nationality" => ""
            ],
            'services' => $servicios,

        ]);
        $poliza = $poliza->json();

        return Inertia::render('end', [
            'cliente' => $request->cliente,
        ]);
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
        $services = array();
        $totalServicios = 0;
        $token = $request->token;

        $clente = Client::find($request->clien_id);

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
                   $service2 = array(
                    'serviceName' => $servicio['serviceName'],
                    'id' => $servicio['id']
                );
                array_push($services, $service2);
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
            'sellers' => $request->seller[0],
            'totalGeneral' => $totalGeneral,
            'policyTime' => $policyTime,
            'marca' => $marca['makeName'],
            'tipo' => $tipo['vehicleTypeName'],
            'modelo' => $modelo,
            'cliente' => $clente,
            'services' => $services
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
