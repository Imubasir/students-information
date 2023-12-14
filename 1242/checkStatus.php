<?php
	session_start();
	require_once('../Db/connection.php');
	$id = $_POST['id'];
	$username = $_POST['user'];
	$sql = "SELECT * FROM tbl_pages WHERE fpage = '$id' and username = '$username' ";
	$result = mysqli_query($conn, $sql);

	if($result->num_rows > 0){
		while($row = mysqli_fetch_assoc($result)){
			echo $row['fpage'];
		}
	}else{
		echo 0;
	}
?>