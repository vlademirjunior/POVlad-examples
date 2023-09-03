<?php

namespace App\PovladPagarme;


use App\PovladPagarme\Interfaces\IHttpClient;
use Exception;

class BoletoService
{
    private IHttpClient $httpClient;
    private string $authorization;

    public function __construct(IHttpClient $httpClient, string $secretKey)
    {
        $this->httpClient = $httpClient;
        $this->authorization = 'Basic ' . base64_encode($secretKey . ':');
    }

    public function generateBoleto(array $boletoData): array
    {
        // Validar os dados do boleto aqui...

        try {
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => $this->authorization,
                'Content-Type' => 'application/json',
            ];

            $response = $this->httpClient->post('https://api.pagar.me/core/v5/orders', $headers, $boletoData);

            if ($response['statusCode'] === 200) {
                return ['success' => true, 'data' => $response['body']];
            }

            return ['success' => false, 'message' => 'Erro desconhecido'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function generateTestBoleto(array $boletoData): array
    {
        // Validar os dados do boleto aqui...

        try {
            $headers = [
                'Accept' => 'application/json',
                'Authorization' => $this->authorization,
                'Content-Type' => 'application/json',
            ];

            $response = $this->httpClient->post('https://api.pagar.me/core/v5/orders', $headers, $boletoData);

            if ($response['statusCode'] === 200) {
                return ['success' => true, 'data' => $response['body']];
            }

            return ['success' => false, 'message' => 'Erro desconhecido'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}