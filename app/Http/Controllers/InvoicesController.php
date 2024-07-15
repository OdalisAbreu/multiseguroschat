<?php

namespace App\Http\Controllers;

use App\Models\AccesToken;
use App\Models\Client;
use App\Models\Discounts;
use App\Models\Insurance;
use App\Models\Invoices;
use App\Models\ProvisionalErrorPolicies;
use App\Models\Vehicle_brands;
use App\Models\Vehicle_models;
use App\Models\Vehicle_type_tarif;
use App\Services\InvoicesServices;
use App\Services\Respond\RespondService;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use phpDocumentor\Reflection\Types\Resource_;

use function PHPUnit\Framework\isNull;

class InvoicesController extends Controller
{
    protected $invoice;
    protected $url;
    public function __construct(InvoicesServices $invoice)
    {
        $this->invoice = $invoice;
        $this->url = 'http://multiseguros.com.do:5050';
    }
    public function statusPaymentVisaNet(Request $request)
    {
        $url = 'http://multiseguros.com.do:5050';
        $invoiceId = $request->req_reference_number;

        if ($request->decision == 'ACCEPT') {
            $invoices = Invoices::find($invoiceId);
            $client = Client::where('cardnumber', $invoices->client_id)->get();
            $respuesta = 'Pago procesado de manera correcta';
            $token = Http::post($this->url . '/api/User/Authenticate', [
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
                CURLOPT_URL => $this->url . '/api/Seguros/Policy',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                                        "sellerInternalId": "102054-' . $invoices->id . '",
                                        "vehicle": {
                                            "vehicleTypeId": ' . $invoices->car_tipe . ',
                                            "vehicleMakeId": ' . $invoices->car_brand . ',
                                            "vehicleModelId": ' . $invoices->car_model . ',
                                            "year": ' . $invoices->year . ',
                                            "chassis": "' . $invoices->chassis . '",
                                            "licensePlate": "' . $invoices->licensePlate . '"
                                        },
                                        "insured": {
                                            "name": "' . $name . '",
                                            "lastName": "' . $lastname . '",
                                            "identificationCardNumber": "' . $cardnumber . '",
                                            "passportNumber": "' . $passportnumber . '",
                                            "emailAddress": "' . $email . '",
                                            "phoneNumber": ' . $phonenumber . ',
                                            "residenceAddress": "' . $adrress . '",
                                            "cityOfResidence": "' . $city . '",
                                            "nationality": ""
                                        },
                                        "insuranceCarrierId": ' . $invoices->sellers_id . ',
                                        "services":  ' . $invoices->services . ',
                                        "policyStartDate": "' . $invoices->policyInitDate . '",
                                        "policyValidity": ' . $invoices->policyTime . ',
                                    }',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $token['token'],
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $poliza = json_decode($response);
            sleep(1);

            return $poliza;



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

    public function statusPaymentCardNet(Request $request)
    {
        //-----------------Consulta las tablas para generar las polizas----------------
        $invoices = Invoices::find($request->TransactionID);
        $seller = Insurance::find($invoices['sellers_id']);
        $client = Client::where('id', $invoices->client_id)->get();
        $respond =  new RespondService;

        //---------------------------------------------------------------------------------

        // Validar que la seccion esta activa
        if (env('APP_ENV') == 'production') {
            if ($client[0]->session == 'I') {
                return Inertia::render('index');
            }
        }
        $urlBase = "https://multiseguros.com.do/SegurosChat";

        if (env('APP_ENV') != 'production') {
            $urlBase = "https://multiseguros.com.do/DemoSegurosChat";
        }


        //--------Procesar Poliza ----------------------------------------------
        $name = $client[0]->name;
        $lastname = $client[0]->lastname;
        $cardnumber = $client[0]->cardnumber;
        $passportnumber = $client[0]->passportnumber;
        $email = $client[0]->email;
        if (substr($client[0]->phonenumber, 0, 1) == 1) {
            $phonenumber = substr($client[0]->phonenumber, 1);
        } else {
            $phonenumber = $client[0]->phonenumber;
        }
        $adrress = $client[0]->adrress;
        $city = $client[0]->city;

        $marcas = Vehicle_brands::find($invoices->car_brand);
        $marca = $marcas->DESCRIPCION;
        $modelos = Vehicle_models::find($invoices->car_model);
        $modelo = $modelos->descripcion;
        $tipo = Vehicle_type_tarif::find($invoices->car_tipe);
        $servises = json_decode($invoices->services);
        $servicio = implode('-', $servises);
        //convertir de $invoices->policyInitDate a yyyy-mm-dd
        $date = date_create($invoices->policyInitDate);
        $policyInitDate = date_format($date, 'Y-m-d');

        $json = array(
            'usuario' => 'sendiu_desarrollo',
            'clave' => 'Admin1234',
            'xID' => "102054-$request->AuthorizationCode",
            'nombres' => strtoupper($name),
            'apellidos' => strtoupper($lastname),
            'cedula' => $cardnumber,
            'pasaporte' => strtoupper($passportnumber),
            'telefono1' => $phonenumber,
            'email' => $email,
            'direccion' => $adrress,
            'ciudad' => $city,
            'nacionalidad' => '',
            'tipo' => $invoices->car_tipe,
            'marca' => $invoices->car_brand,
            'modelo' => $invoices->car_model,
            'year' => $invoices->year,
            'chassis' => strtoupper($invoices->chassis),
            'placa' => strtoupper($invoices->licensePlate),
            'aseguradora' => $invoices->sellers_id,
            'fecha_inicio' => $policyInitDate,
            'serv_adc' => $servicio,
            'vigencia_poliza' => $invoices->policyTime,
            'total' => round($invoices->totalGeneral),
            'plan' => '1',
        );
        Log::info("peticion de poliza -> clientId: " . $invoices->client_id, [$json]);
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => env('URL_POLIZA'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $json,
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            sleep(3);
            $parts = explode('/', $response);
            if ($parts[0] == '00') {
                $poliza = [
                    'status' => $parts[0],
                    'message' => $parts[1],
                    'transactionId' => $parts[2],
                    'fecha' => $parts[3],
                    'insurancePolicyNumber' => $parts[4],
                ];
                $poliza = (object) $poliza;
            } else {
                Log::info("peticion de poliza sin procesar -> clientId: " . $invoices->client_id, [$response]);
                $errorPlice = new ProvisionalErrorPolicies();
                $errorPlice->invoice_id = $invoices->id;
                $errorPlice->petition = json_encode($json);
                $errorPlice->error = $response;
                $errorPlice->save();

                $respond->AddTagContact('18294428902', 'errorEnviarPoliza');
                $this->enviarMensaje('18294428902', 'text', '*ERROR AL GENERAR POLIZA POR MS/SCH 2* para el cliente Id: ' . $invoices->client_id . ' *FAVOR DE VERIFICAR EL ERROR*');
                $this->enviarMensaje($client[0]->phonenumber, 'text', 'Estamos validando sus Datos por favor espere un momento');

                return Inertia::render('end', [
                    'ResponseCode' => $request->ResponseCode,
                    'TransactionID' => $request->TransactionID,
                    'RemoteResponseCode' => $request->RemoteResponseCode,
                    'AuthorizationCode' => $request->AuthorizationCode,
                    'RetrivalReferenceNumber' => $request->RetrivalReferenceNumber,
                    'TxToken' =>  $request->TxToken,
                    'urlBase' => $urlBase,
                    'transactionId' => 00,
                    'logo' => $seller['logo'],
                    'Poliza' => 00,
                    'Client' => $client[0],
                    'Marca' => $marca,
                    'Modelo' => $modelo,
                    'Aseguradora' => $seller['nombre'],
                    'invoice' => $invoices,
                    'tipo' => $tipo
                ]);
            }
            Log::info("peticion de poliza -> clientId: " . $invoices->client_id, [$poliza]);
        } catch (\Exception $e) {
            Log::error("Generar poliza -> clientId: " . $invoices->client_id, ['error' => $e->getMessage()]);
            $respond->AddTagContact('18294428902', 'errorEnviarPoliza');
            $this->enviarMensaje('18294428902', 'text', '*ERROR AL GENERAR POLIZA* para el cliente Id: ' . $invoices->client_id . ' *FAVOR DE VERIFICAR EL ERROR*');
            // $this->enviarMensaje('18092092008', 'text', '*ERROR AL GENERAR POLIZA* para el cliente Id: ' . $invoices->client_id . ' *FAVOR DE VERIFICAR EL ERROR*');
            $this->enviarMensaje($client[0]->phonenumber, 'text', 'Estamos validando sus Datos por favor espere un momento');
            return Inertia::render('end', [
                'ResponseCode' => $request->ResponseCode,
                'TransactionID' => $request->TransactionID,
                'RemoteResponseCode' => $request->RemoteResponseCode,
                'AuthorizationCode' => $request->AuthorizationCode,
                'RetrivalReferenceNumber' => $request->RetrivalReferenceNumber,
                'TxToken' =>  $request->TxToken,
                'transactionId' => 00,
                'logo' => $seller['logo'],
                'Poliza' => 00,
                'Client' => $client[0],
                'Marca' => $marca,
                'urlBase' => $urlBase,
                'Modelo' => $modelo,
                'Aseguradora' => $seller['nombre'],
                'invoice' => $invoices,
                'tipo' => $tipo
            ]);
        }

        //-----------------------------------------------------------------------------------------

        //----------------Actualizar Factura---------------------------------------


        $invoice = Invoices::find($request->TransactionID);
        $invoice->police_number = $poliza->insurancePolicyNumber;
        $invoice->police_transactionId = $poliza->transactionId;
        $invoice->update();

        //--------------------------------------------------------------------------------------------


        return Inertia::render('end', [
            'ResponseCode' => $request->ResponseCode,
            'TransactionID' => $request->TransactionID,
            'RemoteResponseCode' => $request->RemoteResponseCode,
            'AuthorizationCode' => $request->AuthorizationCode,
            'RetrivalReferenceNumber' => $request->RetrivalReferenceNumber,
            'TxToken' =>  $request->TxToken,
            'transactionId' => $poliza->transactionId,
            'logo' => $seller['logo'],
            'Poliza' => $poliza->insurancePolicyNumber,
            'Client' => $client[0],
            'Marca' => $marca,
            'urlBase' => $urlBase,
            'Modelo' => $modelo,
            'Aseguradora' => $seller['nombre'],
            'invoice' => $invoice,
            'tipo' => $tipo
        ]);
    }

    /*  public function getInvoice($policeId){
        return 'Hola'; 
    }*/

    public function waitingRoom(Request $request)
    {
        $estatus = '';
        if ($request->ResponseCode != '00') {

            Log::alert("Declined Pago", [
                'ResponseCode' => $request->ResponseCode,
                'TransactionID' => $request->TransactionID,
                'RemoteResponseCode' => $request->RemoteResponseCode,
                'AuthorizationCode' => $request->AuthorizationCode,
                'RetrivalReferenceNumber' => $request->RetrivalReferenceNumber,
                'TxToken' =>  $request->TxToken
            ]);
            $invoice = Invoices::find($request->TransactionID);
            $invoice->payment_status = 'DECLINED';
            $invoice->payment_messeger = $request->ResponseCode;
            $invoice->transaction_id = $request->TransactionID;
            $invoice->RemoteResponseCode = $request->RemoteResponseCode;
            $invoice->AuthorizationCode = $request->AuthorizationCode;
            $invoice->RetrivalReferenceNumber = $request->RetrivalReferenceNumber;
            $invoice->TxToken =  $request->TxToken;
            $invoice->update();

            return Inertia::render('error', [
                'ResponseCode' => $request->ResponseCode,
                'TransactionID' => $request->TransactionID,
                'RemoteResponseCode' => $request->RemoteResponseCode,
                'AuthorizationCode' => $request->AuthorizationCode,
                'RetrivalReferenceNumber' => $request->RetrivalReferenceNumber,
                'TxToken' =>  $request->TxToken
            ]);
        } else {

            Log::info("Success Pago", [
                'ResponseCode' => $request->ResponseCode,
                'TransactionID' => $request->TransactionID,
                'RemoteResponseCode' => $request->RemoteResponseCode,
                'AuthorizationCode' => $request->AuthorizationCode,
                'RetrivalReferenceNumber' => $request->RetrivalReferenceNumber,
                'TxToken' =>  $request->TxToken
            ]);

            $invoice = Invoices::find($request->TransactionID);
            $invoice->payment_status = 'ACCEPT';
            $invoice->payment_messeger = $request->ResponseCode;
            $invoice->transaction_id = $request->TransactionID;
            $invoice->RemoteResponseCode = $request->RemoteResponseCode;
            $invoice->AuthorizationCode = $request->AuthorizationCode;
            $invoice->RetrivalReferenceNumber = $request->RetrivalReferenceNumber;
            $invoice->TxToken =  $request->TxToken;
            $invoice->update();

            return Inertia::render('Welcome', [
                'ResponseCode' => $request->ResponseCode,
                'TransactionID' => $request->TransactionID,
                'RemoteResponseCode' => $request->RemoteResponseCode,
                'AuthorizationCode' => $request->AuthorizationCode,
                'RetrivalReferenceNumber' => $request->RetrivalReferenceNumber,
                'TxToken' =>  $request->TxToken
            ]);
        }

        $invoice = Invoices::find($request->TransactionID);
        $invoice->payment_status = $estatus;
        $invoice->payment_messeger = $request->ResponseCode;
        $invoice->transaction_id = $request->TransactionID;
        $invoice->RemoteResponseCode = $request->RemoteResponseCode;
        $invoice->AuthorizationCode = $request->AuthorizationCode;
        $invoice->RetrivalReferenceNumber = $request->RetrivalReferenceNumber;
        $invoice->TxToken =  $request->TxToken;
        $invoice->update();
    }

    public function aplicarDescuento($id, $descuento_id, $totalGeneral) //VISTA 5 APLICAR DESCUENTO
    {
        $invoice = Invoices::find($id);
        $invoice->totalGeneral = $totalGeneral;
        $invoice->discount_id = $descuento_id;
        $invoice->save();

        Log::info("Decuento", ["invoice_id" => $id, "discount_id" => $descuento_id, "totalGeneral" => $totalGeneral]);
    }
    public function getInvoices(Request $request)
    {
        $invoice = $this->invoice->getInvoices($request);
        return $invoice;
    }
    public function getInvoice($id)
    {
        $invoice = $this->invoice->getInvoice($id);
    }

    public function enviarMensaje($phone, $type, $text)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.respond.io/v2/contact/phone:+' . $phone . '/message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                                        "message": {
                                                        "type": "' . $type . '",
                                                        "text": "' . $text . '"
                                                    }
                                    }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTgyMywic3BhY2VJZCI6MTQ3NDAxLCJvcmdJZCI6MjAzNDYsInR5cGUiOiJhcGkiLCJpYXQiOjE2ODI1Mzc0MTZ9.dsECELGyYJd9XF_PkkM-W8W-qUPnow3VdFeHnM2XiSo'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
}
