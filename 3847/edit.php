<?php
session_start();
require("../Db/connection.php");

$progname = strtoupper($_POST['e_progname']);
$key = $_POST['key'];
$progfullname = strtoupper($_POST['e_progfullname']);
$duration = strtoupper($_POST['e_duration']);
$dept = isset($_POST['e_dept']) ? strtoupper($_POST['e_dept']) : '';

$status = strtoupper($_POST['e_prg_status']);
$user = strtoupper($_SESSION['uname']);

$today = strtoupper(date("Y-m-d H:i:s"));
$user = strtoupper($_SESSION['uname']);

$select_dept = "SELECT * FROM department Where deptid = '$dept'";
$sel_rs = mysqli_query($conn, $select_dept);
if($sel_rs) {
	$row_ = mysqli_fetch_assoc($sel_rs);
	$fac_id = $row_['facultyid'];
}

$sql = "UPDATE programme set progname = '$progname', fullname = '$progfullname', facid = '$fac_id', duration='$duration', prg_status = '$status', dept_id='$dept', modified_by = '$user', date_modified='$today' where progid= '$key'";

$rs = mysqli_query($conn, $sql);
if($rs) {
    echo 1;
} else {
    echo $conn->error;
}
?>