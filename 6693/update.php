<?php
session_start();

require_once('../Db/connection.php');
$code = $_POST['code'];
$title = $_POST['title'];
$credits = $_POST['credits'];
$dept = $_POST['dept'];
$key = $_POST['key'];

$user = $_SESSION['uname'];
$today = date('Y-m-d H:i:s');

$sql = "UPDATE course SET coursecode = '$code', coursetitle = '$title', credit = '$credits', deptid = '$dept', modified_date = '$today', modified_by='$user' where coursecode = '$key' ";
$rs = mysqli_query($conn, $sql);
if($rs) {
	echo 1;
} else {
	$conn->error;
}
?>