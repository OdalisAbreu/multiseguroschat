<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use Illuminate\Http\Request;

class PolicyRenewController extends Controller
{
    public function UpdatePolice(Request $request)
    {
        $newServicesString = json_encode($request->newServices);
        $newDate = date('Y-m-d\TH:i:s.u\Z', strtotime($request->invoice['policyInitDate'] . ' + 6 months'));
        //validar si $newDate es menor que la fecha actual 
        if ($newDate < date('Y-m-d\TH:i:s.u\Z')) {
            $newDate = date('Y-m-d\TH:i:s.u\Z');
        }
        $invoice = new Invoices();
        $invoice->chassis = strtoupper($request->invoice['chassis']);
        $invoice->licensePlate = strtoupper($request->invoice['licensePlate']);
        $invoice->year = $request->invoice['year'];
        $invoice->sellers_id = $request->invoice['sellers_id'];
        $invoice->car_brand = $request->invoice['car_brand'];
        $invoice->car_model = $request->invoice['car_model'];
        $invoice->car_tipe = $request->invoice['car_tipe'];
        $invoice->client_id = $request->invoice['client_id'];
        $invoice->payment_status = 'peding';
        $invoice->policyInitDate = $newDate;
        $invoice->services = $newServicesString;
        $invoice->policyTime = $request->time;
        $invoice->totalGeneral = $request->policePrice;
        $invoice->discount_id = $request->discount_id;
        $invoice->save();

        return $invoice;
    }
}
