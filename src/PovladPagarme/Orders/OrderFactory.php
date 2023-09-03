<?php

namespace App\PovladPagarme\Orders;

use App\PovladPagarme\Models\Address;
use App\PovladPagarme\Models\Customer;
use App\PovladPagarme\Models\Item;
use App\PovladPagarme\Models\Payment;
use App\PovladPagarme\Models\Phone;

# Factory Pattern
class OrderFactory
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    //  getRandomString e getRandomNumber para gerar dados aleatórios
    private function getRandomString($length = 10): string
    {
        return substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1, $length))), 1, $length);
    }

    private function getRandomNumber($min, $max): int
    {
        return mt_rand($min, $max);
    }
    
    public function createRandomOrder(): array
    {
        $address = new Address();
        $address->line_1 = $this->getRandomString(20) . ', Rua.';
        $address->line_2 = $this->getRandomNumber(1, 20) . 'º andar';
        $address->zip_code = strval($this->getRandomNumber(10000000, 99999999));
        $address->city = $this->getRandomString(8);
        $address->state = $this->getRandomString(2);
        $address->country = 'BR';

        $homePhone = new Phone();
        $homePhone->country_code = "55";
        $homePhone->area_code = strval($this->getRandomNumber(10, 99));
        $homePhone->number = strval($this->getRandomNumber(100000000, 999999999));

        $mobilePhone = new Phone();
        $mobilePhone->country_code = "55";
        $mobilePhone->area_code = strval($this->getRandomNumber(10, 99));
        $mobilePhone->number = strval($this->getRandomNumber(100000000, 999999999));

        $customer = new Customer();
        $customer->name = $this->getRandomString(10);
        $customer->email = $this->getRandomString(5) . '@' . $this->getRandomString(3) . '.com';
        $customer->document = '21811216137';
        $customer->type = 'individual';
        $customer->address = $address;
        $customer->phones = ['home_phone' => $homePhone, 'mobile_phone' => $mobilePhone];

        $item = new Item();
        $item->amount = $this->getRandomNumber(1000, 9999);
        $item->code = $this->getRandomNumber(100, 999);
        $item->description = $this->getRandomString(20);
        $item->quantity = $this->getRandomNumber(1, 10);

        $payment = new Payment();
        $payment->payment_method = 'boleto';
        $payment->boleto = [
            'instructions' => 'Boleto de Teste ' . $this->getRandomString(5),
            'due_at' => date('Y-m-d\TH:i:s\Z', strtotime('+7 days')),
            'document_number' => strval($this->getRandomNumber(10000000000, 99999999999)),
            'type' => 'DM'
        ];

        return $this->orderService->buildOrder($customer, [$item], [$payment]);
    }

    public function createOrder(Customer $customer, Item $item, Payment $payment): array
    {
        return $this->orderService->buildOrder($customer, [$item], [$payment]);
    }
}