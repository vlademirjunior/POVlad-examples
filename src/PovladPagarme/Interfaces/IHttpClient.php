<?php

namespace App\PovladPagarme\Interfaces;

interface IHttpClient
{
    public function post(string $url, array $headers, array $data): array;
}