<?php
session_start();
$username = $_SESSION['uname'];
$access=$_SESSION['access'];

    require_once('../Db/connection.php');
    $id = $_POST['id'];

    $sql = "UPDATE trial_transcript SET cat4_status = '1' where trans_uin = '$id'";
    $result = mysqli_query($conn, $sql);
    if($result) {

        $event = "Confirmatory Letter Printed. Transaction ID: ".$id;
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