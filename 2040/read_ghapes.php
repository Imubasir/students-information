<?php
session_start();
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'ghapes.org/api/request/document/process',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('key' => 'UDS-GH'),
  CURLOPT_HTTPHEADER => array(
    'key: UDS-GH',
    'token: 5acc983aab5a146abbfd715de67bb12009e1c0ebba533e07c4e08be76fcd559d'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
