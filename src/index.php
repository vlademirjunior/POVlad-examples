<?php
namespace App;

require_once "./vendor/autoload.php";

use App\PovladPagarme\BoletoService;
use App\PovladPagarme\GuzzleHttpClient;
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

function dd($data)
{
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

// Pedido Teste
$orderFactory = new OrderFactory(new OrderService());
$order = $orderFactory->createRandomOrder();


$result = $boletoService->generateTestBoleto($order);

// Verifique o resultado
if ($result['success']) {
    // Sucesso! Faça algo com $result['data']
    dd($result);
} else {
    // Falha! Faça algo com $result['message']
    dd($result['message']);
}

?>
echo "<h1>Hello Pagarme!</h1>";