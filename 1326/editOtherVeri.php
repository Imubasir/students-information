<?php
session_start();
require("../Db/connection.php");

$user = strtoupper($_SESSION['uname']);
$indexno = strtoupper($_POST['e_indexno']);
$uin = strtoupper($_POST['e_uin']);
$examDate = strtoupper($_POST['e_examDate']);
$instName = strtoupper($_POST['e_instName']);
$certName = strtoupper($_POST['e_certName']);
$certAward = strtoupper($_POST['e_certAward']);
$classObtained = strtoupper($_POST['e_classObtained']);
$today = strtoupper(date('Y-m-d H:i:s'));

$sql_insert = "UPDATE tbl_other_verified SET indexnum='$indexno', uin='$uin', exam_date='$examDate', institution='$instName', cert_name='$certName', prog='$certAward', class='$classObtained',modified_by='$user', date_modified = '$today' where indexnum = '$indexno' and uin = '$uin' ";

$sql_rs = mysqli_query($conn, $sql_insert);

if($sql_rs) {
	echo 1;
} else {
	echo $conn->error;
}

?>