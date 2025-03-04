<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Municipalities;
use App\Models\Province;
use App\Models\Vehicle_brands;
use App\Models\Vehicle_models;
use App\Models\Vehicle_type_tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;


class ClientController extends Controller
{
    public function login(Request $request)
    {
        $string = array("-", " ");
        $phone = str_replace($string, "", $request->Clinetphone); // Quita los espacios en blanco y los guiones
        if (strlen($phone) == 10) {
            $phone = '1' . $phone;
        }

        $client = Client::where('phonenumber', $phone)->first();

        if (!$client) {
            $client = new Client();
            $client->name = " ";
            $client->lastname = " ";
            $client->phonenumber = $phone;
            $client->cardnumber = $request->Clientid;
            $client->save();
        }
        $cities = Municipalities::orderBy('descrip')->get();
        $provinces = Province::orderBy('descrip')->get();
        $clientProvince = Province::find($client->province);
        $tipos = Vehicle_type_tarif::orderBy('nombre')->get();
        $marcas = Vehicle_brands::orderBy('DESCRIPCION')->get();
        $modelos = Vehicle_models::orderBy('descripcion')->get();
        $paises = DB::select('select * from nacionalidad order by nacionalidad asc');
        if (!$client->nacionalidad) {
            $client->nacionalidad = 0;
        }
        if (!$clientProvince) {
            $clientProvince['id'] = 0;
        }
        $Clientepais = DB::select('select * from nacionalidad where id = ' . $client->nacionalidad);
        return Inertia::render('Clients/Edit', [
            'client' => $client,
            'cities' => $cities,
            'provinces' => $provinces,
            'clientProvince' => $clientProvince,
            'tipos' => $tipos,
            'marcas' => $marcas,
            'modelos' => $modelos,
            'paises' => $paises,
            'clientepais' => $Clientepais
        ]);
    }

    public function index()
    {
        $url = 'http://multiseguros.com.do:5050';
        //Esto no va
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJVc2VyTmFtZSI6InNlbmRpdV9kZXNhcnJvbGxvIiwibmJmIjoxNjU1NDgwODg5LCJleHAiOjE2NTYwODU2ODksImlhdCI6MTY1NTQ4MDg4OX0.z0KshbCzm9aQiFR7rDYp3sqJacbZ7R6aKZ6zcq2w8Ok';
        /*$ = Http::post($url.'/api/User/Authenticate',[
            'username' => 'sendiu_desarrollo',
            'password' => 'Admin1234'
        ]);*/
        $tipos = Http::withToken($token)->get($url . '/api/Seguros/VehicleType');
        $tipos = $tipos->json();

        $marcas = Http::withToken($token)->get($url . '/api/Seguros/Make');
        $marcas = $marcas->json();

        $modelos = Http::withToken($token)->get($url . '/api/Seguros/Model');
        $modelos = $modelos->json();

        return Inertia::render('Vehiculo/index', [
            'tipos' => $tipos,
            'marcas' => $marcas,
            'modelos' => $modelos,
            'token' => $token
        ]);
    }

    public function show($phone) // VISTA 1 EDITAR CLIENTE
    {
        $string = array("-", " ");
        $phone = str_replace($string, "", $phone); // Quita los espacios en blanco y los guiones

        // Falta validar si tiene 1

        $client = Client::where('phonenumber', $phone)->first();

        if ($client) {
            $cities = Municipalities::orderBy('descrip')->get();
            $provinces = Province::orderBy('descrip')->get();
            $clientProvince = Province::find($client->province);
            $tipos = Vehicle_type_tarif::orderBy('nombre')->get();
            $marcas = Vehicle_brands::orderBy('DESCRIPCION')->get();
            $modelos = Vehicle_models::orderBy('descripcion')->get();
            $paises = DB::select('select * from nacionalidad order by nacionalidad asc');
            if (!$client->nacionalidad) {
                $client->nacionalidad = 0;
            }
            if (!$clientProvince) {
                $clientProvince['id'] = 0;
            }
            $Clientepais = DB::select('select * from nacionalidad where id = ' . $client->nacionalidad);
            return Inertia::render('Clients/Edit', [
                'client' => $client,
                'cities' => $cities,
                'provinces' => $provinces,
                'clientProvince' => $clientProvince,
                'tipos' => $tipos,
                'marcas' => $marcas,
                'modelos' => $modelos,
                'paises' => $paises,
                'clientepais' => $Clientepais
            ]);
        } else {
            return Inertia::render('index', []);
        }
    }

