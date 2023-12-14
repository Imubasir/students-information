<?php
session_start();
require_once('../Db/connection.php');

$dept = $_POST['deptname'];
$hod = $_POST['hod'];
$faculty = $_POST['faculty'];
$campus = $_POST['campus'];
$user = $_SESSION['uname'];

$sql = "INSERT INTO department (deptname, facultyid, hod, campus, added_by) values ('$dept', '$faculty', '$hod', '$campus', '$user')";
$rs = mysqli_query($conn, $sql);

if($rs) {
    echo 1;
} else {
    echo $conn->error;
}
?>