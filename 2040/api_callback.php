<?php
session_start();
error_reporting(E_ALL);
$username = $_SESSION['uname'];
$invoice = $_POST['invoice'];

$url = "https://ghapes.org/api/request/document/progress";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "key: UDS-GH",
   "token: 5acc983aab5a146abbfd715de67bb12009e1c0ebba533e07c4e08be76fcd559d",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = "tracking_id=".$invoice."&msg=CONFIRMED"."&username=".$username."&key=1";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
echo $resp;

?>