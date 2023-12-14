<?php
	session_start();
	require('../Db/connection.php');

	$user = $_SESSION['uname'];

	$sql = "SELECT COUNT(*) FROM tbl_tasks where session_Name = '$user' ";
	$result = mysqli_query($conn, $sql);
	if($result == TRUE){
		while($row = mysqli_fetch_assoc($result)) {
	        echo $row['COUNT(*)'];
	    }
	}else{
		echo $conn->error;
	}
	

?>