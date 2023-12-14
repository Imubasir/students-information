<?php
session_start();
require("../Db/connection.php");
$user = $_SESSION['uname'];
$access = $_SESSION['access'];
$uin = $_POST['uin'];
$index = $_POST['index'];

$grd1 = strtoupper($_POST['grd1']);
$grd2 = strtoupper($_POST['grd2']);
$grd3 = strtoupper($_POST['grd3']);
$grd4 = strtoupper($_POST['grd4']);
$grd7 = strtoupper($_POST['grd7']);
$grd8 = strtoupper($_POST['grd8']);
$grd9 = strtoupper($_POST['grd9']);
$grd10 = strtoupper($_POST['grd10']);

$sub1 = strtoupper($_POST['sub1']);
$sub2 = strtoupper($_POST['sub2']);
$sub3 = strtoupper($_POST['sub3']);
$sub4 = strtoupper($_POST['sub4']);
$sub7 = strtoupper($_POST['sub7']);
$sub8 = strtoupper($_POST['sub8']);
$sub9 = strtoupper($_POST['sub9']);
$sub10 = strtoupper($_POST['sub10']);



$query = " UPDATE tbl_shs_results set subject1 = '$sub1', grade1 = '$grd1', subject2 = '$sub2', grade2 = '$grd2', subject3 = '$sub3', grade3 = '$grd3', subject4 = '$sub4', grade4 = '$grd4', subject7 = '$sub7', grade7 ='$grd7', subject8 = '$sub8', grade8 = '$grd8', subject9 = '$sub9', grade9 = '$grd9', subject10 = '$sub10', grade10 = '$grd10' WHERE trans_id = '$uin' AND indexnumber = '$index'";
$rs = mysqli_query($conn, $query);
if($rs) {
	$activity = "Results Updated -- Grade1=".$grd1."--Grade2=".$grd2."--Grade3=".$grd3."--Grade4=".$grd4."--Grade7=".$grd7."--Grade8=".$grd8."--Grade9=".$grd9."--Grade10=".$grd10;

	$log = "INSERT INTO tbl_log (event, username, access_lvl) VALUES ('$activity', '$user', '$access')";
	$log_rs = mysqli_query($conn, $log);

	echo 1;
} else {
	echo $conn->error;
}
?>