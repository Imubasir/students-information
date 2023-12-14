<?php
session_start();
require_once('../Db/connection2.php');
$id = $_POST['id'];
$index = $_POST['index'];
$reason = $_POST['reason'];
$user = $_SESSION['uname'];
$sql = "INSERT INTO tbl_action (uin, indexnum, action, status, performed_by, remark) values ('$id', '$index', 'Withdrawn', 'Active', '$user', '$reason')";

$rs = mysqli_query($conn2, $sql);
if($rs) {
	$sql1 = "UPDATE studentbiodata SET study_status = 'Withdrawn' where uin = '$id' and study_status != 'GRADUATED'";
	$rs1 = mysqli_query($conn2, $sql1);
	if($rs1) {
		echo 1;
	} else {
		echo $conn2->error;
	}
} else {
	echo $conn2->error;
}
?>