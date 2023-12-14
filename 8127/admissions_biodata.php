<?php
echo "Starting...";
$_id = '20010676';
$jsonArrayResponse = array();

$cURLConnection = curl_init();

curl_setopt($cURLConnection, CURLOPT_URL, 'https://admissions.uds.edu.gh/api/students/biodata/'.$_id);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, false); // REMOVE THIS LINE IN PRODUCTION

curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array(
    'Authorization: $2y$10$TUbbijRgmw/ZhqGHxGY7CuBamCXPB5N9gpNrqqsYv1qL0S.1cn2vG',
    'Client: sisu'
));

$studentBiodata = curl_exec($cURLConnection);


$jsonArrayResponse = json_decode($studentBiodata, true);

if (curl_errno($cURLConnection)) {
    $error_msg = curl_error($cURLConnection);
}
curl_close($cURLConnection);

if (isset($error_msg)){
    echo $error_msg;
} else {
    print_r($jsonArrayResponse);
}

?>