<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Discounts;
use App\Models\Invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

use function PHPUnit\Framework\isNull;

class InvoicesController extends Controller
{
    public function statusPaymentVisaNet(Request $request)
    {
        $invoiceId = $request->req_reference_number;


        if ($request->decision == 'ACCEPT') {
            $invoices = Invoices::find($invoiceId);
            $client = Client::where('cardnumber', $invoices->client_id)->get();
            $respuesta = 'Pago procesado de manera correcta';
            $token = Http::post('http://multiseguros.com.do:5050/api/User/Authenticate', [
                'username' => 'sendiu_desarrollo',
                'password' => 'Admin1234'
            ]);
            sleep(2);
            $token = $token->json();

            $name = $client[0]->name;
            $lastname = $client[0]->lastname;
            $cardnumber = $client[0]->cardnumber;
            $passportnumber = $client[0]->passportnumber;
            $email = $client[0]->email;
            $phonenumber = $client[0]->phonenumber;
            $adrress = $client[0]->adrress;
            $city = $client[0]->city;


            $servicio = json_decode($invoices->services);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://multiseguros.com.do:5050/api/Seguros/Policy',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                                        "sellerInternalId": "102054-' . $invoices->id.'",
                                        "vehicle": {
                                            "vehicleTypeId": '.$invoices->car_tipe.',
                                            "vehicleMakeId": '.$invoices->car_brand.',
                                            "vehicleModelId": '.$invoices->car_model.',
                                            "year": '.$invoices->year.',
                                            "chassis": "'.$invoices->chassis.'",
                                            "licensePlate": "'.$invoices->licensePlate.'"
                                        },
                                        "insured": {
                                            "name": "'.$name.'",
                                            "lastName": "'.$lastname.'",
                                            "identificationCardNumber": "'.$cardnumber.'",
                                            "passportNumber": "'.$passportnumber.'",
                                            "emailAddress": "'.$email.'",
                                            "phoneNumber": '.$phonenumber.',
                                            "residenceAddress": "'.$adrress.'",
                                            "cityOfResidence": "'.$city .'",
                                            "nationality": ""
                                        },
                                        "insuranceCarrierId": 4,
                                        "services":  '.$invoices->services.',
                                        "policyStartDate": "'.gmdate("Y-m-d\TH:i:s\Z").'",
                                        "policyValidity": '.$invoices->policyTime.',
                                    }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$token['token'],
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $poliza = json_decode($response);
            sleep(1);
            
            $invoice = Invoices::find($invoiceId);
            $invoice->payment_status = $request->decision;
            $invoice->tranf_number = $request->req_transaction_uuid;
            $invoice->card_type = $request->card_type_name;
            $invoice->transaction_id = $request->transaction_id;
            $invoice->transaction_ip = $request->score_device_fingerprint_true_ipaddress;
            $invoice->payment_messeger = $request->message;
            $invoice->auth_trans_ref_no = $request->auth_trans_ref_no;
            $invoice->police_number = $poliza->insurancePolicyNumber;
            $invoice->police_transactionId = $poliza->transactionId;
            $invoice->update();

            return Inertia::render('end', [
                'cliente' => $client[0],
                'invoice' => $invoices
            ]);
        } else {
            $respuesta = $request->message;
            echo 'transacción Cancelada';
        }
    }

    public function statusPaymentCardNet(Request $request){
 
       //-----------------Consulta las tablas para generar las polizas----------------
        $invoices = Invoices::find($request->TransactionID);
        $client = Client::where('cardnumber', $invoices->client_id)->get();
      //---------------------------------------------------------------------------------
      //----------------Generar Token----------------------------------------------------
        $token = Http::post('http://multiseguros.com.do:5050/api/User/Authenticate', [
            'username' => 'sendiu_desarrollo',
            'password' => 'Admin1234'
        ]);
        sleep(2);
        $token = $token->json();
       //------------------------------------------------------------------------------

       //--------Procesar Poliza ----------------------------------------------
        $name = $client[0]->name;
        $lastname = $client[0]->lastname;
        $cardnumber = $client[0]->cardnumber;
        $passportnumber = $client[0]->passportnumber;
        $email = $client[0]->email;
        $phonenumber = $client[0]->phonenumber;
        $adrress = $client[0]->adrress;
        $city = $client[0]->city;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://multiseguros.com.do:5050/api/Seguros/Policy',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                                    "sellerInternalId": "102054-' . $invoices->id.'",
                                    "vehicle": {
                                        "vehicleTypeId": '.$invoices->car_tipe.',
                                        "vehicleMakeId": '.$invoices->car_brand.',
                                        "vehicleModelId": '.$invoices->car_model.',
                                        "year": '.$invoices->year.',
                                        "chassis": "'.$invoices->chassis.'",
                                        "licensePlate": "'.$invoices->licensePlate.'"
                                    },
                                    "insured": {
                                        "name": "'.$name.'",
                                        "lastName": "'.$lastname.'",
                                        "identificationCardNumber": "'.$cardnumber.'",
                                        "passportNumber": "'.$passportnumber.'",
                                        "emailAddress": "'.$email.'",
                                        "phoneNumber": '.$phonenumber.',
                                        "residenceAddress": "'.$adrress.'",
                                        "cityOfResidence": "'.$city .'",
                                        "nationality": ""
                                    },
                                    "insuranceCarrierId": 4,
                                    "services":  '.$invoices->services.',
                                    "policyStartDate": "'.gmdate("Y-m-d\TH:i:s\Z").'",
                                    "policyValidity": '.$invoices->policyTime.'
                                }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.$token['token'],
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $poliza = json_decode($response);
        sleep(1);

    //-----------------------------------------------------------------------------------------

    //----------------Actualizar Factura---------------------------------------

            $invoice = Invoices::find($request->TransactionID);
            $invoice->payment_status = $request->ResponseCode;
            $invoice->tranf_number = $request->req_transaction_uuid;
            $invoice->transaction_id = $request->TransactionID;
            $invoice->RemoteResponseCode = $request->RemoteResponseCode;
            $invoice->AuthorizationCode = $request->AuthorizationCode;
            $invoice->RetrivalReferenceNumber = $request->RetrivalReferenceNumber;
            $invoice->TxToken =  $request->RetrivalReferenceNumber;
            $invoice->police_number = $poliza->insurancePolicyNumber;
            $invoice->police_transactionId = $poliza->transactionId;
            $invoice->update();
    //--------------------------------------------------------------------------------------------
  
    //--------------------Desactivar Descuento----------------------------------------------------
        if($invoice->discount_id != ''){
            $descuento = Discounts::find($invoice->discount_id);
            $descuento->active = 0;
            $descuento->update();
            return $descuento;
        }
    //-------------------------------------------------------------------------------------------
    return $invoice;
         /*   echo 'ResponseCode:'. $request->ResponseCode. '<br/>';
            echo 'TransactionID:'. $request->TransactionID. '<br/>';
            echo 'RemoteResponseCode:'. $request->RemoteResponseCode. '<br/>';
            echo 'AuthorizationCode:'. $request->AuthorizationCode. '<br/>';
            echo 'RetrivalReferenceNumber:'. $request->RetrivalReferenceNumber. '<br/>';
            echo 'TxToken:'. $request->TxToken. '<br/>';*/

        return Inertia::render('end', [
            'ResponseCode' => $request->ResponseCode,
            'TransactionID' => $request->TransactionID,
            'RemoteResponseCode' => $request->RemoteResponseCode,
            'AuthorizationCode' => $request->AuthorizationCode,
            'RetrivalReferenceNumber'=> $request->RetrivalReferenceNumber,
            'TxToken'=>  $request->TxToken
        ]);
    }
}