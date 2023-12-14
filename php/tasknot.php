<?php
	session_start();
	require('../Db/connection.php');

	$user = $_SESSION['uname'];

	$sql = "SELECT * FROM tbl_tasks where session_name = '$user' ";
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

?>