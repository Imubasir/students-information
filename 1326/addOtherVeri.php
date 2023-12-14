<?php
session_start();
require("../Db/connection.php");

$user = strtoupper($_SESSION['uname']);
$indexno = strtoupper($_POST['indexno']);
$uin = strtoupper($_POST['uin']);
$examDate = strtoupper($_POST['examDate']);
$instName = strtoupper($_POST['instName']);
$certName = strtoupper($_POST['certName']);
$certAward = strtoupper($_POST['certAward']);
$classObtained = strtoupper($_POST['classObtained']);

$sql_insert = "INSERT INTO tbl_other_verified (indexnum, uin, exam_date, institution, cert_name, prog, class, added_by) VALUES ('$indexno', '$uin', '$examDate', '$instName', '$certName', '$certAward', '$classObtained', '$user')";

$sql_rs = mysqli_query($conn, $sql_insert);

if($sql_rs) {
	echo 1;
} else {
	echo $conn->error;
}

?>