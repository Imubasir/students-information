<?php
session_start();
	require('../Db/connection.php');
	$id = $_SESSION['uname'];
	$sql = "SELECT * FROM tbl_user_profile WHERE username = '$id'";
	$result = mysqli_query($conn, $sql);
	$data = array();
	if($result){
		while($row = $result->fetch_assoc()){
		$data[] = $row;
	}
}else{
	echo "Error:".$conn->error;
}
	
	echo json_encode($data);
