<?php

namespace App\Services\Respond;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RespondService
{
    public function AddTagContact($phoneCustomer, $tags)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTgyMywic3BhY2VJZCI6MTQ3NDAxLCJvcmdJZCI6MjAzNDYsInR5cGUiOiJhcGkiLCJpYXQiOjE2ODI1Mzc0MTZ9.dsECELGyYJd9XF_PkkM-W8W-qUPnow3VdFeHnM2XiSo',
        ])
            ->post('https://api.respond.io/v2/contact/phone:+' . $phoneCustomer . '/tag', [
                $tags
            ]);
        // if ($response->successful()) {
        //     Log::info('add tag contact:', ['responseData' => $response->json()]);
        // } else {
        //     Log::error('add tag contact:', ['responseData' => $response->status()]);
        // }
    }

    public function enviarMensaje($phone, $type, $text)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.respond.io/v2/contact/phone:+' . $phone . '/message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                                        "message": {
                                                        "type": "' . $type . '",
                                                        "text": "' . $text . '"
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
}
