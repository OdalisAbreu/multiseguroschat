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
        if ($response->successful()) {
            Log::info('add tag contact:', ['responseData' => $response->json()]);
        } else {
            Log::error('add tag contact:', ['responseData' => $response->status()]);
        }
    }
}
