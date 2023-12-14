<?php
session_start();
require_once('../Db/connection.php');
$id = $_POST['id'];
$index = $_POST['index'];
$reason = $_POST['reason'];
$start = $_POST['start'];
$end = $_POST['end'];

$user = $_SESSION['uname'];
$sql = "INSERT INTO tbl_action (uin, indexnum, action, status, startDate, endDate, performed_by, remark) values ('$id', '$index', 'Suspended', 'Active', '$start', '$end', '$user', '$reason')";

$rs = mysqli_query($conn, $sql);
if($rs) {
	$sql1 = "UPDATE studentbiodata SET study_status = 'Suspended' where uin = '$id' and (study_status != 'GRADUATED' || study_status != 'Withdrawn')";
	$rs1 = mysqli_query($conn, $sql1);
	if($rs1) {
		echo 1;
	} else {
		echo $conn->error;
	}
} else {
	echo $conn->error;
}
?>