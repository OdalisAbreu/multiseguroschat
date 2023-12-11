<?php

namespace App\Http\Controllers;

use App\Models\Discounts;
use App\Models\Invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codigosDescuento = Discounts::all();
        return $codigosDescuento;
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
        $codigo = new Discounts();
        $codigo->code = $request->code;
        $codigo->discount_amount = $request->discount_amount;
        $codigo->active = 1;
        $codigo->save();

        $codigos = Discounts::all();
        return $codigos;
    }

    public function destroy($id)
    {
        $discounts = Discounts::find($id);
        $discounts->delete();
        $codigos =  $this->index();
        return $codigos;
    }
    public function UpdateDescuento($id)
    {
        $invoice = Invoices::find($id);

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
