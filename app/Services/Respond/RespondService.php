<?php

namespace App\Services\Respond;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RespondService
{

    private $clientPhone;

    public function __construct($clientPhone)
    {
        $this->clientPhone = $clientPhone;
    }
    public function AddTagContact($tags)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('RESPOND_TOKEN'),
        ])
            ->post('https://api.respond.io/v2/contact/phone:+' . $this->clientPhone . '/tag', [
                $tags
            ]);
    }

    public function enviarMensaje($type, $text)
    {
        $url = 'https://api.respond.io/v2/contact/phone:+' .  $this->clientPhone . '/message';
        $payload = [
            'message' => [
                'type' => $type,
                'text' => $text,
            ],
        ];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('RESPOND_TOKEN'),
        ])->post($url, $payload);
        if ($response->failed()) {
            Log::error($response);
        }
        return $response;
    }

    public function enviarArchivoBotCitie($type, $urlFile)
    {
        $url = 'https://api.respond.io/v2/contact/phone:+' .  $this->clientPhone . '/message';
        $payload = [
            'message' => [
                'type' => 'attachment',
                'attachment' => [
                    'type' => $type,
                    'url' => $urlFile,
                ],
            ],
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('RESPOND_TOKEN'),
            'Content-Type' => 'application/json',
        ])->post($url, $payload);

        if ($response->failed()) {
            Log::error($response);
        };

        return $response->json();
    }
}
