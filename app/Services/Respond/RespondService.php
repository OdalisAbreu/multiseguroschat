<?php

namespace App\Services\Respond;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RespondService
{

    private $clientPhone;
    private $urlBase;

    public function __construct($clientPhone)
    {
        $this->urlBase = 'https://api.respond.io/v2/contact/phone:+';
        $this->clientPhone = $clientPhone;
    }
    public function AddTagContact($tags, $phone)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('RESPOND_TOKEN'),
        ])->post($this->urlBase . $phone . '/tag', [
            $tags
        ]);
        if ($response->failed()) {
            Log::error($response);
        }
        return $response;
    }

    public function enviarMensaje($type, $text)
    {
        $url = $this->urlBase . $this->clientPhone . '/message';
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
        $url = $this->urlBase . $this->clientPhone . '/message';
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
    public function getContact()
    {
        $url = $this->urlBase  . $this->clientPhone;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('RESPOND_TOKEN'),
        ])->get($url);
        if ($response->failed()) {
            Log::error($response);
        }
        return $response;
    }

    public function createContact($name, $lastname)
    {
        $url = $this->urlBase . $this->clientPhone;
        $payload = [
            'firstName' => $name,
            'lastName' => $lastname,
            'phone' => $this->clientPhone,
            'language' => 'es',
            'countryCode' => 'DO'
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
}
