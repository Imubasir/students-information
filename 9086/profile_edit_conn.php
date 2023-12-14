<?php
session_start();
require('../Db/connection.php');
$user=$_SESSION['uname'];

$sql = "SELECT * from tbl_user_profile where username = '$user'";

$result = mysqli_query($conn, $sql);
	$data = array();

	if($result){
		while($row = $result->fetch_assoc()){
		$data[] = $row;
		}
	}
	else{
	echo "Error:".$conn->error;
	}
	
	echo json_encode($data);
