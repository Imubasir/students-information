<?php
session_start();
	//Transcript/Letter properties to be taken from Eduplus API.

$url = "api.uds.edu.gh/request/document/process"; //Eduplus API Link..
$response = file_get_contents($url);
$response = json_decode($response, TRUE);
$array_keys = array_keys($response);
$data = array();
foreach($array_keys as $key) {
    $data[] = $response[$key];
}

echo json_encode($data);
?>

