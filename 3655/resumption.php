<?php
session_start();
require_once("../Db/connection2.php");

$id = $_POST['id'];
$index = $_POST['index'];
$user = $_SESSION['uname'];

$sql = "INSERT INTO tbl_action (uin, indexnum, action, status, performed_by) values ('$id', '$index', 'Resumption', 'Active', '$user')";

$rs = mysqli_query($conn2, $sql);
if($rs) {
	
		$sql3 = "UPDATE tbl_action SET status = 'Inactive' WHERE uin = '$id' and action != 'Resumption'";
		mysqli_query($conn2, $sql3);

		$sql2 = "UPDATE studentbiodata SET study_status = 'On-Going' where uin = '$id' and study_status != 'GRADUATED'";
		$rs2 = mysqli_query($conn2, $sql2);
		if($rs2) {
			echo 1;
		} else {
			echo $conn2->error;
		}
	
} else {
			echo $conn2->error;
		}
?>