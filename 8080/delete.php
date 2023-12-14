<?php
session_start();
require_once('../Db/connection.php');
$id = $_POST['student_id'];

$user = $_SESSION['uname'];

$sql = "DELETE FROM studentbiodata WHERE indexno = '$id' ";
$rs = mysqli_query($conn, $sql);

if($rs) {
	echo 1;
} else {
	echo $conn->error;
}
?>