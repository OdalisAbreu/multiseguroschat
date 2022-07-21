<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Insurance;
use App\Models\Invoices;
use App\Models\Service;
use App\Models\Vehicle_brands;
use App\Models\Vehicle_models;
use App\Models\Vehicle_type_tarif;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Js;

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
        $tarifa = Vehicle_type_tarif::find($car['tipo']);
        $seller = Insurance::where('activo', 'si')->get();
        return Inertia::render('Policy/index', [
            'car' => $car,
            'tarifa' => $tarifa,
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
        $urlReturn = 'https://multiseguros.botpropanel.com/api/statusPayment';
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
        $serviciosString = json_encode($servicios); //transforma los id de los servicios para guardarlos en la Base de Datos 


        $invoice = new Invoices();
        $invoice->policyTime = $policyTime;
        $invoice->chassis = $request->car['chasis'];
        $invoice->licensePlate = $request->car['placa'];
        $invoice->year = $request->car['year'];
        $invoice->totalGeneral = $request->totalGeneral;
        $invoice->sellers_id = $request->sellers['id'];
        $invoice->car_tipe = $request->car['tipo'];
        $invoice->car_brand = $request->car['marca'];
        $invoice->car_model = $request->car['modelo'];
        $invoice->client_id = $request->cliente['cardnumber'];
        $invoice->services = $serviciosString;
        $invoice->payment_status = 'peding';
        $invoice->save();

        //------------------------- Toma los parametros para crear signature para procesar el pago --------------------------------------
        $params = [
            "access_key"=>"444844d8ec5b36acbad80fefbdc8e4b0",
            "profile_id"=>"D0151565-28A7-4113-8F9B-402D4491B59E",
            "transaction_uuid"=>'bot2022'.$invoice->id,
            "signed_field_names"=>"access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,override_custom_cancel_page,override_custom_receipt_page,merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data29,merchant_defined_data30",
            "unsigned_field_names"=>"",
            "signed_date_time"=>gmdate("Y-m-d\TH:i:s\Z"),
            "locale"=>"es",
            "override_custom_cancel_page"=>$urlReturn,
            "override_custom_receipt_page"=>$urlReturn,
            "transaction_type"=>"authorization",
            "reference_number"=>$invoice->id,
            "amount"=>$request->totalGeneral,
            "currency"=>"DOP",
            "submit"=>"Submit",
            "merchant_defined_data1"=> 'Retail',
            "merchant_defined_data2"=> 'visanetdr_000000432438001',
            "merchant_defined_data3"=> 'Web',
            "merchant_defined_data29"=> 'Cedula',
            "merchant_defined_data30"=> $invoice->client_id
        ];
        //------------------------------------------------------------------------------------------------------------------------------------------

        //---------------------------------Proceso para redirigir a la URL de pago Visanet-------------------------------------------------------
            define ('HMAC_SHA256', 'sha256');
            define ('SECRET_KEY', '01ff20172fb94c3d83f8a291f296755d0f6004adddbf44d4b31e55cffb13d99e5a800080fb5849ce84746d349aa51a83e564e92f81f24badb20f606027fbf9efef7df7cda3a643d4ba78bf6572cf3d91f57089e137b348dea09a705870807716c150b0e3a8dc4e288527209d3d90c7649f680f8b6da44ecfbf943785b812d524');

            function sign ($params) {
            return signData(buildDataToSign($params), SECRET_KEY);
            }

            function signData($data, $secretKey) {
                return base64_encode(hash_hmac('sha256', $data, $secretKey, true));
            }

            function buildDataToSign($params) {
                    $signedFieldNames = explode(",",$params["signed_field_names"]);
                    foreach ($signedFieldNames as $field) {
                    $dataToSign[] = $field . "=" . $params[$field];
                    }
                    return commaSeparate($dataToSign);
            }

            function commaSeparate ($dataToSign) {
                return implode(",",$dataToSign);
            }
            
            $signature = sign($params);

            return Inertia::render('Payment/index', [
                'total' => $request->totalGeneral,
                'invoice_id' => $invoice->id,
                'client_id' => $invoice->client_id,
                'signature' => $signature,
                'urlreturn' => $urlReturn,
                'date' => gmdate("Y-m-d\TH:i:s\Z"),
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
        $sericesId = '';
        $clente = Client::find($request->clien_id);
        $tipo = Vehicle_type_tarif::find($request->car['tipo']);
        $marca = Vehicle_brands::find($request->car['marca']);
        $modelo = Vehicle_models::find($request->car['modelo']);
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
        if($request->policyTime == 'tresmeses'){
            $policyTime = '3 Meses';
        }elseif($request->policyTime == 'seismeses'){
            $policyTime = '6 Meses';
        }else{
            $policyTime = '12 Meses';
        }
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
        
        $tarifaServices = explode("-",$request->tarifa['id_serv']);
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

        return Inertia::render('Policy/create', [
            'car' => $request->car,
            'tarifa' => $request->tarifa,
            'sellers' => $request->seller,
            'services' => $services,
            'policyTime' => $request->policyTime,
            'clien_id' => $request->clien_id
        ]);

    }

    public function test(Request $request){


        return json_decode($request);
    }
}
