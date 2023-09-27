<?php

namespace App\Http\Controllers;

use App\Models\Discounts;
use Illuminate\Http\Request;

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discounts  $discounts
     * @return \Illuminate\Http\Response
     */
    public function show(Discounts $discounts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discounts  $discounts
     * @return \Illuminate\Http\Response
     */
    public function edit(Discounts $discounts)
    {
        //
    }
    public function update(Request $request, Discounts $discounts)
    {
        //
    }

    public function destroy($id)
    {
        $discounts = Discounts::find($id);
        $discounts->delete();
        $codigos =  $this->index();
        return $codigos;
    }
}
