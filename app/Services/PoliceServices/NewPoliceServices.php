<?php

namespace App\Services\PoliceServices;

use App\Models\Client;
use App\Models\Discounts;
use App\Models\Invoices;
use App\Models\ProvisionalErrorPolicies;
use App\Services\Respond\RespondService;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewPoliceServices
{
    public $invoices;
    public $respond;
    public $client;

    public function __construct(Invoices $invoices)
    {
        $this->invoices = $invoices;
        $this->client = Client::find($invoices->client_id);
        $this->respond =  new RespondService($this->client->phonenumber);
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
        $newPolice = $this->validateStatusPolice($consultPolice, $this->client->phonenumber);

        if ($newPolice->status != "00") {
            Log::info("peticion de poliza sin procesar -> clientId: " . $this->invoices->client_id, [$consultPolice]);
            return;
        }
        $this->invoices->police_number = $newPolice->insurancePolicyNumber;
        $this->invoices->police_transactionId = $newPolice->transactionId;
        $this->invoices->save();

        if ($this->invoices->discount_id) {
            $this->descountCupon($this->invoices);
        }
        return $newPolice;
    }

    private function postpolice($json)
    {
        $url = env('URL_POLIZA') . '/Seguros/GET_Poliza_Total.php';
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
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
        }
    }

    private function validateStatusPolice($response, $phone)
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
            Log::info("peticion de poliza sin procesar -> clientId: " . $this->invoices->client_id, [$response]);
            $errorPlice = new ProvisionalErrorPolicies();
            $errorPlice->invoice_id = $this->invoices->id;
            $errorPlice->petition = json_encode(['error' => $response, 'phone' => $phone]);
            $errorPlice->error = $response;
            $errorPlice->save();

            $this->respond->AddTagContact('errorEnviarPoliza', '18294428902');
            //  $this->respond->enviarMensaje('18294428902', 'text', '*ERROR AL GENERAR POLIZA POR MS/SCH 2 *FAVOR DE VERIFICAR EL ERROR*');
            $this->respond->enviarMensaje('text', 'Estamos validando sus Datos por favor espere un momento');
            $poliza = [
                'status' => 10,
                'message' => $response,
            ];
            $poliza = (object) $poliza;
        }
        return $poliza;
    }

    private function descountCupon($invoice)
    {
        if ($invoice->discount_id != 0) {
            $descuento = Discounts::find($invoice->discount_id);
            $response = Http::withHeaders([
                'Accept' => '*/*',
                'User-Agent' => 'Thunder Client (https://www.thunderclient.com)',
            ])
                ->get('https://multiseguros.com.do/ws_schat/update_descount_code.php?transactionId=' . $invoice->police_transactionId . '&code=' . $descuento->code . '&value=' . $descuento->discount_amount);
        }
    }
}
