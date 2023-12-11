<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\CssSelector\Parser\Token;
use Illuminate\Support\Facades\Storage;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //  return $request->passportnumber;
        $client = new Client();
        $client->name = strtoupper($request->name);
        $client->lastname = strtoupper($request->lastname);
        $client->cardnumber = $request->cardnumber;
        $client->passportnumber = $request->passportnumber;
        $client->phonenumber = $request->phonenumber;
        $client->adrress = strtoupper($request->adrress);
        $client->city = strtoupper($request->city);
        $client->province = 33;
        $client->nacionalidad = 117;
        $client->email = $request->email;
        $client->idConversacion = $request->idConversacion;
        $client->session = 'A';
        $client->save();
        Log::info("Crear cliente", $client);
        if ($client) {
            return ['status' => '00', 'message' => 'Usuario creado correctamente', 'cantidadPoliza' => 0];
        } else {
            return ['status' => '01', 'message' => 'No tiene póliza registrada'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id, $idConversacion)
    {
        $client = Client::where('phonenumber', $id)->first();
        if ($client) {
            // return $client;
            $client->idConversacion = $idConversacion;
            $client->session = 'A';
            $client->save();
            Log::info("Activar Sesión", ["id" => $client->id, "session" => $client->session]);

            // Calcula la cantidad de poliza
            $invoince = Invoices::where('client_id', $client->cardnumber)->count(); //

            return [
                'status' => '00',
                'id' => $client->id,
                'name' => $client->name,
                'lastname' => $client->lastname,
                'cardnumber' => $client->cardnumber,
                'passportnumber' => $client->passportnumber,
                'phonenumber' => $client->phonenumber,
                'adrress' => $client->adrress,
                'city' => $client->city,
                'email' => $client->email,
                'cantidadPoliza' => $invoince
            ];
        } else {
            return ['status' => '01', 'message' => 'El cliente no se encuentra registrado'];
        }
    }


    public function clientPilicy($cedula)
    {
        $invoince = Invoices::where([['client_id', $cedula], ['payment_status', 'ACCEPT']])->get()->last();
        if ($invoince) {
            return ['status' => '00', 'url' => 'https://multiseguros.com.do/Seg_V2Dev/ticket.php?id=' . $invoince->police_transactionId];
        } else {
            return ['status' => '01', 'message' => 'No tiene póliza registrada'];
        }
    }
    public function codigosDescuento(Request $request)
    {
    }
    public function enviarIdPolizaBot($idPoliza, $idConversacion)
    {
        //----------------------------------Optiene el Token de la seccion
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://multiseguroschatbot.botpropanel.com/api/v1/ContactCenter/authenticate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "username": "odalis.abreu@sendiu.net",
            "password": "Elleondedios05",
            "keycloakToken": ""
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: .AspNetCore.Identity.Application=CfDJ8KjL_rYZHmJEsjtPAIeyzJXuS1_uzBpkCBiiV-rZ6JgFWviQ1HNN0LVLEv_ruYhWIglDxLJLzqP2QcxW7zEtBdxNoasqMcp8dAvxqatmeZFv-pxfvxI3SMj19j_LVxAAQQRy-S7On9HxftdYI4gkFkCFOkyVitIWX4wGGV4B8Ogck16EItB-VY69RaCQOQO8osQobg69SuK0biM7wQlZGV27rLA2zSVqIyAJSvUqCDW89rm0CuNL1Wr3uFE144j-Fo1U__2IckUzBGfQ4Lm0CpW0Pz7504-XZmJEEZN7ZOUAoi4bqRvcv_lCootyAxRQXKtQq7rOaKEWSguAAIKNZ8ouiMm1kwxAoxo3sZpPJgFDhPsPOYvn6O1uinjObSW1AWadJBEBOmCMgJe2qCxNI4xlvv17W47x4edOtYKcJiTk1Glz5fJnDHu2P2Yf6MZcqBLHJea7XMiX4jUbXkaBTW99M0bNKelaHtdfUtPwsQjsHoJf5ZdMuFH7V6AgV1W0YMle-MCBc4w29jdfBrTKAYphmcMJNw9pXWP0tkwKUApuiZfHmiXUuCU_3hENp2CvB6qdWuixp6ZcGpIozrQvgNZuCH5HHAc0iR2Q5rr1yKoModvFq-TmdlFtgYUdnj3rWjnWBjdV1ZUBQ_T2ct5SgQBx9lnfoujXbTLrjkhLxY-75_Vbbi7MX7R7nzvmzoQQ_4kiEM3cvPM47_Uosq1oVuLEkHHmYXn-0M6c-TRcouJHUeJkHlaiCgaChcV6VVxsaZl1ou3DhzsDz1mo38KAsFJlpX-mCVcb5iqA2qC5Bf1mVWXt2NrbfyCT9AYm_X90ZMkOO2BIbvJVGiT7o6uHkDo1xv1b0ZTHrwGyhLnt8Zzu9OtwRKQE8Tbkc3d_SHTVtX0FRvx4u5hXEDibF_UeyLf88IIO9xAXZvFntZvp_RImGEXZY_939bKofEtgrudkWBELbd0R3EbVlG0rVtHfUL_L_CZGmXUlhxvqYDCTJnlK'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $token = json_decode($response);
        //sleep(4);
        // echo $token->token;
        //---------------------------Envia la Variable a BotPro ---------------------------------------------------------//

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://multiseguroschatbot.botpropanel.com/api/v1/Hooks/Conversation?botpro_conversationId=' . $idConversacion . '&variable=polizaId&value=' . $idPoliza,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token->token,
                'Cookie: .AspNetCore.Identity.Application=CfDJ8KjL_rYZHmJEsjtPAIeyzJV4_ZXFZS9Ecn_Y-dni2OyLYtpEt8y5HBx_dgPLwAhyCR3yWWp19PmJlMzlwaepn-hUuSdNa4uL5g2t4r_cQcWKw6HKCDTwO0VUsKXZogq4qM6y0svuM-8BBN733YJzyhFJm2uGEACYxAgkVMOkaFg0Ql4l8W4y50OOLeF8Jh4v_2ry_By-Auuh33gPaWt6YpHAWxUMwBIDdg8p3fs8gE0RXBcs_BuwEWkH8DPsoZA_vQ53E-z1XA_w1R8AA5tLbQWvgCvmgXBhk5R9cw3boFPpGzujmSE2SNnar40Bmx2yQsJgORcvse1dTZPAhKgFjQ-lxS-zWkMe3Vf3sQxqfUNgcEBHSkdVZP3qaX2lgt2HVH1tpb-H0DMC3dJP9VAswHtA0SB7aBOzSyna1CKAXm4FkGmJBnKrBhU8GyNR7El4j3Zxw7mVk17zYeKJ3b68KJQoHG0PfKRERCxiJnYYJ6ODa47NjZy-Ol6tEBZYz2ShQ4yVWuXYOsbe1bzUMRW4KNjf5-y9rPlavFNqXuxdCc2oLDZzxCLNT-vWzgE6c69xY9fodU-J8VEaka9b2vtzvg_lpZlzxmoq495fItP8BkTkvhMrY6OSsc1WUJWN7g7Vw2s2Vwz3hrDQ6LTnP0c1G2mOXxSC1vJnUjZX7AKWCmLL-30OXdfuM8d239waBSqKAAPLZ51RDFJIAJcUK4tv-AbnPoCiuEZbCaeqLJCrGkmEawB6UR2jShhf6-jzCNsRI-wqby1rLIjZ1Pz4BcfJHxiNyf8bWY5CNK-uezZyGZy5RC_agRo-E8WPENUg_84P5Nbl_MsAC0LAvvxp4d6S6d2nVbG4FIw9SLjDW0itNgWdtS1ajiUDuJ64hOGOPKar1x8nnGFDFL5h15KkpKy5IO14bt0EpsF2uwntq0nZg8Vv420rejFVmUlAPyb8Yb1MBQ'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        return 'OK';
    }
    public function getPolizaImage($idPoliza)
    {
        $invoince = Invoices::find($idPoliza);


        return [
            'police_number' => $invoince->police_number,
            'payment_status' => $invoince->payment_status,
            'idPoliza' => $invoince->id,
            'imageURL' => 'https://seguroschat.com/polizas/' . $invoince->id . '.png',
            'downloadPDF' => 'https://multiseguros.com.do/ws_dev/TareasProg/GenerarReporteAseguradoraPdfUnicoAuth.php?sms=0&id_trans=' . $invoince->police_transactionId
        ];
    }
    public function savePolizaImage(Request $request)
    {
        $invoince = Invoices::find($request->idPoliza);
        $invoince->imagenPoliza = $request->image;
        $invoince->save();

        $imagen = str_replace('data:image/png;base64,', '', $request->image,);
        $bin = base64_decode($imagen);
        $im = imageCreateFromString($bin);
        if (!$im) {
            die('Base64 value is not a valid image');
        }
        $img_file = 'polizas/' . $request->idPoliza . '.png';
        imagepng($im, $img_file, 0);

        return [
            'status' => 'OK'
        ];
    }
    public function enviarIdPolizaBotCity($idPoliza, $celular)
    {
        //-------------------------------------------- Eviar a BotCity-------------------------------------------------//

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://hooks.chatapi.net/workflows/CkejaTttGApb/RlIjHqKjGqhJ',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                                 "phone": "' . $celular . '",
                                 "polizaId": ' . $idPoliza . '
                             }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;


        return 'OK';
    }

    public function generarPdf($idPoliza)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://multiseguros.com.do/ws_dev/TareasProg/GenerarReporteAseguradoraPdfUnicoAuth.php?sms=0&id_trans=' . $idPoliza,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function enviarMensajeBotCitie(Request $request)
    {
        // return $request->phone . '  ' . $request->type . '     ' . $request->text;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.respond.io/v2/contact/phone:+' . $request->phone . '/message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                                        "message": {
                                                        "type": "' . $request->type . '",
                                                        "text": "' . $request->text . '"
                                                    }
                                    }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTgyMywic3BhY2VJZCI6MTQ3NDAxLCJvcmdJZCI6MjAzNDYsInR5cGUiOiJhcGkiLCJpYXQiOjE2ODI1Mzc0MTZ9.dsECELGyYJd9XF_PkkM-W8W-qUPnow3VdFeHnM2XiSo'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }
    public function enviarArchivoBotCitie(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.respond.io/v2/contact/phone:+' . $request->phone . '/message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
     "message": {
                    "type": "attachment",
                    "attachment":{
                        "type": "' . $request->type . '",
                        "url": "' . $request->url . '"
                        }
                    }
                }
                ',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTgyMywic3BhY2VJZCI6MTQ3NDAxLCJvcmdJZCI6MjAzNDYsInR5cGUiOiJhcGkiLCJpYXQiOjE2ODI1Mzc0MTZ9.dsECELGyYJd9XF_PkkM-W8W-qUPnow3VdFeHnM2XiSo'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    public function confirmarPositivo($phone)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://hooks.chatapi.net/workflows/ZECOvvRxmADK/KeeNFnOgboZP',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                                        "phone":"' . $phone . '"
                                    }
                        ',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    public function confirmarNegativo($phone)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://hooks.chatapi.net/workflows/gwHcpJPOodnl/ppjVkGKcwTQf',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                                        "phone":"' . $phone . '"
                                    }
                        ',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
    public function desactivarSesion($idClient)
    {
        $client = Client::where('id', $idClient)->first();
        // return $client;
        $client->session = 'I';
        $client->save();
        Log::info("Desactivar Sesión", ["id" => $client->id, "session" => $client->session]);
    }
    public function validarVista($idClient, $vista)
    {
        $client = Client::where('id', $idClient)->first();
        $client->vista = $vista;
        $client->save();
        Log::info("Validar Vista", ["id" => $client->id, "vista" => $client->vista]);
        return $client;
    }
    public function validarCesion($id)
    {
        $client = Client::where('id', $id)->first();
        if ($client) {
            if ($client->session == 'A') {
                return [
                    'status' => true
                ];
            } else {
                return [
                    'status' => false
                ];
            }
        } else {
            return [
                'status' => false
            ];
        }
    }
}
