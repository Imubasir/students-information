<?php
$username = "root";
$password = "";
$server = "localhost";
$database = "arms_pg";

$conn2 = new mysqli($server, $username, $password, $database);

if($conn2->connect_error){
	die("Connection Failed: ". $conn2->connect_error);
}

?>