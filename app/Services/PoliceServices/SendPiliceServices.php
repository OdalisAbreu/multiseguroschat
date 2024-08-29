<?php

namespace App\Services\PoliceServices;

use App\Models\Client;
use App\Models\Discounts;
use App\Models\Invoices;
use App\Services\Respond\RespondService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendPiliceServices
{
    private $urlBase;
    private $invoice;
    private $client;
    private $respondServices;

    public function __construct(Invoices $invoices)
    {
        $this->invoice = $invoices;
        $this->urlBase = env('URL_POLIZA');
        $this->client = Client::find($invoices->client_id);
        $this->respondServices = new RespondService($this->client->phonenumber);
    }

    public function handle()
    {
        $this->generarPdf($this->invoice->police_transactionId); //Genera la Póliza en el servidor para luego enviarla
        sleep(3);
        $this->UpdateDescuento($this->invoice->id);

        $this->respondServices->enviarMensaje('text', '¡Tu póliza está lista! Gracias por comprar en *SegurosChat*.🕐 _En breve estarás recibiendo tus documentos.._');
        $this->respondServices->enviarArchivoBotCitie('file', $this->urlBase . '/TareasProg/PDF/IMPRIMIR/' . $this->invoice->police_number . '.pdf');
        $this->respondServices->enviarArchivoBotCitie('file', $this->urlBase . '/TareasProg/PDF/IMPRIMIR/Terminos_Poliza.pdf');
        $this->confirmarPositivo($this->client->phonenumber);
    }
    public function generarPdf($idPoliza)
    {
        $url =  $this->urlBase . '/TareasProg/GenerarReporteAseguradoraPdfUnicoAuth.php';
        $response = Http::get($url, [
            'sms' => 0,
            'id_trans' => $idPoliza,
        ]);
        Log::info('generate pdf: ' . $response->body());
        return $response->body();
    }

    public function UpdateDescuento($invoicesId)
    {
        $invoice = Invoices::find($invoicesId);

        if ($invoice->discount_id != 0) {
            $descuento = Discounts::find($invoice->discount_id);
            $response = Http::withHeaders([
                'Accept' => '*/*',
                'User-Agent' => 'Thunder Client (https://www.thunderclient.com)',
            ])
                ->get($this->urlBase .  '/update_descount_code.php?transactionId=' . $invoice->police_transactionId . '&code=' . $descuento->code . '&value=' . $descuento->discount_amount);
        }
    }
    public function confirmarPositivo($phone)
    {
        $url = 'https://hooks.chatapi.net/workflows/ZECOvvRxmADK/KeeNFnOgboZP';

        $response = Http::post($url, [
            'phone' => $phone
        ]);
        return $response->body();

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://hooks.chatapi.net/workflows/ZECOvvRxmADK/KeeNFnOgboZP',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => '{
        //                                 "phone":"' . $phone . '"
        //                             }
        //                 ',
        //     CURLOPT_HTTPHEADER => array(
        //         'Content-Type: application/json'
        //     ),
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        // echo $response;
    }
}
