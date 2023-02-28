<?php

namespace App\Http\Controllers;

use App\Models\Discounts;
use App\Models\Invoices;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function visaNet(Request $request){
        $codigo = Discounts::where([['code',$request->descuento],['active', 1]])->get();
        return $codigo[0]->id;
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
        $invoice->discount_id = $codigo[0]->id;
        $invoice->payment_status = 'peding';
        $invoice->save();

        //------------------------- Toma los parametros para crear signature para procesar el pago --------------------------------------
        $params = [
            "access_key"=>"444844d8ec5b36acbad80fefbdc8e4b0",
            "profile_id"=>"D0151565-28A7-4113-8F9B-402D4491B59E",
            "transaction_uuid"=>'bot2022'.$invoice->id,
            "signed_field_names"=>"merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data30,access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,override_custom_cancel_page,override_custom_receipt_page",
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

            return Inertia::render('Payment/visaNet', [
                'total' => $request->totalGeneral,
                'invoice_id' => $invoice->id,
                'client_id' => $invoice->client_id,
                'signature' => $signature,
                'urlreturn' => $urlReturn,
                'date' => gmdate("Y-m-d\TH:i:s\Z"),
            ]);
    }
//----------------------------------------------------------------------------------------------------------------------------------------------
    public function cardNet(Request $request){
        $codigo = 0 ;
        if($request->descuento != ''){
            $value = Discounts::where([['code',$request->descuento],['active', 1]])->count();
            
            if($value == 0){
                $codigo = 0 ;
            }else{
                $value = Discounts::where([['code',$request->descuento],['active', 1]])->get();
                $codigo = $value[0]->id;
            }
        }
        
        $urlReturn = 'https://seguroschat.com/api/statusPayment';
        $servicios = [];
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
        $invoice->sellers_id = $request->insurre['insurance_id'];;
        $invoice->car_tipe = $request->car['tipo'];
        $invoice->car_brand = $request->car['marca'];
        $invoice->car_model = $request->car['modelo'];
        $invoice->client_id = $request->cliente['cardnumber'];
        $invoice->services = $serviciosString;
        $invoice->discount_id = $codigo;
        $invoice->payment_status = 'peding';
        $invoice->save();
        //return $request->cliente['name'];
        return Inertia::render('Payment/cardnet', [
            'total' => $request->totalGeneral,
            'invoice_id' => $invoice->id,
            'client_id' => $invoice->client_id,
            'urlreturn' => $urlReturn,
            'date' => gmdate("Y-m-d\TH:i:s\Z"),
            'tax' => '0', 
            'merchanttype' => $request->insurre['merchanttype'],
            'merchantnumber' => $request->insurre['merchantnumber'],
            'merchantterminal'=> $request->insurre['merchantterminal'],
            'client_name'=> $request->cliente['name'],
            'transactionid' => $invoice->id,
            'paymentUrl' => $request->insurre['payment_url'],
            'clientip' => $_SERVER['REMOTE_ADDR']
        ]);

    }
}
