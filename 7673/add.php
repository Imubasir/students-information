<?php
session_start();
$username = $_SESSION['uname'];
$access=$_SESSION['access'];
require_once('../Db/connection.php');

$name = $_POST['name'];
$region = $_POST['add_region'];
$user = $_SESSION['uname'];

$sql = "INSERT INTO tbl_campus (campus_descr, region, added_by) values ('$name', '$region', '$user')";
$rs = mysqli_query($conn, $sql);
if($rs) {
    $event = "New Campus Added -> ".$name;
	 $log_insert = "INSERT INTO `tbl_log` (`event`, `username`, `access_lvl`) values ('$event', '$username', '$access')";
			$log_rs = mysqli_query($conn, $log_insert);
			if($log_rs) {
				echo 1;
			} else {
				echo $conn->error;
			}
} else {
    echo $conn->error;
}
?>