    public function store(Request $request)
    {
        $client = Client::where('cardnumber', $request->cardnumber)->first();
        //el campo phonenumber valida si tiene 11 caracteres y si no le agrega el 1
        if (strlen($request->phonenumber) == 10) {
            $phonenumber = '1' . $request->phonenumber;
        }
        if (!$client) {
            $client = new Client();
            $client->name = strtoupper($request->name);
            $client->lastname = strtoupper($request->lastname);
            $client->email = $request->email;
            $client->adrress = strtoupper($request->adrress);
            $client->cardnumber = $request->cardnumber;
            $client->passportnumber = $request->passportnumber;
            $client->nacionalidad = $request->pais;
            $client->city = strtoupper($request->city);
            $client->province = $request->provincia;
            $client->phonenumber = $phonenumber;
            $client->save();
        } else {
            $client->name = strtoupper($request->name);
            $client->lastname = strtoupper($request->lastname);
            $client->email = $request->email;
            $client->adrress = strtoupper($request->adrress);
            $client->passportnumber = $request->passportnumber;
            $client->nacionalidad = $request->pais;
            $client->city = strtoupper($request->city);
            $client->province = $request->provincia;
            $client->phonenumber = $phonenumber;
            $client->save();
        }
        if (isset($request->car)) {
            $car = $request->car;
        } else {
            $car = [
                "tipo" => '',
                "tipoName" => '',
                "marca" => '',
                "marcaName" => '',
                "modelo" => '',
                "modeloName" => '',
                "placa" => '',
                "chasis" => '',
                "year" => ''
            ];
        }


        $clientProvince = Province::find($request->provincia);
        $tipos = Vehicle_type_tarif::all();
        $marcas = Vehicle_brands::all();
        $modelos = Vehicle_models::all();
        return Inertia::render('AdminPages/Vender/Unico/AddClientCar', [
            'tipos' => $tipos,
            'marcas' => $marcas,
            'modelos' => $modelos,
            'clien_id' => $client->id,
            'client' => $client,
            'cities' => $request->cities,
            'provinces' => $request->provinces,
            'clientProvince' => $clientProvince,
            'car' => $car,
            'clientepais' => $request->clientepais,
            'paises' => $request->paises
        ]);
        return $request->all();
    }
    public function update(Request $request, $id) // VISTA 1 ACTUALIZAR CLIENTE
    {
        $request->validate([
            'name' => 'required'
        ]);
        $client = Client::find($id);
        $client->name = strtoupper($request->name);
        $client->lastname = strtoupper($request->lastname);
        $client->email = $request->email;
        $client->adrress = strtoupper($request->adrress);
        $client->cardnumber = $request->cardnumber;
        $client->passportnumber = $request->passportnumber;
        $client->nacionalidad = $request->pais;
        $client->city = strtoupper($request->city);
        $client->province = $request->provincia;
        $client->phonenumber = $request->phonenumber;
        $client->save();

        if (isset($request->car)) {
            $car = $request->car;
        } else {
            $car = [
                "tipo" => '',
                "tipoName" => '',
                "marca" => '',
                "marcaName" => '',
                "modelo" => '',
                "modeloName" => '',
                "placa" => '',
                "chasis" => '',
                "year" => ''
            ];
        }


        $clientProvince = Province::find($request->provincia);
        $tipos = $request->tipos;
        $marcas = $request->marcas;
        $modelos = $request->modelos;
        return Inertia::render('Vehiculo/index', [
            'tipos' => $tipos,
            'marcas' => $marcas,
            'modelos' => $modelos,
            'clien_id' => $id,
            'client' => $client,
            'cities' => $request->cities,
            'provinces' => $request->provinces,
            'clientProvince' => $clientProvince,
            'car' => $car,
            'clientepais' => $request->clientepais,
            'paises' => $request->paises
        ]);
    }


    public function seller(Request $request)
    {
        $url = 'http://multiseguros.com.do:5050';

        $token = $request['token'];

        $tipos = Http::withToken($token)->get($url . '/api/Seguros/Make');
        $tipos = $tipos->json();

        $marcas = Http::withToken($token)->get($url . '/api/Seguros/Make');
        $marcas = $marcas->json();

        $modelos = Http::withToken($token)->get($url . '/api/Seguros/Model');
        $modelos = $modelos->json();

        return Inertia::render('Vehiculo/index', [
            'tipos' => $tipos,
            'marcas' => $marcas,
            'modelos' => $modelos,
            'token' => $token
        ]);
    }
    public function clientReturn(Request $request)
    {
        return Inertia::render('Clients/Edit', [
            'client' => $request->client,
            'cities' => $request->cities,
            'provinces' => $request->provinces,
            'clientProvince' => $request->clientProvince,
            'tipos' => $request->tipos,
            'marcas' => $request->marcas,
            'modelos' => $request->modelos,
            'activarPresentacion' => 'False',
            'car' => $request->car,
            'clientepais' => $request->clientepais,
            'paises' => $request->paises
        ]);
    }
}
