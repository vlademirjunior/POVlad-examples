<?php

namespace App\PovladPagarme\Models;

class Payment
{
    public string $payment_method;
    public array $boleto;  // array associado aos detalhes do boleto.
}