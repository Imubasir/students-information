<?php
session_start();
$username = $_SESSION['uname'];
$access=$_SESSION['access'];
require_once('../Db/connection.php');
$id = $_POST['id'];
$transid = $_POST['transid'];
$to = $_POST['new'];

$sql = "UPDATE tbl_schedule SET assignedto = '$to' where trans_id = '$transid' ";
$rs = mysqli_query($conn, $sql);

if($rs) {
    $event = "Request Reassigned from ".$id." to ".$to." Transaction ID: ".$transid;
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