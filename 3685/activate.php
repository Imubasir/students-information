<?php
session_start();
require_once('../Db/connection.php');
$username = $_SESSION['uname'];
$access=$_SESSION['access'];
$id = $_POST['id'];

$curdate = date("Y-m-d H:i:s");

$sql = "UPDATE tbl_sign SET status = 'None' ";
$sql2 = "UPDATE tbl_sign SET status = 'Active', last_active = '$curdate' where ID = '$id' ";

$rs=  mysqli_query($conn, $sql);
if($rs) {
    $rs2 = mysqli_query($conn, $sql2);
    if($rs2) {
        $event = "Signatory Changed";
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
} else {
    echo $conn->error;
}
?>