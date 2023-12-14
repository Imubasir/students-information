<?php
session_start();
require_once('../Db/connection.php');
$data = array();

$tracking_id = $_POST['tracking_id'];
$msg = $_POST['msg'];
$username = $_SESSION['username'];

// $params = array(
//   "tracking_id" => $tracking_id,
//   "msg" => $msg,
//   "username" =>$username
// );

// curl_setopt_array($ch = curl_init(), array(
//     CURLOPT_URL => "https://ghapes.org/api/request/document/progress",
//   CURLOPT_SSL_VERIFYPEER => 0,
//   CURLOPT_POST => 1,
//   CURLOPT_POSTFIELDS => http_build_query($params),
//   CURLOPT_RETURNTRANSFER => 1
// ));
// $response = curl_exec($ch);
// curl_close($ch);

// echo $response;

$cURLConnection = curl_init();
curl_setopt($cURLConnection, CURLOPT_URL,"https://ghapes.org/api/request/document/progress");
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

//avoid unable to get local issuer certificate
 $values = array(
    'tracking_id' => $tracking_id,
    'msg' => $msg,
    'username' => $username
    );
$params = http_build_query($values);
curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $params); 
$qresult = curl_exec($cURLConnection);
curl_close($cURLConnection);

$jsonArrayResponse = json_decode($qresult,true);
print_r($jsonArrayResponse);

?>