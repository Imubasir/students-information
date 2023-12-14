<?php
require_once("../Db/connection.php");
$user = $_POST['user'];

$sql = "DELETE FROM tbl_user_profile  where username = '$user'";
$sql2 = "DELETE FROM tbl_login  where username = '$user'";

$rs = mysqli_query($conn, $sql);
$rs2 = mysqli_query($conn, $sql2);
if($rs && $rs2) {
	echo 1;
} else {
	echo $conn->error;
}
?>