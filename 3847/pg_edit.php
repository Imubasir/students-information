<?php
session_start();
require("../Db/connection2.php");
require("../Db/connection.php");

$progname = strtoupper($_POST['pg_e_progname']);
$key = $_POST['key'];
$progfullname = strtoupper($_POST['pg_e_progfullname']);
$duration = strtoupper($_POST['pg_e_duration']);
$dept = strtoupper($_POST['pg_e_dept']);
$status = strtoupper($_POST['pg_e_prg_status']);
$user = strtoupper($_SESSION['uname']);

$today = date("Y-m-d H:i:s");

$select_dept = "SELECT * FROM department Where deptid = '$dept'";
$sel_rs = mysqli_query($conn, $select_dept);
if($sel_rs) {
	$row_ = mysqli_fetch_assoc($sel_rs);
	$fac_id = $row_['facultyid'];
}

$sql = "UPDATE programme set progname = '$progname', facid = '$fac_id', fullname = '$progfullname', duration='$duration', prg_status = '$status', dept_id='$dept', modified_by = '$user', date_modified='$today' where progid= '$key'";

$rs = mysqli_query($conn2, $sql);
if($rs) {
    echo 1;
} else {
    echo $conn2->error;
}
?>