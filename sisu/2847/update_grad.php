<?php 
session_start();
require("../Db/connection.php");
$user = $_SESSION['uname'];
$student_id = $_POST['student_id'];
$certno = $_POST['certno'];
$date = date("Y-m-d");

$sql = "UPDATE tbl_graduate SET issued = '1', issued_by = '$user', issued_date = '$date' where indexno = '$student_id' ";
$rs = mysqli_query($conn, $sql);
if($rs) {
	echo 1;
} else {
	echo $conn->error;
}
?>