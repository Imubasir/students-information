<?php
session_start();
require_once('../Db/connection2.php');
$id = $_POST['id'];
$index = $_POST['index'];
$reason = $_POST['reason'];
$start = $_POST['start'];
$end = $_POST['end'];

$user = $_SESSION['uname'];
$sql = "INSERT INTO tbl_action (uin, indexnum, action, status, startDate, endDate, performed_by, remark) values ('$id', '$index', 'Deferred', 'Active', '$start', '$end', '$user', '$reason')";

$rs = mysqli_query($conn2, $sql);
if($rs) {
	$sql1 = "UPDATE studentbiodata SET study_status = 'Deferred' where uin = '$id' and (study_status != 'GRADUATED' || study_status != 'Withdrawn')";
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