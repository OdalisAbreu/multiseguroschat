<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Discounts;
use App\Models\Insurance;
use App\Models\Invoices;
use App\Models\Price;
use App\Models\Service;
use App\Models\Vehicle_brands;
use App\Models\Vehicle_models;
use App\Models\Vehicle_type_tarif;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

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

        $seller = DB::table('insurances')
                    ->join('prices','prices.insurances_id','insurances.id')
                    ->join('vehicle_type_tarifs','vehicle_type_tarifs.id','prices.vehicle_type_id')
                    ->join('data_payment_gateway','insurances.id','data_payment_gateway.insurance_id')
                    ->join('payment_gateway', 'data_payment_gateway.payment_gateway_id', 'payment_gateway.id')
                    ->where([['insurances.activo', 'si'],['vehicle_type_tarifs.id',$car['tipo']]])
                    ->select('insurances.nombre AS insurace','prefijo', 'logo' , 'color' , 'priceThreeMonths AS tresmeses',
                     'priceSixMonths AS seismeses', 'priceTwelveMonths AS docemeses', 'vehicle_type_tarifs.nombre AS vehicle_type', 
                     'insurances.id AS insurances_id', 'vehicle_type_tarifs.id_serv AS servicios','payment_gateway.value AS payment_gateway'
                     ,'merchanttype', 'merchantnumber', 'merchantterminal','client_name', 'vehicle_type_id' )
                    ->get();
        return Inertia::render('Policy/index', [
            'car' => $car,
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
        $sericesId = '';
        $clente = Client::find($request->clien_id);
        $tipo = Vehicle_type_tarif::find($request->car['tipo']);
        $marca = Vehicle_brands::find($request->car['marca']);
        $modelo = Vehicle_models::find($request->car['modelo']);
        $price = Price::where([['insurances_id', $request->insurre['insurance_id']],['vehicle_type_id', $request->car['tipo']]])->get();
        foreach($serviciosActivos as $serviciosActivo){
            foreach($servicos as $servicio){
                if($servicio['id'] == $serviciosActivo){
                    $totalServicios = $totalServicios + $servicio['servicePrice'];
                    $service2 = array(
                        'serviceName' => $servicio['serviceName'],
                        'id' => $servicio['id'],
                        'servicePrice' => $servicio['servicePrice']
                    );
                    array_push($services, $service2);
                }
            }
        }
        //   return $services;
        if($request->policyTime == 'tresmeses'){
            $policyTime = '3 Meses';
            $time = 'priceThreeMonths';
        }elseif($request->policyTime == 'seismeses'){
            $policyTime = '6 Meses';
            $time = 'priceSixMonths';
        }else{
            $policyTime = '12 Meses';
            $time = 'priceTwelveMonths';
        }
        //$totalGeneral = $totalServicios + $request->seller[0][$time];
        $totalGeneral = $totalServicios + $price[0][$time];
        //Traer los coddigos de descuentos activos
        $codigosDescuento = Discounts::where('active','1')->get();
        
        return Inertia::render('Policy/approve', [
            'car' => $request->car,
            'tarifa' => $request->tarifa,
            'sellers' => $request->seller[0],
            'totalGeneral' => $totalGeneral,
            'policyTime' => $policyTime,
            'marca' => $marca['DESCRIPCION'],
            'tipo' => $tipo['nombre'],
            'modelo' => $modelo['descripcion'],
            'cliente' => $clente,
            'services' => $services,
            'insurre' => $request->insurre,
            'codigosDescuento' => $codigosDescuento
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

    public function services($insurresId, $vehId, Request $request){
       if ($request->policyTime == ''){
           return 'Debes seleccionar u tiempo de vigencia de la póliza ';
        }
        $tarifaServices = explode("-",$request->servicios);
        $services = array();
        $servicios = Service::all();
        foreach($tarifaServices as $service){
            foreach($servicios as $servicio){
                if($servicio['id'] == $service){
                    $service2 = array(
                        'serviceName' => $servicio['nombre'],
                        'servicePrice' => $servicio[$request->policyTime],
                        'id' => $servicio['id']
                    );
                    array_push($services, $service2);
                }
            }
        }
        $insurres = DB::table('insurances')
                    ->join('data_payment_gateway', 'insurances.id', 'data_payment_gateway.insurance_id')
                    ->where('insurances.id', $insurresId)
                    ->get();

        return Inertia::render('Policy/create', [
            'car' => $request->car,
           'tarifa' => $request->tarifa,
            'sellers' => $request->seller,
            'services' => $services,
            'policyTime' => $request->policyTime,
            'clien_id' => $request->clien_id,
            'insurres' => $insurres[0]
        ]);
    }
    public function test(Request $request){


        return json_decode($request);
    }
}
