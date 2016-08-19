<?php
function refresh()
{
  $secret = file_get_contents('constants/client_secret.json');
  $secret_array = json_decode($secret);

  $token = file_get_contents('constants/access_token.json');
  $token_array = json_decode($token);

  $client_id = $secret_array->installed->client_id;
  $client_secret = $secret_array->installed->client_secret;
  $refresh_token = $token_array->refresh_token;

  $str_refresh_token = '"refresh_token='.$refresh_token.'"';
  $str_client_id = '"client_id='.$client_id.'"';
  $str_client_secret = '"client_secret='.$client_secret.'"';
  $str_grant_type = '"grant_type=refresh_token"';
  $refresh_url = 'https://www.googleapis.com/oauth2/v4/token';

  $str = 'curl --data '.$str_refresh_token.' --data '.$str_client_id.' --data '.$str_client_secret.' --data '.$str_grant_type.' '.$refresh_url;

  return $token_json = shell_exec($str);
}

