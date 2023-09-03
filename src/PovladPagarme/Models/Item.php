<?php

namespace App\PovladPagarme\Models;

class Item
{
    public int $amount; # TODO: Entender porque pagarme só aceita se for int
    public int $code;
    public string $description;
    public int $quantity;
}
