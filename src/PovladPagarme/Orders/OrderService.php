<?php

namespace App\PovladPagarme\Orders;

use App\PovladPagarme\Models\Customer;

class OrderService
{
    public function buildOrder(Customer $customer, array $items, array $payments): array
    {
        return [
            'customer' => [
                'address' => $customer->address,
                'phones' => $customer->phones,
                'name' => $customer->name,
                'email' => $customer->email,
                'document' => $customer->document,
                'type' => $customer->type,
            ],
            'items' => $items,
            'payments' => $payments,
        ];
    }
}