<?php
	session_start();
	require_once('../Db/connection.php');
	$added_by = $_SESSION['uname'];
	$pageid = $_POST['id'];
	$user = $_POST['user'];

	$query = "SELECT * FROM tbl_pages where fpage = '$pageid' AND username = '$user' ";
	$output = mysqli_query($conn, $query);

	if($output->num_rows < 1){
		$sql = "INSERT INTO tbl_pages (fpage, username, added_by) VALUES ('$pageid', '$user', '$added_by')";
		$result = mysqli_query($conn, $sql);

		if($result == TRUE){
			echo 1;
		}else{
			echo $conn->error;
		}
	}


?>