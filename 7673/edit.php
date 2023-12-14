<?php 
session_start();
require_once('../Db/connection.php');
$username = $_SESSION['uname'];
$access=$_SESSION['access'];

$id = $_POST['id'];
$name = $_POST['name'];
$region = $_POST['region'];
$user = $_SESSION['uname'];
$date = date('Y-m-d h:m:s');
$sql = "UPDATE tbl_campus SET campus_descr = '$name', region= '$region', modified_by = '$user', campus_date_modified = '$date' where campus_id = '$id'";
$rs = mysqli_query($conn, $sql);
if($rs) {
    $event = "Campus Edited";
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