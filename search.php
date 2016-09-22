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

$q = urlencode(rtrim(fgets(STDIN)));
//$str = "files?q=name contains '{$q}'";
$response = $client->request('GET', "files?q=name contains '".$q."'", [
	'headers' => [
		'Authorization' => 'Bearer '.$bearer,
	],
	// 'query' => [
	// 	'q' => 'name contains',
	// ],
]);
echo $response->getBody();