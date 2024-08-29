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
use App\Services\PoliceServices\NewPoliceServices;
use App\Services\PoliceServices\SendPiliceServices;
use App\Services\Respond\RespondService;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Opcodes\LogViewer\Logs\Log as LogsLog;
use phpDocumentor\Reflection\Types\Resource_;
use phpDocumentor\Reflection\Types\This;

use function PHPUnit\Framework\isNull;
use function Psy\debug;

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
        Log::debug("Entro en la funcion statusPaymentCardNet");
        //-----------------Consulta las tablas para generar las polizas----------------
        $invoices = Invoices::find($request->TransactionID);
        $seller = Insurance::find($invoices['sellers_id']);
        $client = Client::find($invoices->client_id);
        //---------------------------------------------------------------------------------

        // Validar que la seccion esta activa
        if (env('APP_ENV') == 'production') {
            if ($client->session == 'I') {
                return Inertia::render('index');
            }
        }
        $urlBase = env('MULTISEGUROS_URL');

        // if (env('APP_ENV') != 'production') {
        //     $urlBase = "https://multiseguros.com.do/DemoSegurosChat";
        // }
        $marcas = Vehicle_brands::find($invoices->car_brand);
        $marca = $marcas->DESCRIPCION;
        $modelos = Vehicle_models::find($invoices->car_model);
        $modelo = $modelos->descripcion;
        $tipo = Vehicle_type_tarif::find($invoices->car_tipe);

        Log::debug("Paso a la vista Final");

        return Inertia::render('end', [
            'ResponseCode' => $request->ResponseCode,
            'TransactionID' => $request->TransactionID,
            'RemoteResponseCode' => $request->RemoteResponseCode,
            'AuthorizationCode' => $request->AuthorizationCode,
            'RetrivalReferenceNumber' => $request->RetrivalReferenceNumber,
            'TxToken' =>  $request->TxToken,
            'transactionId' => $invoices['police_transactionId'],
            'logo' => $seller['logo'],
            'Poliza' => $invoices['police_number'],
            'Client' => $client,
            'Marca' => $marca,
            'urlBase' => $urlBase,
            'Modelo' => $modelo,
            'Aseguradora' => $seller['nombre'],
            'invoice' => $invoices,
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
        }
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
        // ------------------ GENERAR POLIZA ------------------
        $newPoliceServices = new NewPoliceServices($invoice);
        $newPoliceServices->generatePolice();
        //-----------------------------------------------------

        // -------------------- Envia la Poliza al cliente ------------------
        $sendPilicesServices = new SendPiliceServices($invoice);
        $sendPilicesServices->handle();
        //--------------------------------------------------------------------

        return Inertia::render('Welcome', [
            'ResponseCode' => $request->ResponseCode,
            'TransactionID' => $request->TransactionID,
            'RemoteResponseCode' => $request->RemoteResponseCode,
            'AuthorizationCode' => $request->AuthorizationCode,
            'RetrivalReferenceNumber' => $request->RetrivalReferenceNumber,
            'TxToken' =>  $request->TxToken
        ]);
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
