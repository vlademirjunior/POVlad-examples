<?php
namespace App;

require_once "./vendor/autoload.php";

use App\PovladPagarme\BoletoService;
use App\PovladPagarme\GuzzleHttpClient;
use App\PovladPagarme\Models\Address;
use App\PovladPagarme\Models\Customer;
use App\PovladPagarme\Models\Item;
use App\PovladPagarme\Models\Payment;
use App\PovladPagarme\Models\Phone;
use App\PovladPagarme\Orders\OrderFactory;
use App\PovladPagarme\Orders\OrderService;

function loadSecretKey(): string
{
    $lines = file(__DIR__ . '/.env');
    foreach ($lines as $line) {
        list($name, $value) = explode('=', $line, 2);
        putenv(trim($name) . '=' . trim($value));
    }

    // Agora você pode usar getenv ou $_ENV para acessar a variavel de ambiente
    return getenv('SECRET_KEY');
}

function dd($data) {
    echo '<div style="background-color: black; color: white; padding: 20px;">';
    echo '<pre>';
    // Converte o conteúdo para uma string, adiciona formatação de sintaxe PHP
    $highlighted = highlight_string("<?php\n" . var_export($data, true) . ";", true);
    // Exibe conteúdo destacado
    echo $highlighted;
    echo '</pre>';
    echo '</div>';
    die();
}

$httpClient = new GuzzleHttpClient();
$boletoService = new BoletoService($httpClient, loadSecretKey());


// Estrutura do Pedido Real Por Exemplo:
$address = new Address();
$address->line_1 = 'Valor submetido do formulário';
$address->line_2 = 'Valor submetido do formulário';
$address->zip_code = '20740310';
$address->city = 'Rio de Janeiro';
$address->state = 'RJ';
$address->country = 'BR';

$homePhone = new Phone();
$homePhone->country_code = '55';
$homePhone->area_code = '21';
$homePhone->number = '24110967';

$mobilePhone = new Phone();
$mobilePhone->country_code = '55';
$mobilePhone->area_code = '21';
$mobilePhone->number = '979853862';

$customer = new Customer();
$customer->name = 'POVlad';
$customer->email = 'vlademir1998@gmail.com';
$customer->document = '37474081091';
$customer->type = 'individual';
$customer->address = $address;
$customer->phones = ['home_phone' => $homePhone, 'mobile_phone' => $mobilePhone];

$item = new Item();
$item->amount = 2000;
$item->code = 123;
$item->description = 'Descrição do Item comprado';
$item->quantity = 1;

$payment = new Payment();
$payment->payment_method = 'boleto'; # TODO: static
$payment->boleto = [
    'instructions' => 'Faça X Y E Z para esse boleto',
    'due_at' => date('Y-m-d\TH:i:s\Z', strtotime('+7 days')), # TODO: definir dias para expiração do boleto
    'document_number' => '47683264474',
    'type' => 'DM'
];

// Pedido Teste
$orderFactory = new OrderFactory(new OrderService());
$order = $orderFactory->createOrder(customer: $customer, item: $item, payment: $payment);

// Gere o boleto real por exemlo
$result = $boletoService->generateBoleto($order);

// Verifique o resultado
if ($result['success']) {
    // Sucesso! Faça algo com $result['data']
    dd($result);
} else {
    // Falha! Faça algo com $result['message']
    dd($result['message']);
}

?>
echo "<h1>Hello World!</h1>";