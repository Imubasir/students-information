<?php
session_start();
require("../Db/connection.php");
$user = $_SESSION['uname'];
$id = $_POST['id'];
$date = date("Y-m-d");

$sql_fetch = "SELECT * FROM tbl_graduate WHERE indexno = '$id' FOR UPDATE";
$rs_update = mysqli_query($conn, $sql_fetch);
if($rs_update) {
	while ($row = mysqli_fetch_assoc($rs_update)) {
		$status = $row['issued'];
		if($status == '1') {
			echo 2;
			mysqli_commit();
	} else {
		$sql = "UPDATE tbl_graduate SET issued = '1', issued_date = '$date', issued_by = '$user' WHERE indexno = '$id' ";

			$rs = mysqli_query($conn, $sql);
			if($rs) {
				echo 1;
			} else {
				echo $conn->error;
			}
				}
		} 
	
	}
	



?>