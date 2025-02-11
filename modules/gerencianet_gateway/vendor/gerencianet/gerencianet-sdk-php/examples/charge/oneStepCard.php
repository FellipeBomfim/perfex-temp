<?php

require __DIR__ . '/../../vendor/autoload.php';

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$file = file_get_contents(__DIR__ . '/../config.json');
$options = json_decode($file, true);
unset($options['pix_cert']);

$paymentToken = 'Insira_aqui_seu_paymentToken';

$item_1 = [
    'name' => 'Gorbadoc Oldbuck',
    'amount' => 1,
    'value' => 3000
];

$items = [
    $item_1
];

$metadata = array('notification_url' => 'https://meuip.in/xxxxx.php');

$customer = [
    'name' => 'Gorbadoc Oldbuck',
    'cpf' => '04267484171',
    'phone_number' => '5144916523',
    'email' => 'oldbuck@gerencianet.com.br',
    'birth' => '1990-01-15'
];

$billingAddress = [
    'street' => 'Av JK',
    'number' => 909,
    'neighborhood' => 'Bauxita',
    'zipcode' => '35400000',
    'city' => 'Ouro Preto',
    'state' => 'MG'
];

$discount = [
    'type' => 'currency',
    'value' => 599
];

$configurations = [
    'fine' => 200,
    'interest' => 33
];

$credit_card = [
    'customer' => $customer,
    'installments' => 1,
    'discount' => $discount,
    'billing_address' => $billingAddress,
    'payment_token' => $paymentToken,
    'message' => 'Prezado(a) cliente, informamos que esse boleto é registrado como cobrança em seu CPF,  e casos de inadimplência, esse documento poderá ser levado para protesto em cartório. Em caso de dúvidas, fale conosco!'
];

$payment = [
    'credit_card' => $credit_card
];

$body = [
    'items' => $items,
    'metadata' => $metadata,
    'payment' => $payment
];

try {
    $api = new Gerencianet($options);
    $response = $api->oneStep([], $body);

    echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</pre>';
} catch (GerencianetException $e) {
    print_r($e->code);
    print_r($e->error);
    print_r($e->errorDescription);
} catch (Exception $e) {
    print_r($e->getMessage());
}
