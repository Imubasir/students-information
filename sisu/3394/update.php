<?php
require_once('../Db/connection2.php');
$code = $_POST['code'];
$title = $_POST['title'];
$credits = $_POST['credits'];
$dept = $_POST['dept'];
$key = $_POST['key'];

$sql = "UPDATE course SET coursecode = '$code', coursetitle = '$title', credit = '$credits', deptid = '$dept' where coursecode = '$key' ";
$rs = mysqli_query($conn2, $sql);
if($rs) {
	echo 1;
} else {
	$conn2->error;
}
?>