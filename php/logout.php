<?php
	session_start();
	require('../Db/connection.php');

	$user = $_SESSION['uname'];
	$access = $_SESSION['access'];
	$activity = $user." logged out";

	$sql = "UPDATE tbl_login SET is_active = '0' where username = '$user' ";
	$sql1 = "INSERT INTO tbl_log (event, username, access_lvl) values ('$activity', '$user', '$access')";

	$result = mysqli_query($conn, $sql);
	$result1 = mysqli_query($conn, $sql1);

	if($result == TRUE && $result1 == TRUE){
        
        $now = date("Y-m-d H:i:s");     
         $action = $now. "\t". $activity. "\t". $user. "\r\n";
        if(file_exists('../soms_log.txt')) {
         file_put_contents('../soms_log.txt', $action, FILE_APPEND);
        }
		echo 1;
	}else{
		echo $conn->error;
	}
?>