<?php 

$json = file_get_contents('constants/client_secret.json');

$array = json_decode($json);

$client_id = $array->installed->client_id;
$client_secret = $array->installed->client_secret;
$redirect_uri = $array->installed->redirect_uris[0];

$scope = 'https://www.googleapis.com/auth/drive';
echo "https://accounts.google.com/o/oauth2/v2/auth?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&scope=$scope&access_type=offline" ;
