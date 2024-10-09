<?php

namespace App\Services\PoliceServices;

use App\Models\Client;
use App\Models\DataPaymentGateway as ModelsDataPaymentGateway;
use App\Models\Discounts;
use App\Models\Insurance;
use App\Models\Invoices;
use App\Models\Price;
use App\Models\Service;
use App\Models\Vehicle_brands;
use App\Models\Vehicle_models;
use App\Models\Vehicle_type_tarif;
use App\Services\Respond\RespondService;
use Carbon\Carbon;
use DataPaymentGateway;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RenewServices
{
    public function __construct() {}

    public function renew($invoiceID)
    {
        $services = array();
        $data = [];
        $car = [];
        $invoice = Invoices::find($invoiceID);
        $client = Client::find($invoice->client_id);
        $brand = Vehicle_brands::find($invoice->car_brand);
        $model = Vehicle_models::find($invoice->car_model);
        $type = Vehicle_type_tarif::find($invoice->car_tipe);
        $cuponCode = Discounts::where('active', '1')->get();
        $sellerPrice = Price::where([['insurances_id', $invoice->sellers_id], ['vehicle_type_id', $invoice->car_tipe]])->first();
        $sellerCardnetCredencial = ModelsDataPaymentGateway::where('insurance_id', $invoice->sellers_id)->first();
        $services = Service::where([['insurances_id', $invoice->sellers_id], ['activo', 'si']])->get();
        $seller = DB::table('insurances')
            ->join('prices', 'prices.insurances_id', 'insurances.id')
            ->join('vehicle_type_tarifs', 'vehicle_type_tarifs.id', 'prices.vehicle_type_id')
            ->join('data_payment_gateway', 'insurances.id', 'data_payment_gateway.insurance_id')
            ->join('payment_gateway', 'data_payment_gateway.payment_gateway_id', 'payment_gateway.id')
            ->where([['insurances.activo', 'si'], ['vehicle_type_tarifs.id', $invoice->car_tipe], ['insurances.id', $invoice->sellers_id]])
            ->select(
                'insurances.nombre AS insurace',
                'prefijo',
                'logo',
                'color',
                'priceThreeMonths AS tresmeses',
                'priceSixMonths AS seismeses',
                'priceTwelveMonths AS docemeses',
                'vehicle_type_tarifs.nombre AS vehicle_type',
                'insurances.id AS insurances_id',
                'vehicle_type_tarifs.id_serv AS servicios',
                'payment_gateway.value AS payment_gateway',
                'merchanttype',
                'merchantnumber',
                'merchantterminal',
                'client_name',
                'vehicle_type_id',
                'DanosPropiedadAjena',
                'ResponsabilidadCivil',
                'ResponsabilidadCivil2',
                'UnaPersona',
                'FianzaJudicial'
            )
            ->get();

        if ($invoice->policyTime == 3) {
            $policePrice = $sellerPrice->priceThreeMonths;
        } elseif ($invoice->policyTime == 6) {
            $policePrice = $sellerPrice->priceSixMonths;
        } else {
            $policePrice = $sellerPrice->priceTwelveMonths;
        }

        $car = [
            'brand' => $brand->DESCRIPCION,
            'model' => $model->descripcion,
            'type' => $type->nombre,
        ];
        if (env('APP_ENV') == 'production') {
            $data['payment_url'] = 'https://ecommerce.cardnet.com.do/authorize';
            $data['urlReturn'] = 'https://seguroschat.com/api/statusPayment';
        } else {
            $data['payment_url'] = 'https://lab.cardnet.com.do/authorize';
            $sellerCardnetCredencial['merchanttype'] = '7997';
            $sellerCardnetCredencial['merchantnumber'] =  '349000000';
            $sellerCardnetCredencial['merchantterminal'] = '58585858';
            $data['urlReturn'] = 'https://demo.seguroschat.com/api/statusPayment';
        }
        Log::debug('Paso a la vista De renovar poliza, Cliente: ' . $invoice['client_id']);
        $data['services'] = $services;
        $data['invoice'] = $invoice;
        $data['client'] = $client;
        $data['car'] = $car;
        $data['sellers'] = $seller;
        $data['sellerCardnetCredencial'] = $sellerCardnetCredencial;
        $data['cuponCode'] = $cuponCode;
        $data['policePrice'] = $policePrice;
        $data['clientIp'] = $_SERVER['REMOTE_ADDR'];

        return $data;
    }

    public function seePolicy($phone)
    {
        $client = Client::where('phonenumber', $phone)->first();

        // Verificar si el cliente existe
        if (!$client) {
            return [
                'polices' => [],
                'client' => null
            ];
        }

        $polices = Invoices::where('client_id', $client->id)
            ->whereNotNull('police_number')
            ->with('brand', 'model', 'type')
            ->orderBy('policyInitDate', 'asc')
            ->get();

        if ($polices->isEmpty()) {
            return [
                'polices' => [],
                'client' => $client
            ];
        }

        $data = [
            'polices' => $polices,
            'client' => $client
        ];
        return $data;
    }

    public function sendMessengerRenew()
    {
        set_time_limit(0);
        $expiredPolicies = $this->getExpiredPolicies();
        foreach ($expiredPolicies as $police) {
            $this->validateClientAdnSendMessage($police->client_id);
        }

        return $expiredPolicies;
    }

    private function getExpiredPolicies()
    {
        // Obtener la fecha actual
        $today = Carbon::now();

        // Calcular las fechas exactas a 3 días y 15 días desde hoy
        $threeDaysFromNow = $today->copy()->addDays(3)->format('Y-m-d');
        $fifteenDaysFromNow = $today->copy()->addDays(15)->format('Y-m-d');

        // Realizar la consulta con la condición de payment_status = "ACCEPT"
        $invoices = DB::table('invoices')
            ->select('*')
            ->where('payment_status', 'ACCEPT') // Asegurar que payment_status sea "ACCEPT"
            ->where(function ($query) use ($threeDaysFromNow, $fifteenDaysFromNow) {
                $query->whereRaw("
                DATE_ADD(DATE(policyInitDate), INTERVAL policyTime MONTH) = ?
            ", [$threeDaysFromNow])
                    ->orWhereRaw("
                DATE_ADD(DATE(policyInitDate), INTERVAL policyTime MONTH) = ?
            ", [$fifteenDaysFromNow]);
            })
            ->get();

        return $invoices;
    }

    private function validateClientAdnSendMessage($id)
    {
        $client = Client::find($id);
        $respondServices = new RespondService($client->phonenumber);
        $contact =  $respondServices->getContact();
        if ($contact->status() != 200) {
            $respondServices->createContact($client->name, $client->lastname);
        }
        Log::info("Envio nenovar Poliza: " . $client->phonenumber);
        $respondServices->AddTagContact('renovar_api', $client->phonenumber);
    }
}
