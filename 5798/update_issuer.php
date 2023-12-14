<?php
session_start();
require('../Db/connection.php');
$username = $_SESSION['uname'];
$access=$_SESSION['access'];

$sid = $_POST['id'];
$val = $_POST['val'];
$today = date("d-m-Y");

$sql = "UPDATE tbl_user_profile SET status = '$val' WHERE staff_ID = '$sid'";
$rs = mysqli_query($conn, $sql);

if($rs) {
	echo 1;
} else {
	echo $conn->error;
}

?>