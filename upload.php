<?php

require 'vendor/autoload.php';
require_once('refresh.php');
use GuzzleHttp\Client;
$token_json = refresh();
$token_array = json_decode($token_json, true);
$bearer = $token_array['access_token'];
$client = new Client([
	// Base URI is used with relative requests
	'base_uri' => 'https://www.googleapis.com/upload/drive/v3/files?uploadType=media',
	// You can set any number of default request options.
	'timeout'  => 2.0,
]);

$body = '160819';

$response = $client->request('POST', '', [
	'headers' => [
		'Authorization' => 'Bearer '.$bearer,
		'Content-Length' => strlen($body),
		'Content-Type' => 'text/plain',
	],
	'body' => $body,
	
]);
echo $response->getBody();