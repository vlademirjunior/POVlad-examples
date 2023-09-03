<?php

namespace App\PovladPagarme;


use App\PovladPagarme\Interfaces\IHttpClient;
use GuzzleHttp\Client;

class GuzzleHttpClient implements IHttpClient
{
    public function post(string $url, array $headers, array $data): array
    {
        $client = new Client();
        $response = $client->post($url, [
            'json' => $data,
            'headers' => $headers,
        ]);

        return ['statusCode' => $response->getStatusCode(), 'body' => json_decode($response->getBody(), true)];
    }
}