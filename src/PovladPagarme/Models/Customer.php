<?php

namespace App\PovladPagarme\Models;

class Customer
{
    public string $name;
    public string $email;
    public string $document;
    public string $type;
    public Address $address;
    public array $phones;  // array associado aos objetos de Phone
}