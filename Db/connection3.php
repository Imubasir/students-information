<?php

$conn3 = new mysqli('172.16.0.11', 'arms_finance', 'arms_fin@1', 'finance_local');

if($conn3->connect_error){
	die("Connection Failed: ". $conn3->connect_error);
}

?>