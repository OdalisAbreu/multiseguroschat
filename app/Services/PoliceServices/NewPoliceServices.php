<?php

namespace App\Services\PoliceServices;

use App\Models\Client;
use App\Models\Invoices;
use App\Models\ProvisionalErrorPolicies;
use App\Services\Respond\RespondService;
use Exception;
use Illuminate\Support\Facades\Log;

class NewPoliceServices
{
    public $invoices;
    public $respond;
    public $client;

    public function __construct(Invoices $invoices)
    {
        $this->invoices = $invoices;
        $this->respond =  new RespondService();
        $this->client = Client::find($invoices->client_id);
    }

    public function generatePolice()
    {
        if (substr($this->client->phonenumber, 0, 1) == 1) {
            $phonenumber = substr($this->client->phonenumber, 1);
        } else {
            $phonenumber = $this->client->phonenumber;
        }

        $date = date_create($this->invoices->policyInitDate);
        $policyInitDate = date_format($date, 'Y-m-d');
        $servises = json_decode($this->invoices->services);
        $servicio = implode('-', $servises);

        $json = array(
            'usuario' => 'sendiu_desarrollo',
            'clave' => 'Admin1234',
            'xID' => "102054-" . $this->invoices->AuthorizationCode,
            'nombres' => strtoupper($this->client->name),
            'apellidos' => strtoupper($this->client->lastname),
            'cedula' => $this->client->cardnumber,
            'pasaporte' => strtoupper($this->client->passportnumber),
            'telefono1' => $phonenumber,
            'email' => $this->client->email,
            'direccion' => $this->client->adrress,
            'ciudad' => $this->client->city,
            'nacionalidad' => '',
            'tipo' => $this->invoices->car_tipe,
            'marca' => $this->invoices->car_brand,
            'modelo' => $this->invoices->car_model,
            'year' => $this->invoices->year,
            'chassis' => strtoupper($this->invoices->chassis),
            'placa' => strtoupper($this->invoices->licensePlate),
            'aseguradora' => $this->invoices->sellers_id,
            'fecha_inicio' => $policyInitDate,
            'serv_adc' => $servicio,
            'vigencia_poliza' => $this->invoices->policyTime,
            'total' => round($this->invoices->totalGeneral),
            'plan' => '1',
        );
        Log::info("peticion de poliza -> clientId: " . $this->invoices->client_id, [$json]);
        $consultPolice =  $this->postpolice($json);
        $newPolice = $this->validateStatusPolice($consultPolice);

        if ($newPolice->status != "00") {
            Log::info("peticion de poliza sin procesar -> clientId: " . $$this->invoices->client_id, [$consultPolice]);
            return;
        }
        $this->invoices->police_number = $newPolice->insurancePolicyNumber;
        $this->invoices->police_transactionId = $newPolice->transactionId;
        $this->invoices->save();
        return $newPolice;
    }

    private function postpolice($json)
    {
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
            sleep(5);
            return $response;
        } catch (Exception $e) {
            Log::error("Error al Generar Poliza:  " . $e);
            // $this->respond->AddTagContact('18294428902', 'errorEnviarPoliza');
            // $this->respond->enviarMensaje('18294428902', 'text', '*ERROR AL GENERAR POLIZA* para el cliente Id: ' . $this->invoices->client_id . ' *FAVOR DE VERIFICAR EL ERROR*');
            // $this->respond->enviarMensaje($this->client->phonenumber, 'text', 'Estamos validando sus Datos por favor espere un momento');
        }
    }

    private function validateStatusPolice($response)
    {

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
            Log::info("peticion de poliza sin procesar -> clientId: " . $$this->invoices->client_id, [$response]);
            $errorPlice = new ProvisionalErrorPolicies();
            $errorPlice->invoice_id = $$this->invoices->id;
            $errorPlice->petition = json_encode($json);
            $errorPlice->error = $response;
            $errorPlice->save();

            $this->respond->AddTagContact('18294428902', 'errorEnviarPoliza');
            $this->respond->enviarMensaje('18294428902', 'text', '*ERROR AL GENERAR POLIZA POR MS/SCH 2* para el cliente Id: ' . $invoices->client_id . ' *FAVOR DE VERIFICAR EL ERROR*');
            $this->respond->enviarMensaje($client[0]->phonenumber, 'text', 'Estamos validando sus Datos por favor espere un momento');
            $poliza = [
                'status' => 10,
                'message' => $response,
            ];
            $poliza = (object) $poliza;
        }
        return $poliza;
    }
}