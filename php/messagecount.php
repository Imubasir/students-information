<?php
	session_start();
	require('../Db/connection.php');

	$user = $_SESSION['FNAME']." ".$_SESSION['LNAME'];

	$sql = "SELECT COUNT(*) FROM inbox where status = '0' and destination = '$user' ";
	$result = mysqli_query($conn, $sql);
	if($result == TRUE){
		while($row = mysqli_fetch_assoc($result)) {
	        echo $row['COUNT(*)'];
	    }
	}else{
		echo $conn->error;
	}
	

?>