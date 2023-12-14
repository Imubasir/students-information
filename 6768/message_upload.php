<?php
session_start();
require("../Db/connection.php");
$message = mysqli_real_escape_string($conn, $_POST['message']);
$subj = mysqli_real_escape_string($conn, $_POST['subj']);
$user = $_SESSION['uname'];

$sql = "INSERT INTO inbox (sender, message, subject) values ('$user', '$message', '$subj')";
$rs = mysqli_query($conn, $sql);
if($rs) {
	echo 1;
} else {
	echo $conn->error;
}
?>