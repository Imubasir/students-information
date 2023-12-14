<?php 
session_start();
require('../Db/connection.php');
$user = $_SESSION['uname'];
$activity = "Session Timed Out.";
if(time() - $_SESSION['timeout'] > 900){
    
	$sql = "UPDATE tbl_login set is_active = '0' where username = '$user' ";
    $sql1 = "INSERT INTO tbl_log(activity, performed_by) values ('$activity', '$user')";
    
	mysqli_query($conn, $sql);
    mysqli_query($conn, $sql1);
    
    $now = date("Y-m-d H:i:s");     
         $action = $now. "\t". $activity. "\t". $user. "\r\n";
        if(file_exists('../soms_log.txt')) {
         file_put_contents('../soms_log.txt', $action, FILE_APPEND);
        }
	echo 1;
}

?>