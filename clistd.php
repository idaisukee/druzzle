<?php

require 'vendor/autoload.php';
require_once('refresh.php');
use GuzzleHttp\Client;
$token_json = refresh();
$token_array = json_decode($token_json, true);
$bearer = $token_array['access_token'];
$client = new Client([
	// Base URI is used with relative requests
	'base_uri' => 'https://www.googleapis.com/drive/v3/',
	// You can set any number of default request options.
	'timeout'  => 2.0,
]);

$response = $client->request('GET', 'files', [
	'headers' => [
		'Authorization' => 'Bearer '.$bearer,
	]
]);
echo $response->getBody();