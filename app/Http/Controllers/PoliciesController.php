<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Discounts;
use App\Models\Insurance;
use App\Models\Invoices;
use App\Models\Price;
use App\Models\Service;
use App\Models\Vehicle_brands;
use App\Models\Vehicle_models;
use App\Models\Vehicle_type_tarif;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Return_;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class PoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $marcaid) //Vista 2 Vehiculos
    {
        // $tipo = '';
        // $tipoName = '';
        // $modelo = '';
        // $modeloName = '';
        // $marca = '';
        // $marcaName = '';
        //return $request->modelos;
        // Si llegan string no realiza la búsqueda del nombre porque ya viene en la variable base
        if (!is_string($request->tipo)) {
            foreach ($request->tipos as $tipo) {
                if ($tipo['id'] == $request->tipo) {
                    $tipoName = $tipo['nombre'];
                    break;
                }
            }
        } else {
            $tipoName = $request->tipo;
        }
        if (!is_string($request->modelo)) {
            foreach ($request->modelos as $modelo) {
                if ($modelo['ID'] == $request->modelo) {
                    $modeloName = $modelo['descripcion'];
                    break;
                }
            }
        } else {
            $modeloName = $request->modelo;
        }

        foreach ($request->marcas as $marca) {
            if ($marca['DESCRIPCION'] == $marcaid) {
                $marcaName = $marca['DESCRIPCION'];
                $marcaid = $marca['ID'];
                break;
            } else {
                $marcaName = $marca['DESCRIPCION'];
            }
        }
        //Validar si el valor de tipo, modelo y marca viene del edit, para poder porcesar el ID de cada uno
        if (is_int($request->tipo) and is_int($marcaid) and is_int($request->modelo)) {
            $car = array(
                'tipo' => $request->tipo,
                'tipoName' => $tipoName,
                'marca' => $marcaid,
                'marcaName' => $marcaName,
                'modelo' => $request->modelo,
                'modeloName' => $modeloName,
                'placa' => $request->placa,
                'chasis' => $request->chasis,
                'year' => $request->year,
            );
        } else {
            $car = array(
                'tipo' => '',
                'tipoName' => $tipoName,
                'marca' => '',
                'marcaName' => $marcaName,
                'modelo' => '',
                'modeloName' => $modeloName,
                'placa' => $request->placa,
                'chasis' => $request->chasis,
                'year' => $request->year,
            );

            if (is_string($request->tipo)) {
                foreach ($request->tipos as $tipo) {
                    if ($tipo['nombre'] == $request->tipo) {
                        $car['tipo'] = $tipo['id'];
                        break;
                    }
                };
            } else {
                $car['tipo'] = $request->tipo;
            }
            if (is_string($marcaid)) {
                foreach ($request->marcas as $marca) {
                    if ($marca['DESCRIPCION'] == $marcaid) {
                        $car['marcaName'] = $marcaid;
                        $car['marca'] = $marca['ID'];
                        break;
                    }
                }
            }
            if (is_string($request->modelo)) {
                foreach ($request->modelos as $modelo) {
                    if ($modelo['descripcion'] == $request->modelo) {
                        $car['modelo'] = $modelo['ID'];
                        break;
                    }
                }
            }
        }
        $seller = DB::table('insurances')
            ->join('prices', 'prices.insurances_id', 'insurances.id')
            ->join('vehicle_type_tarifs', 'vehicle_type_tarifs.id', 'prices.vehicle_type_id')
            ->join('data_payment_gateway', 'insurances.id', 'data_payment_gateway.insurance_id')
            ->join('payment_gateway', 'data_payment_gateway.payment_gateway_id', 'payment_gateway.id')
            ->where([['insurances.activo', 'si'], ['vehicle_type_tarifs.id', $car['tipo']]])
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
        Log::info("Vehiculo -> clientId: " . $request->client['id'], [$car]);
        return Inertia::render('Policy/index', [
            'car' => $car,
            'sellers' => $seller,
            'clien_id' => $request->client['id'],
            'cities' => $request->cities,
            'provinces' => $request->provinces,
            'clientProvince' => $request->clientProvince,
            'client' => $request->client,
            'tipos' => $request->tipos,
            'modelos' => $request->modelos,
            'marcas' => $request->marcas,
            'clientepais' => $request->clientepais,
            'paises' => $request->paises
        ]);
    }

    public function  show(Request $request) //VISTA 4 SERVICIOS
    {
        //Log::debug($request->json());
        $services = array();
        $totalServicios = 0;
        $tipo = Vehicle_type_tarif::where('nombre', $request->car['tipoName'])->first();
        $marca = Vehicle_brands::where('DESCRIPCION', $request->car['marcaName'])->first();
        $modelo = Vehicle_models::where([['descripcion', $request->car['modeloName']], ['IDMARCA', $marca['ID']]])->first();
        $price = Price::where([['insurances_id', $request->insurre['insurance_id']], ['vehicle_type_id', $request->car['tipo']]])->get();



        foreach ($request->servicios as $serviciosActivo) {
            foreach ($request->services as $servicio) {
                if ($servicio['id'] == $serviciosActivo) {
                    $totalServicios = $totalServicios + $servicio['servicePrice'];
                    array_push($services, $servicio);
                }
            }
        }
        if ($request->policyTime == 'tresmeses' or $request->policyTime == 3) {
            $policyTime = '3 Meses';
            $time = 'priceThreeMonths';
            $policyTime = 3;
        } elseif ($request->policyTime == 'seismeses' or $request->policyTime == 6) {
            $policyTime = '6 Meses';
            $time = 'priceSixMonths';
            $policyTime = 6;
        } else {
            $policyTime = '12 Meses';
            $time = 'priceTwelveMonths';
            $policyTime = 12;
        }
        //$totalGeneral = $totalServicios + $request->seller[0][$time];
        $totalGeneral = $totalServicios + $price[0][$time];
        //********************************************************************************

        $codigosDescuento = Discounts::where('active', '1')->get();
        $urlReturn = 'https://seguroschat.com/api/statusPayment';
        Log::info("URL -> clientId: " . $request->client['id'], ["urlReturn" => $urlReturn]);
        $servicios = [];
        foreach ($services as $service) {
            array_push($servicios, $service['id']);
        }
        $serviciosString = json_encode($servicios); //transforma los id de los servicios para guardarlos en la Base de Datos 
        //Buscar si hay algun proceso de compra inconcluso
        //return $request->date;
        $invoice =  Invoices::where([['client_id', $request->client['id']], ['payment_status', 'pending']])->first();
        if ($invoice) {
            $invoice = Invoices::find($invoice->id);
            $invoice->policyTime = $policyTime;
            $invoice->chassis = $request->car['chasis'];
            $invoice->licensePlate = $request->car['placa'];
            $invoice->year = $request->car['year'];
            $invoice->totalGeneral = $totalGeneral;
            $invoice->sellers_id = $request->insurre['insurance_id'];;
            $invoice->car_tipe = $request->car['tipo'];
            $invoice->car_brand = $request->car['marca'];
            $invoice->car_model = $request->car['modelo'];
            $invoice->client_id = $request->client['id'];
            $invoice->services = $serviciosString;
            $invoice->discount_id = 0;
            $invoice->payment_status = 'pending';
            $invoice->policyInitDate = $request->date;
            $invoice->update();
        } else {
            $invoice = new Invoices();
            $invoice->policyTime = $policyTime;
            $invoice->chassis = $request->car['chasis'];
            $invoice->licensePlate = $request->car['placa'];
            $invoice->year = $request->car['year'];
            $invoice->totalGeneral = $totalGeneral;
            $invoice->sellers_id = $request->insurre['insurance_id'];;
            $invoice->car_tipe = $request->car['tipo'];
            $invoice->car_brand = $request->car['marca'];
            $invoice->car_model = $request->car['modelo'];
            $invoice->client_id = $request->client['id'];
            $invoice->services = $serviciosString;
            $invoice->discount_id = 0;
            $invoice->payment_status = 'pending';
            $invoice->policyInitDate = $request->date;
            $invoice->save();
        }
        Log::info("Servicios -> clientId: " . $request->client['id'], [$services]);
        $insurre = $request->insurre;
        if (env('APP_ENV') != 'production') {
            $insurre['merchanttype'] = '7997';
            $insurre['merchantnumber'] =  '349000000';
            $insurre['merchantterminal'] = '58585858';
            $insurre['payment_url'] = 'https://lab.cardnet.com.do/authorize';
        }
        return Inertia::render('Policy/edit', [
            'car' => $request->car,
            'tarifa' => $request->tarifa,
            'sellers' => $request->sellers,
            'seller' => $request->sellers[0],
            'totalGeneral' => $totalGeneral,
            'policyTime' => $policyTime,
            'marca' => $marca['DESCRIPCION'],
            'tipo' => $tipo['nombre'],
            'modelo' => $modelo['descripcion'],
            'cliente' => $request->client,
            'service' => $services,
            'services' => $request->services,
            'insurre' => $insurre,
            'client' => $request->client,
            'tipos' => $request->tipos,
            'modelos' => $request->modelos,
            'marcas' => $request->marcas,
            'polizaValor' => $request->polizaValor,
            'clientProvince' => $request->clientProvince,
            'provinces' => $request->provinces,
            'cities' => $request->cities,
            'clientepais' => $request->clientepais,
            'paises' => $request->paises,
            'costoPoliza' => $price[0][$time],
            //-----------------------------------------------------
            'codigosDescuento' => $codigosDescuento,
            'total' => $totalGeneral,
            'urlreturn' => $urlReturn,
            'date' => $request->date,
            'tax' => '0',
            'invoice_id' => $invoice->id,
            'clientip' => $_SERVER['REMOTE_ADDR']
        ]);
    }

    public function confirm(Request $request)
    {
        //Traer los coddigos de descuentos activos
        $codigosDescuento = Discounts::where('active', '1')->get();
        return Inertia::render('Policy/approve', [
            'car' => $request->car,
            'tarifa' => $request->tarifa,
            'sellers' => $request->seller,
            'services' => $request->services,
            'policyTime' => $request->policyTime,
            'marca' => $request->marca,
            'totalGeneral' => $request->totalGeneral,
            'tipo' => $request->tipo,
            'modelo' => $request->modelo,
            'cliente' => $request->client,
            'insurre' => $request->insurre,
            'client' => $request->client,
            'tipos' => $request->tipos,
            'marcas' => $request->marcas,
            'modelos' => $request->modelos,
            'codigosDescuento' => $codigosDescuento,
            'clientepais' => $request->clientepais,
            'paises' => $request->paises,
            'service' => $request->service
        ]);
    }


    public function services($insurresId, $time, Request $request) //VISTA 3 ASEGURADORA
    {
        $plazo = '';
        if ($time == '') {
            return 'Debes seleccionar un tiempo de vigencia de la póliza ';
        }
        $tarifaServices = explode("-", $request->servicios);
        $services = array();
        $servicios = Service::where([['insurances_id', $insurresId], ['activo', 'si']])->get();
        if ($time == 'tresmeses') {
            $plazo = '3 meses';
        }
        if ($time == 'seismeses') {
            $plazo = '6 meses';
        }
        if ($time == 'docemeses') {
            $plazo = '12 meses';
        }
        // return $servicios;
        // foreach ($tarifaServices as $service) {
        foreach ($servicios as $servicio) {
            $service2 = array(
                'serviceName' => $servicio['nombre'],
                'servicePrice' => $servicio[$time],
                'id' => $servicio['id'],
                'time' => $plazo
            );
            array_push($services, $service2);
        }
        //  }
        // return $services;
        $insurres = DB::table('insurances')
            ->join('data_payment_gateway', 'insurances.id', 'data_payment_gateway.insurance_id')
            ->where('insurances.id', $insurresId)
            ->get();
        foreach ($request->seller as $seller) {
            if ($seller['insurances_id'] == $insurresId) {
                $polizaValor = $seller[$time];
            }
        }
        Log::info("Aseguradora -> clientId: " . $request->clien_id, ["Aseguradora" => $insurres[0]->nombre, "Poliza" => $polizaValor, "policyTime" => $time]);
        Log::debug($request->car);
        return Inertia::render('Policy/create', [
            'car' => $request->car,
            'sellers' => $request->seller,
            'services' => $services,
            'policyTime' => $time,
            'clien_id' => $request->clien_id,
            'insurres' => $insurres[0],
            'client' => $request->client,
            'tipos' => $request->tipos,
            'marcas' => $request->marcas,
            'modelos' => $request->modelos,
            'car' => $request->car,
            'polizaValor' => $polizaValor,
            'cities' => $request->cities,
            'provinces' => $request->provinces,
            'clientProvince' => $request->clientProvince,
            'clientepais' => $request->clientepais,
            'paises' => $request->paises,
            'date' => $request->date
        ]);
    }
    public function carReturn(Request $request)
    {
        Log::debug($request->car);
        Log::debug($request->marcas);
        Log::debug($request->modelos);
        return Inertia::render('Vehiculo/index', [
            'cities' => $request->cities,
            'provinces' => $request->provinces,
            'clientProvince' => $request->clientProvince,
            'client' => $request->client,
            'tipos' => $request->tipos,
            'marcas' => $request->marcas,
            'modelos' => $request->modelos,
            'car' => $request->car,
            'clientepais' => $request->clientepais,
            'paises' => $request->paises
        ]);
    }
    public function caseguradoraReturn(Request $request)
    {
        return Inertia::render('Policy/index', [
            'car' => $request->car,
            'sellers' => $request->sellers,
            'clien_id' => $request->clien_id,
            'cities' => $request->cities,
            'provinces' => $request->provinces,
            'clientProvince' => $request->clientProvince,
            'client' => $request->client,
            'tipos' => $request->tipos,
            'marcas' => $request->marcas,
            'modelos' => $request->modelos,
            'clientepais' => $request->clientepais,
            'paises' => $request->paises
        ]);
    }
    public function serviciosReturn(Request $request)
    {
        //return $request->insurre;
        return Inertia::render('Policy/create', [
            'car' => $request->car,
            'sellers' => $request->sellers,
            'clien_id' => $request->clien_id,
            'cities' => $request->cities,
            'provinces' => $request->provinces,
            'clientProvince' => $request->clientProvince,
            'client' => $request->client,
            'tipos' => $request->tipos,
            'marcas' => $request->marcas,
            'modelos' => $request->modelos,
            'tarifa' => $request->tarifa,
            'services' => $request->services,
            'policyTime' => $request->policyTime,
            'servicios' => $request->servicios,
            'polizaValor' => $request->polizaValor,
            'insurres' => $request->insurre,
            'clientepais' => $request->clientepais,
            'paises' => $request->paises,
            'date' => $request->date

        ]);
    }
    public function verPoliza($policeId)
    {

        return Inertia::render('poliza');
    }
}
