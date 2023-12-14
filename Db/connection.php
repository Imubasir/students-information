<?php
$username = "root";
$password = "";
$server = "localhost";
$database = "arms";

$conn = new mysqli($server, $username, $password, $database);

if($conn->connect_error){
	die("Connection Failed: ". $conn->connect_error);
}

?>