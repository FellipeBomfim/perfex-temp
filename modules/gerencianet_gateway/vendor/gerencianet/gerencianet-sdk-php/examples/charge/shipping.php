<?php

require __DIR__ . '/../../vendor/autoload.php';

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

$file = file_get_contents(__DIR__ . '/../config.json');
$options = json_decode($file, true);
unset($options['pix_cert']);

$items = [
	[
		'name' => 'Item 1',
		'amount' => 1,
		'value' => 1000
	],
	[
		'name' => 'Item 2',
		'amount' => 2,
		'value' => 2000
	]
];

$shippings = [
	[
		'name' => 'My Shipping',
		'value' => 2000
	]
];

$body = [
	'items' => $items,
	'shippings' => $shippings
];

try {
	$api = new Gerencianet($options);
	$response = $api->createCharge([], $body);

	echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</pre>';
} catch (GerencianetException $e) {
	print_r($e->code);
	print_r($e->error);
	print_r($e->errorDescription);
} catch (Exception $e) {
	print_r($e->getMessage());
}
