<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PriceCOntroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices =  DB::table('prices as P')
            ->select('P.id as id', 'I.nombre as aseguradora', 'I.id as aseguradoraId', 'VTT.veh_tipo as tipoDeVehiculoId', 'VTT.nombre as tipoDeVehiculo', 'VTT.activo as state', 'VTT.placas', 'priceThreeMonths', 'priceSixMonths', 'priceTwelveMonths', 'DanosPropiedadAjena', 'ResponsabilidadCivil', 'ResponsabilidadCivil2', 'UnaPersona', 'FianzaJudicial')
            ->join('vehicle_type_tarifs as VTT', 'VTT.id', '=', 'P.vehicle_type_id')
            ->join('insurances as I', 'I.id', '=', 'P.insurances_id')
            ->where('I.activo', 'si')
            ->get();
        //relacionar con insurance

        return $prices;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Price::create([
            'insurances_id' => $request->insurances_id,
            'vehicle_type_id' => $request->vehicle_type_id,
            'priceThreeMonths' => $request->priceThreeMonths,
            'priceSixMonths' => $request->priceSixMonths,
            'priceTwelveMonths' => $request->priceTwelveMonths,
            'DanosPropiedadAjena' => $request->DanosPropiedadAjena,
            'ResponsabilidadCivil' => $request->ResponsabilidadCivil,
            'ResponsabilidadCivil2' => $request->ResponsabilidadCivil2,
            'UnaPersona' => $request->UnaPersona,
            'FianzaJudicial' => $request->FianzaJudicial
        ]);
        //validar si se creo correctamente
        if (Price::all()) {
            return response()->json([
                'success' => true,
                'message' => 'Se guardo correctamente'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No se guardo correctamente'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resultado = DB::table('prices as P')
            ->select('P.id as id', 'I.nombre as aseguradora', 'VTT.nombre as tipoDeVehiculo', 'priceThreeMonths', 'priceSixMonths', 'priceTwelveMonths', 'DanosPropiedadAjena', 'ResponsabilidadCivil', 'ResponsabilidadCivil2', 'UnaPersona', 'FianzaJudicial')
            ->join('vehicle_type_tarifs as VTT', 'VTT.id', '=', 'P.vehicle_type_id')
            ->join('insurances as I', 'I.id', '=', 'P.insurances_id')
            ->where('P.id', $id)
            ->get();

        return $resultado;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $price = Price::find($id);
        if (!$price) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró el precio con el ID proporcionado'
            ], 404);
        }
        $updated = $price->update($request->all());
        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'Se editó correctamente'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $price = Price::find($id);
        $price->delete();
    }
}
