<?php

require 'vendor/autoload.php';
require_once('refresh.php');
use GuzzleHttp\Client;
$token_json = refresh();
$token_array = json_decode($token_json, true);
$bearer = $token_array['access_token'];
$client = new Client([
	// Base URI is used with relative requests
	'base_uri' => 'https://www.googleapis.com/upload/drive/v3/files?uploadType=multipart',
	// You can set any number of default request options.
	//	'timeout'  => 2.0,
]);

$filename = $argv[1];
$parent = $argv[2];
$metadata = '{"name": "'.$filename.'", "parents": ["'.$parent.'"]}';

$body = fopen($filename, 'r');
$response = $client->request('POST', '', [
	'headers' => [
		'Authorization' => 'Bearer '.$bearer,
	],
	'multipart' => [
		[
			'name' => 'metadata',
			'contents' => $metadata,
			'headers' => [
				'Content-Type' => 'application/json; charset=UTF-8',
			],
		],
		[
			'name' => 'body',
			'contents' => $body,
			'headers' => [
				'Content-Type' => 'text/plain',
			]
		],
	]
]);
	
echo $response->getBody();
