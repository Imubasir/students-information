<?php
	session_start();
	require('../Db/connection.php');
	$user = $_SESSION['FNAME']." ".$_SESSION['LNAME'];

	$sql = "SELECT * FROM inbox where destination = '$user' and status = '0' ";
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